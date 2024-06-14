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
    {{-- Contact --}}
    <section>
        <div class="relative items-center w-full px-5 pt-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
            <div class="flex flex-col gap-2">
                <h1 class="font-semibold text-2xl text-center">Kenapa Harus Kami</h1>
            </div>
            <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
                <div class="p-6">
                    <img class="object-cover object-center w-full mb-4 lg:h-48 md:h-36 rounded-xl" src="https://i.postimg.cc/HxXSKBfm/11-removebg-preview.png" alt="blog">
    
                    <h1 class="mx-auto mb-4 font-semibold text-2xl text-center">Harga Bersaing</h1>
                    <p class="mx-auto text-base leading-relaxed text-center">Potongan harga khusus bagi anda yang membeli dalam jumlah banyak.</p>             
                </div>
                <div class="p-6">
                    <img class="object-cover object-center w-full mb-4 lg:h-48 md:h-36 rounded-xl" src="https://i.postimg.cc/sxznR5rh/22-removebg-preview.png" alt="blog">
    
                    <h1 class="mx-auto mb-4 font-semibold text-2xl text-center">Fast Respon</h1>
                    <p class="mx-auto text-base leading-relaxed text-center">Kami menjual berbagai macam alat listrik yang terbaik & terlengkap. Praktis dan menghemat waktu anda.</p>                
                </div>
                <div class="p-6">
                    <img class="object-cover object-center w-full mb-4 lg:h-48 md:h-36 rounded-xl" src="https://i.postimg.cc/BbCmZtSw/33-removebg-preview-1.png" alt="blog">
                    <h1 class="mx-auto mb-4 font-semibold text-2xl text-center">Gratis Pesan Antar</h1>
                    <p class="mx-auto text-base leading-relaxed text-center">Kami memberikan gratis pesan antar untuk domisili kabupaten grobogan.</p>                
                </div>
            </div>
        </div>
    </section>
    {{-- Product --}}
    <section class="mt-20 w-full px-12" id="productSection">
        <div class="relative flex flex-col gap-8">
            <div class="flex flex-col gap-2">
                <h1 class="font-semibold text-2xl text-center">Produk Pilihan</h1>
                <p class="text-center">Pilih produk yang Anda inginkan sekarang!</p>
            </div>
            <div class="grid grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($products as $product)
                    <div class="card card-compact w-full bg-white rounded-xl shadow-md">
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
