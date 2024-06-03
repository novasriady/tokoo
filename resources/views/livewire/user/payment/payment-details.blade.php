<div class="card bg-white shadow-md rounded-xl h-fit">
    <div class="card-body">
        <div class="flex items-center justify-between">
            <h1 class="font-semibold">Payment Details</h1>
            @if ($order !== null)
                @if ($order->order_status === 'Unpaid')
                    <div class="badge badge-sm badge-error text-white">Tidak Dibayar</div>
                @elseif ($order->order_status === 'Pending Approval')
                    <div class="badge badge-sm badge-warning text-white">Menunggu Persetujuan
                    </div>
                @elseif ($order->order_status === 'Approved')
                    <div class="badge badge-sm badge-info text-white">Menunggu untuk dikirim
                    </div>
                @elseif ($order->order_status === 'Rejected')
                    <div class="badge badge-sm badge-error text-white">Ditolak</div>
                @elseif ($order->order_status === 'Retrieved')
                    <div class="badge badge-sm badge-info text-white">Diterima</div>
                @elseif ($order->order_status === 'Sent')
                    <div class="badge badge-sm badge-success text-white">Dikirim</div>
                @endif
            @endif
        </div>
        <div class="divider my-0"></div>
        @if ($order === null)
            <p class="text-sm text-error text-center">Tidak ada data pesanan yang dipilih.</p>
        @else
            @if ($order->order_status === 'Unpaid')
                <div class="flex flex-col gap-4">
                    <div role="alert" class="alert">
                        <div class="flex items-center gap-6">
                            <i class="fa-solid fa-money-check"></i>
                            <div class="flex flex-col gap-1">
                                <p class="text-sm">Silakan lakukan pembayaran ke salah satu rekening bank berikut dan upload bukti pembayaran.</p>
                                <p>
                                    <span class="font-medium text-sm">BANK BCA</span>: NOVA SRIADY 462392434
                                </p>
                                <p>
                                    <span class="font-medium text-sm">BANK MANDIRI</span>: NOVA SRIADY 0231757236345
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Bukti Pembayaran</label>
                        <input type="file" class="file-input file-input-bordered file-input-sm  w-full" wire:model="proofPayment">
                        @error('proofPayment')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <span wire:loading wire:target="payOrder">
                        <button class="btn btn-sm text-white bg-gray-800 w-full" disabled>
                            <span class="loading loading-spinner"></span>
                            Memuat...
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
                    <p class="font-medium text-sm">Layanan Pengiriman</p>
                    <p class="text-sm">{{ $order->order_shippingservice }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Biaya Pengiriman</p>
                    <p class="text-sm">IDR {{ number_format($order->order_shippingcost, 0, ',', '.') }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Total Pembayaran</p>
                    <p class="text-sm">IDR {{ number_format($order->order_totalpayment, 0, ',', '.') }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Alamat</p>
                    <p class="text-sm">{{ $order->order_address }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm text-error">Alasan Ditolak</p>
                    <p class="text-sm">{{ $order->order_rejectednotes ? $order->order_rejectednotes : '-' }}</p>
                </div>
            </div>
            <div class="flex flex-col gap-2 mt-6">
                <p class="font-medium text-sm">Detail Pesanan</p>
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
                                    <span class="font-medium">Stok</span>: {{ $orderDetail->detail_quantity }}
                                    |
                                    <span class="font-medium">Total Harga</span>: IDR
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
