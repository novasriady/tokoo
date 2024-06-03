<?php

namespace App\Livewire\Admin\Order;

use App\Models\OrderModel;
use Livewire\Component;

class UpdateOrderForm extends Component
{
    public string $orderId;
    public string $orderStatus = '';
    public string $orderRejectedNotes;

    public function mount (string $orderId) {
        $this->orderId = $orderId;
    }

    public function render()
    {
        return view('livewire.admin.order.update-order-form');
    }

    public function updateOrderStatus () {
        if ($this->orderStatus === 'Rejected') {
            $this->validate([
                'orderStatus' => 'required',
                'orderRejectedNotes' => 'required'
            ]);

            OrderModel::updateOrderStatus(
                $this->orderId,
                $this->orderStatus,
                $this->orderRejectedNotes
            );
        } else {
            $this->validate([
                'orderStatus' => 'required',
            ]);

            OrderModel::updateOrderStatus(
                $this->orderId,
                $this->orderStatus
            );
        }

        return redirect()->route('admin.order');
    }
}
