<?php

namespace App\Livewire\User\Payment;

use App\Models\OrderModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class PaymentList extends Component
{
    protected $listeners = ['payOrder'];
    public Collection $orders;
    public string $selectedOrderId;

    public function mount () {
        $orders = OrderModel::getOrderByUserId(Auth::user()->id);

        $this->orders = $orders;
    }

    public function render()
    {
        return view('livewire.user.payment.payment-list');
    }

    public function getOrderById(string $order_id) {
        $this->dispatch('getOrderById', order_id: $order_id);
        $this->selectedOrderId = $order_id;
    }

    #[On('payOrder')]
    public function reloadComponent () {
        $this->mount();
    }
}
