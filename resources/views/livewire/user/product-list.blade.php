@php
    use Illuminate\Support\Str;
@endphp

<section class="my-8 w-full px-12">
    <div class="flex">
        <div class="w-1/4 h-fit px-4 py-4 bg-white shadow-md rounded-xl">
            <div class="flex flex-col">
                <p class="font-semibold">Filter</p>
                <div class="divider my-2"></div>
                <div class="flex flex-col gap-4">
                    <select class="select select-bordered w-full max-w-xs" wire:model="filters.category_name" wire:change="updateProductList">
                        <option value="" selected>Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <select class="select select-bordered w-full max-w-xs" wire:model="filters.price_range" wire:change="updateProductList">
                        <option value="" selected>Range Harga</option>
                        <option value="150000-300000">IDR 150.000 - IDR 300.000</option>
                        <option value="300000-500000">IDR 300.000 - IDR 500.000</option>-
                    </select>
                </div>
            </div>
        </div>
        <div class="w-3/4 pl-12">
            <div class="grid grid-cols-4 gap-x-6 gap-y-6">
                @foreach ($products as $product)
                    <div class="card card-compact w-full bg-white shadow-md rounded-xl">
                        <figure class="h-32 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->product_img) }}" alt="Product Image" class="w-full" />
                        </figure>
                        <div class="card-body">
                            <p class="text-lg font-semibold">{{ Str::limit($product->product_name, 16, '...') }}</p>
                            <div class="flex flex-col gap-1">
                                <p>{{ $product->category->category_name }}</p>
                                <p>IDR {{ number_format($product->product_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="card-actions justify-start mt-2">
                                <a href="{{ route('user.productDetails', ['product_id' => $product->product_id]) }}" class="btn bg-gray-800 text-white btn-sm">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
