@extends('layouts.admin')

@section('title', 'Produk')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <div class="flex flex-col">
                <h1 class="text-lg font-semibold">Produk</h1>
                <div class="text-sm breadcrumbs">
                    <ul>
                        <li>
                            <a>Admin</a>
                        </li>
                        <li>
                            <a>Produk</a>
                        </li>
                    </ul>
                </div>
            </div>
            <button class="btn btn-sm bg-gray-800 text-white" onclick="addNewProductModal.showModal()">Tambah Produk</button>
        </div>
        <div class="card bg-white">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>{{ $product->product_description }}</td>
                                    <td>IDR {{ number_format($product->product_price, 0, ',', '.') }}</td>
                                    <td>{{ $product->product_stock }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $product->product_img) }}" alt="Product Img" class="w-16 rounded-md">
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.deleteProduct', ['product_id' => $product->product_id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-error text-white btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Add New Product Modal --}}
    <dialog id="addNewProductModal" class="modal">
        <div class="modal-box">
            <div class="flex items-center justify-between">
                <p class="font-semibold text-lg">Tambah Produk</p>
                <form method="dialog">
                    <button class="btn btn-sm">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>
            </div>
            <div class="divider"></div>
            <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Nama Produk</label>
                        <input type="text" placeholder="Nama Produk" name="product_name"
                            class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Nama Kategori</label>
                        <select class="select select-sm select-bordered w-full" name="product_category_id" required>
                            <option disabled selected>Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Deskripsi</label>
                        <input type="text" placeholder="Deskripsi" name="product_description"
                            class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Harga</label>
                        <input type="number" placeholder="Harga" name="product_price"
                            class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Stok</label>
                        <input type="number" placeholder="Stok" name="product_stock"
                            class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Gambar</label>
                        <input type="file" accept="image/*" name="product_img" class="file-input file-input-bordered file-input-sm  w-full" required>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-sm bg-gray-800 text-white">Buat Produk</button>
                </div>
            </form>
        </div>
    </dialog>
@endsection
