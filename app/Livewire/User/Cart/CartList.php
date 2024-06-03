<?php

namespace App\Livewire\User\Cart;

use App\Models\OrderDetailModel;
use Livewire\Attributes\On;
use Livewire\Component;

class CartList extends Component
{
    protected $listeners = ['createOrder'];
    public array $cart = array();

    public function mount()
    {
        $this->cart = session()->get('cart', array());
    }

    public function render()
    {
        return view('livewire.user.cart.cart-list');
    }

    public function deleteProductFromCart(string $detail_id)
    {
        foreach ($this->cart['order_details'] as $key => $detail) {
            if ($detail['detail_id'] == $detail_id) {
                unset($this->cart['order_details'][$key]);
                $this->cart['order_details'] = array_values($this->cart['order_details']);
                break;
            }
        }
    
        session()->put('cart', $this->cart);
        OrderDetailModel::deleteOrderDetail($detail_id);
    }

    #[On('createOrder')]
    public function reloadComponent () {
        $this->mount();
    }
}
