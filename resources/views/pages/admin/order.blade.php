@extends('layouts.admin')

@section('title', 'Order')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex flex-col">
            <h1 class="text-lg font-semibold">Order</h1>
            <div class="text-sm breadcrumbs">
                <ul>
                    <li>
                        <a>Admin</a>
                    </li>
                    <li>
                        <a>Pesanan</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card bg-white">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Total Pembayaran</th>
                                <th>Layanan Pengiriman</th>
                                <th>Alamat</th>
                                <th>Status Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders === null)
                                <p class="text-sm text-error text-center">Tidak ada status pesanan.</p>
                            @else
                                @foreach ($orders as $order)
                                    <tr class="transition-all duration-300 cursor-pointer hover:bg-gray-200"
                                        onclick="document.getElementById('my_modal_{{ $order->order_id }}').showModal()">
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $order->user->firstname }} {{ $order->user->lastname }}</td>
                                        <td>IDR {{ number_format($order->order_totalpayment, 0, ',', '.') }}</td>
                                        <td>{{ $order->order_shippingservice }}</td>
                                        <td>{{ $order->order_address }}</td>
                                        <td>
                                            @if ($order->order_status === 'Unpaid')
                                                <div class="badge badge-sm badge-error text-white">Tidak Dibayar</div>
                                            @elseif ($order->order_status === 'Pending Approval')
                                                <div class="badge badge-sm badge-warning text-white">Tertunda</div>
                                            @elseif ($order->order_status === 'Approved')
                                                <div class="badge badge-sm badge-info text-white">Menunggu</div>
                                            @elseif ($order->order_status === 'Rejected')
                                                <div class="badge badge-sm badge-error text-white">Ditolak</div>
                                            @elseif ($order->order_status === 'Retrieved')
                                                <div class="badge badge-sm badge-info text-white">Diterima</div>
                                            @elseif ($order->order_status === 'Sent')
                                                <div class="badge badge-sm badge-success text-white">Dikirim</div>
                                            @endif
                                        </td>
                                    </tr>
                                    <dialog id="my_modal_{{ $order->order_id }}" class="modal">
                                        <div class="modal-box">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-4">
                                                    <h3 class="font-semibold text-lg">Order Details</h3>
                                                    @if ($order->order_status === 'Unpaid')
                                                        <div class="badge badge-sm badge-error text-white">Tidak Dibaya</div>
                                                    @elseif ($order->order_status === 'Pending Approval')
                                                        <div class="badge badge-sm badge-warning text-white">Menunggu Persetujuan
                                                        </div>
                                                    @elseif ($order->order_status === 'Approved')
                                                        <div class="badge badge-sm badge-info text-white">Menunggu untuk dikirim</div>
                                                    @elseif ($order->order_status === 'Rejected')
                                                        <div class="badge badge-sm badge-error text-white">Ditolak</div>
                                                    @elseif ($order->order_status === 'Retrieved')
                                                        <div class="badge badge-sm badge-info text-white">Diterima</div>
                                                    @elseif ($order->order_status === 'Sent')
                                                        <div class="badge badge-sm badge-success text-white">Dikirim</div>
                                                    @endif
                                                </div>
                                                <form method="dialog">
                                                    <button class="btn btn-sm btn-ghost">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="divider my-0 mb-4"></div>
                                            <div class="flex flex-col gap-4">
                                                <div class="grid grid-cols-3 gap-y-6 gap-x-6">
                                                    <div class="flex flex-col gap-1 h-fit">
                                                        <p class="text-sm font-medium">Nama</p>
                                                        <p class="text-sm">{{ $order->user->firstname }}
                                                            {{ $order->user->lastname }}</p>
                                                    </div>
                                                    <div class="flex flex-col gap-1 h-fit">
                                                        <p class="text-sm font-medium">Total Pembayaran</p>
                                                        <p class="text-sm">IDR
                                                            {{ number_format($order->order_totalpayment, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                    <div class="flex flex-col gap-1 h-fit">
                                                        <p class="text-sm font-medium">Layanan Pengiriman</p>
                                                        <p class="text-sm">{{ $order->order_shippingservice }}</p>
                                                    </div>
                                                    <div class="flex flex-col gap-1 h-fit">
                                                        <p class="text-sm font-medium">Alamat</p>
                                                        <p class="text-sm">{{ $order->order_address }}</p>
                                                    </div>
                                                    <div class="flex flex-col gap-1 h-fit">
                                                        <p class="text-sm font-medium">Bukti Pembayaran</p>
                                                        @if ($order->order_status !== 'Unpaid')
                                                            <div
                                                                class="border border-gray-200 w-fit rounded-md overflow-hidden">
                                                                <img src="{{ asset('storage/' . $order->order_proofpayment) }}"
                                                                    class="w-24" alt="Proof Payment Image">
                                                            </div>
                                                        @else
                                                            <p class="text-sm text-error">Pengguna belum melakukan pembayaran.</p>
                                                        @endif
                                                    </div>
                                                    <div class="flex flex-col gap-1 h-fit">
                                                        <p class="text-sm font-medium text-error">Alasan Ditolak</p>
                                                        <p class="text-sm">
                                                            {{ $order->order_rejectednotes ? $order->order_rejectednotes : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divider my-4"></div>
                                            <div class="flex flex-col">
                                                <p class="text-sm font-medium">Detail Pesanan</p>
                                                @foreach ($order->order_details as $orderDetail)
                                                    <div class="flex gap-6 items-center py-4 border-b border-gray-200">
                                                        <div class="rounded w-12 overflow-hidden">
                                                            <img src="{{ asset('storage/' . $orderDetail->product->product_img) }}"
                                                                alt="Product Image">
                                                        </div>
                                                        <div class="block">
                                                            <p class="font-medium text-sm">
                                                                {{ $orderDetail->product->product_name }}</p>
                                                            <p class="text-xs mt-1 mb-3">
                                                                {{ $orderDetail->product->category->category_name }}</p>
                                                            <p class="text-sm">
                                                                <span class="font-medium">Stok</span>:
                                                                {{ $orderDetail->detail_quantity }}
                                                                |
                                                                <span class="font-medium">Total Harga</span>: IDR
                                                                {{ number_format($orderDetail->detail_totalprice, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if ($order->order_status !== 'Unpaid')
                                                <div class="mt-4">
                                                    <livewire:admin.order.update-order-form :orderId="$order->order_id" />
                                                </div>
                                            @endif
                                        </div>
                                    </dialog>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
