<?php

namespace App\Livewire\User\Payment;

use App\Models\OrderModel;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PaymentDetails extends Component
{
    use WithFileUploads;

    protected $listeners = ['getOrderById'];
    public OrderModel $order;
    public $proofPayment;

    public function render()
    {
        return view('livewire.user.payment.payment-details');
    }

    public function payOrder (string $order_id) {
        $this->validate([
            'proofPayment' => 'required|image'
        ]);

        $proofPaymentPath = $this->proofPayment->store('uploads/proofpayments', 'public');
        $data = array(
            'order_proofpayment' => $proofPaymentPath,
            'order_status' => 'Pending Approval'
        );

        OrderModel::payOrder($data, $order_id);
        $this->dispatch('payOrder', order_id: $order_id);
        $this->order = OrderModel::getOrderById($order_id);
    }

    #[On('getOrderById')]
    public function getOrderById (string $order_id) {
        $this->order = OrderModel::getOrderById($order_id);
    }
}
