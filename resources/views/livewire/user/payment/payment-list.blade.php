<div class="card bg-white shadow-md rounded-xl h-fit">
    <div class="card-body">
        <h1 class="font-semibold">Your Payment Data</h1>
        <div class="divider my-0"></div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Shipping Service</th>
                        <th>Address</th>
                        <th>Total Payment</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders) === 0)
                        <p class="text-sm text-center text-error">No payment data available.</p>
                    @else
                        @foreach ($orders as $order)
                            <tr class="{{ $selectedOrderId === $order->order_id ? 'bg-gray-200' : '' }} transition-all duration-300 cursor-pointer hover:bg-gray-200" wire:click="getOrderById('{{ $order->order_id }}')">
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $order->order_shippingservice }}</td>
                                <td>{{ $order->order_address }}</td>
                                <td>IDR {{ number_format($order->order_totalpayment, 0, ',', '.') }}</td>
                                <td>
                                    @if ($order->order_status === 'Unpaid')
                                        <div class="badge badge-sm badge-error text-white">Unpaid</div>
                                    @elseif ($order->order_status === 'Pending Approval')
                                        <div class="badge badge-sm badge-warning text-white">Pending
                                        </div>
                                    @elseif ($order->order_status === 'Approved')
                                        <div class="badge badge-sm badge-info text-white">Waiting
                                        </div>
                                    @elseif ($order->order_status === 'Rejected')
                                        <div class="badge badge-sm badge-error text-white">Rejected</div>
                                    @elseif ($order->order_status === 'Retrieved')
                                        <div class="badge badge-sm badge-info text-white">Retrieved</div>
                                    @elseif ($order->order_status === 'Sent')
                                        <div class="badge badge-sm badge-success text-white">Sent</div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>