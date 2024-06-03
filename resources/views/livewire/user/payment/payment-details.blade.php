<div class="card bg-white shadow-md rounded-xl h-fit">
    <div class="card-body">
        <div class="flex items-center justify-between">
            <h1 class="font-semibold">Payment Details</h1>
            @if ($order !== null)
                @if ($order->order_status === 'Unpaid')
                    <div class="badge badge-sm badge-error text-white">Unpaid</div>
                @elseif ($order->order_status === 'Pending Approval')
                    <div class="badge badge-sm badge-warning text-white">Pending Approval
                    </div>
                @elseif ($order->order_status === 'Approved')
                    <div class="badge badge-sm badge-info text-white">Waiting for Delivery
                    </div>
                @elseif ($order->order_status === 'Rejected')
                    <div class="badge badge-sm badge-error text-white">Rejected</div>
                @elseif ($order->order_status === 'Retrieved')
                    <div class="badge badge-sm badge-info text-white">Retrieved</div>
                @elseif ($order->order_status === 'Sent')
                    <div class="badge badge-sm badge-success text-white">Sent</div>
                @endif
            @endif
        </div>
        <div class="divider my-0"></div>
        @if ($order === null)
            <p class="text-sm text-error text-center">No order data is selected.</p>
        @else
            @if ($order->order_status === 'Unpaid')
                <div class="flex flex-col gap-4">
                    <div role="alert" class="alert">
                        <div class="flex items-center gap-6">
                            <i class="fa-solid fa-money-check"></i>
                            <div class="flex flex-col gap-1">
                                <p class="text-sm">Please make payment to one of the following bank accounts and upload
                                    proof
                                    of payment.</p>
                                <p>
                                    <span class="font-medium text-sm">BANK MANDIRI</span>: SATYA MAHENDRA 1234567
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Proof of Payment</label>
                        <input type="file" class="file-input file-input-bordered file-input-sm  w-full" wire:model="proofPayment">
                        @error('proofPayment')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <span wire:loading wire:target="payOrder">
                        <button class="btn btn-sm text-white bg-gray-800 w-full" disabled>
                            <span class="loading loading-spinner"></span>
                            Loading...
                        </button>
                    </span>
                    <span wire:loading.remove wire:target="payOrder">
                        <button class="btn btn-sm text-white bg-gray-800 w-full" wire:click="payOrder('{{ $order->order_id }}')">Pay Order</button>
                    </span>
                </div>
                <div class="divider my-0"></div>
            @endif
            <div class="grid grid-cols-3 gap-x-4 gap-y-6">
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Shipping Service</p>
                    <p class="text-sm">{{ $order->order_shippingservice }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Shipping Cost</p>
                    <p class="text-sm">IDR {{ number_format($order->order_shippingcost, 0, ',', '.') }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Total Payment</p>
                    <p class="text-sm">IDR {{ number_format($order->order_totalpayment, 0, ',', '.') }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Address</p>
                    <p class="text-sm">{{ $order->order_address }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm text-error">Rejected Notes</p>
                    <p class="text-sm">{{ $order->order_rejectednotes ? $order->order_rejectednotes : '-' }}</p>
                </div>
            </div>
            <div class="flex flex-col gap-2 mt-6">
                <p class="font-medium text-sm">Order Details</p>
                <div class="flex flex-col">
                    @foreach ($order->order_details as $orderDetail)
                        <div class="flex gap-6 items-center py-4 border-b border-gray-200">
                            <div class="rounded w-12 overflow-hidden">
                                <img src="{{ asset('storage/' . $orderDetail->product->product_img) }}"
                                    alt="Product Image">
                            </div>
                            <div class="block">
                                <p class="font-medium text-sm">{{ $orderDetail->product->product_name }}</p>
                                <p class="text-xs mt-1 mb-3">{{ $orderDetail->product->category->category_name }}</p>
                                <p class="text-sm">
                                    <span class="font-medium">Quantity</span>: {{ $orderDetail->detail_quantity }}
                                    |
                                    <span class="font-medium">Total Price</span>: IDR
                                    {{ number_format($orderDetail->detail_totalprice, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
