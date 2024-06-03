<div class="card bg-white shadow-md rounded-xl h-fit">
    <div class="card-body">
        <h1 class="font-semibold text-lg">Keranjang</h1>
        <div class="divider my-0"></div>
        @if (count($cart) === 0 || count($cart['order_details']) === 0)
            <p class="text-sm text-error">Data keranjang masih kosong. Silakan melakukan pembelian produk untuk mengisi keranjang Anda.</p>
        @else
            <div class="flex flex-col gap-2">
                @foreach ($cart['order_details'] as $orderDetail)
                    <div class="flex items-center justify-between py-4 border-b border-gray-200">
                        <div class="flex gap-6 items-center">
                            <div class="rounded h-20 w-20 overflow-hidden">
                                <img src="{{ asset('storage/' . $orderDetail['detail_product_img']) }}" alt="Product Image">
                            </div>
                            <div class="block">
                                <p class="font-medium">{{ $orderDetail['detail_product_name'] }}</p>
                                <p class="text-sm mt-1 mb-3">{{ $orderDetail['detail_product_category'] }}</p>
                                <p class="text-sm">
                                    <span class="font-medium">Stok</span>: {{ $orderDetail['detail_quantity'] }} | 
                                    <span class="font-medium">Total Harga</span>: IDR {{ number_format($orderDetail['detail_totalprice'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <button class="btn btn-error btn-sm text-white" wire:click="deleteProductFromCart('{{ $orderDetail['detail_id'] }}')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>