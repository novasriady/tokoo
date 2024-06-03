<?php

namespace App\Livewire\User;

use App\Models\ProductModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class PurchaseDetails extends Component
{
    public ProductModel $product;
    public int $quantity = 1;
    public int $totalPrice = 0;
    public array $cart = array();

    public function mount(ProductModel $product)
    {
        $this->product = $product;
        $this->totalPrice = $this->product->product_price * $this->quantity;
        $this->cart = session()->get('cart', array());
    }

    public function updatedQuantity()
    {
        $this->validate([
            'quantity' => 'required|numeric|min:1|max:' . $this->product->product_stock
        ]);

        if ($this->quantity > $this->product->product_stock) {
            $this->addError('quantity', 'The quantity cannot exceed the stock.');
        } else {
            $this->totalPrice = $this->product->product_price * $this->quantity;
        }
    }

    public function addToCart()
    {
        if (empty($this->cart)) {
            $order_id = (string) Str::uuid();

            $data = array(
                'order_id' => $order_id,
                'order_user_id' => Auth::user()->id,
                'order_details' => array(
                    array(
                        'detail_id' => (string) Str::uuid(),
                        'detail_order_id' => $order_id,
                        'detail_product_id' => $this->product->product_id,
                        'detail_product_name' => $this->product->product_name,
                        'detail_product_description' => $this->product->product_description,
                        'detail_product_category' => $this->product->category->category_name,
                        'detail_product_img' => $this->product->product_img,
                        'detail_quantity' => $this->quantity,
                        'detail_weight' => $this->product->category->category_name !== 'Shoes' ? 100 * $this->quantity : 500 * $this->quantity,
                        'detail_totalprice' => $this->totalPrice,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    )
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            );

            session()->put('cart', $data);
        } else {
            $orderDetails = array(
                'detail_id' => (string) Str::uuid(),
                'detail_order_id' => $this->cart['order_id'],
                'detail_product_id' => $this->product->product_id,
                'detail_product_name' => $this->product->product_name,
                'detail_product_description' => $this->product->product_description,
                'detail_product_category' => $this->product->category->category_name,
                'detail_product_img' => $this->product->product_img,
                'detail_quantity' => $this->quantity,
                'detail_weight' => $this->product->category->category_name !== 'Shoes' ? 100 * $this->quantity : 500 * $this->quantity,
                'detail_totalprice' => $this->totalPrice,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            );

            array_push($this->cart['order_details'], $orderDetails);

            session()->put('cart', $this->cart);
        }

        $this->mount($this->product);
    }

    public function render()
    {
        return view('livewire.user.purchase-details');
    }
}
