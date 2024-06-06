<?php

namespace App\Livewire\User\Cart;

use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CartDetails extends Component
{
    // API Properties
    public array $province = array();
    public array $city = array();

    // Others
    public int $totalWeight = 0;
    public int $totalProductPrice = 0;
    public int $shippingCost = 0;
    public int $totalPayment = 0;
    public int $selectedProvince;
    public int $selectedCity;
    public string $shippingService;
    public string $address;

    public function mount()
    {
        $cart = session()->get('cart', array());

        $this->getCartWeight($cart);
        $this->getTotalProductPrice($cart);
        $this->getProvince();
        $this->getCity();
    }

    public function render()
    {
        return view('livewire.user.cart.cart-details');
    }

    protected function getCartWeight(array $data)
    {
        if (!empty($data)) {
            foreach ($data['order_details'] as $order_detail) {
                $this->totalWeight += $order_detail['detail_weight'];
            }
        }
    }

    protected function getTotalProductPrice(array $data)
    {
        if (!empty($data)) {
            foreach ($data['order_details'] as $order_detail) {
                $this->totalProductPrice += $order_detail['detail_totalprice'];
            }
        }
    }

    protected function getProvince()
    {
        if (Cache::has('provinces')) {
            $this->province = Cache::get('provinces');
        } else {
            $response = Http::withHeaders([
                'key' => '7c41c9c6d0c7f23608f0004847eafce3'
            ])->get('https://api.rajaongkir.com/starter/province');

            if ($response->successful()) {
                $this->province = $response->json()['rajaongkir']['results'];
                Cache::forever('provinces', $this->province);
            } else {
                $this->province = array();
            }
        }
    }


    protected function getCity()
    {
        if (Cache::has('city')) {
            $this->city = Cache::get('city');
        } else {
            $response = Http::withHeaders([
                'key' => '7c41c9c6d0c7f23608f0004847eafce3'
            ])->get('https://api.rajaongkir.com/starter/city');

            if ($response->successful()) {
                $this->city = $response->json()['rajaongkir']['results'];
                Cache::forever('city', $this->city);
            } else {
                $this->city = array();
            }
        }
    }

    public function getShippingCost()
    {
        $this->validate([
            'selectedCity' => 'required',
            'selectedProvince' => 'required',
            'shippingService' => 'required',
            'address' => 'required',
        ]);

        if ($this->selectedCity == 134) {
            $this->shippingCost = 0;
        } else {
            $response = Http::withHeaders([
                'key' => '7c41c9c6d0c7f23608f0004847eafce3'
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => 134,
                'destination' => $this->selectedCity,
                'weight' => $this->totalWeight,
                'courier' => $this->shippingService
            ]);

            if ($response->successful()) {
                $this->shippingCost = $response->json()['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
            } else {
                $this->shippingCost = 0;
            }
        }

        $this->totalPayment = $this->shippingCost + $this->totalProductPrice;
    }

    public function createOrder()
    {
        $this->validate([
            'selectedCity' => 'required',
            'selectedProvince' => 'required',
            'shippingService' => 'required',
            'address' => 'required',
        ]);

        $province = array_values(array_filter($this->province, function ($province) {
            return $province['province_id'] == $this->selectedProvince;
        }));
        $city = array_values(array_filter($this->city, function ($city) {
            return $city['city_id'] == $this->selectedCity;
        }));

        if ($this->shippingCost === 0 && $this->totalPayment === 0) {
            $this->getShippingCost();
        }

        $cartSession = session()->get('cart');
        $data = array(
            'order_id' => $cartSession['order_id'],
            'order_user_id' => $cartSession['order_user_id'],
            'order_address' => $this->address . ' ' . $city[0]['city_name'] . ' ' . $province[0]['province'],
            'order_shippingservice' => strtoupper($this->shippingService),
            'order_shippingcost' => $this->shippingCost,
            'order_totalpayment' => $this->totalPayment,
            'order_status' => 'Unpaid'
        );

        DB::beginTransaction();
        OrderModel::createOrder($data);
        foreach ($cartSession['order_details'] as $orderDetail) {
            OrderDetailModel::createOrderDetail($orderDetail);
            ProductModel::updateProductStock(
                $orderDetail['detail_product_id'],
                $orderDetail['detail_quantity']
            );
        }
        DB::commit();

        session()->forget('cart');
        $this->dispatch('createOrder');
    }
}
