<div class="card bg-white shadow-md rounded-xl h-fit">
    <div class="card-body">
        <div class="flex flex-col gap-4">
            <div class="flex flex-col">
                <h1 class="text-lg font-semibold">Detail Pembelian</h1>
                <div class="divider mb-0 mt-1"></div>
            </div>
            <div class="flex flex-col gap-2">
                <label class="label-text">Stok</label>
                <input type="number" placeholder="Order Quantity" class="input input-bordered input-sm w-full"
                    wire:model.live.debounce.300ms="quantity" required>
                @error('quantity')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>
            <p class="font-medium">Total Harga: IDR {{ number_format($totalPrice, 0, ',', '.') }}</p>
            @if (!Auth::check())
                <p class="text-red-600 text-sm">Anda harus login terlebih dahulu untuk menambahkan produk ke keranjang.</p>
            @else
                @php
                    $isProductInCart = false;
                    if (isset($cart['order_details'])) {
                        $isProductInCart = collect($cart['order_details'])->contains(
                            'detail_product_id',
                            $product->product_id,
                        );
                    }
                @endphp

                @if ($isProductInCart)
                    <p class="text-green-600 text-sm">Produk sudah ada di keranjang.</p>
                @else
                    <button class="btn btn-sm bg-gray-800 text-white" wire:click="addToCart">Tambah Keranjang</button>
                @endif
            @endif

        </div>
    </div>
</div>
