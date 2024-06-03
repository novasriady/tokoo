@extends('layouts.user')

@section('title', 'Product')

@section('content')
    <div class="px-12 my-8">
        <div class="grid grid-cols-2 gap-x-8">
            <div class="card bg-white shadow-md rounded-xl h-fit">
                <div class="card-body">
                    <div class="flex items-center gap-x-6">
                        <img src="{{ asset('storage/' . $product->product_img) }}" alt="Product Image" class="rounded-xl w-64">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="font-semibold text-lg">{{ $product->product_name }}</h1>
                                <p class="text-sm">
                                    {{ $product->category->category_name }} | 
                                    <span class="font-semibold">{{ $product->product_stock }} Stock Available</span>
                                </p>
                                <p class="text-sm">{{ $product->product_description }}</p>
                            </div>
                            <p class="font-medium">IDR {{ number_format($product->product_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <livewire:user.purchase-details :product="$product" />
        </div>
    </div>
@endsection