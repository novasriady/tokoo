@extends('layouts.user')

@section('title', 'Home')

@section('content')
    {{-- Hero --}}
    <div class="hero min-h-screen"
        style="background-image: url('{{ asset('assets/img/banner.png') }}');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Selamat Datang di Toko Ayu Elektrik</h1>
                <p class="mb-5">Toko ini menyediakan berbagai peralatan elektronik dan listrik</p>
            </div>
        </div>
    </div>
    {{-- Product --}}
    <section class="mt-20 w-full px-12" id="productSection">
        <div class="flex flex-col gap-8">
            <div class="flex flex-col gap-2">
                <h1 class="font-semibold text-2xl text-center">Produk Pilihan</h1>
                <p class="text-center">Pilih produk yang Anda inginkan sekarang!</p>
            </div>
            <div class="grid grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($products as $product)
                    <div class="card card-compact w-full bg-slate-400 rounded-xl shadow-md">
                        <figure class="h-56 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->product_img) }}" alt="Product Image" class="w-full" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->product_name }}</h2>
                            <h2 class="card-title text-red-600 text-bold">Rp.{{ $product->product_price }}</h2>
                            <div class="card-actions justify-start mt-2">
                                <a href="{{ route('user.productDetails', ['product_id' => $product->product_id]) }}" class="btn bg-gray-800 text-white btn-sm">Pesan</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Categories --}}
    <section class="mt-20 w-full px-12">
        <div class="flex flex-col gap-8">
            <div class="flex flex-col gap-2">
                <h1 class="font-semibold text-2xl text-center">Kategori Produk</h1>
                <p class="text-center">Berbagai macam kategori produk untuk dipilih.</p>
            </div>
            <div class="grid grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($categories as $category)
                    <div class="card w-full h-52 bg-white rounded-xl shadow-md image-full">
                        <figure>
                            <img src="{{ asset('/storage/' . $category->category_img) }}" alt="Shoes" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ $category->category_name }}</h2>
                            <p>{{ $category->category_description }}</p>
                            <div class="card-actions justify-start mt-2">
                                <a href="{{ route('user.product') }}" class="btn bg-gray-800 text-white btn-sm border-none">Cek Sekarang</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
