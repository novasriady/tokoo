@extends('layouts.admin')

@section('title', 'Product')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <div class="flex flex-col">
                <h1 class="text-lg font-semibold">Product</h1>
                <div class="text-sm breadcrumbs">
                    <ul>
                        <li>
                            <a>Admin</a>
                        </li>
                        <li>
                            <a>Product</a>
                        </li>
                    </ul>
                </div>
            </div>
            <button class="btn btn-sm bg-gray-800 text-white" onclick="addNewProductModal.showModal()">Add New</button>
        </div>
        <div class="card bg-white">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Image</th>
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
                <p class="font-semibold text-lg">Add New Product Form</p>
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
                        <label class="label-text">Name</label>
                        <input type="text" placeholder="Product Name" name="product_name"
                            class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Name</label>
                        <select class="select select-sm select-bordered w-full" name="product_category_id" required>
                            <option disabled selected>Product Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Description</label>
                        <input type="text" placeholder="Product Description" name="product_description"
                            class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Price</label>
                        <input type="number" placeholder="Product Price" name="product_price"
                            class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Stock</label>
                        <input type="number" placeholder="Product Stock" name="product_stock"
                            class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Image</label>
                        <input type="file" accept="image/*" name="product_img" class="file-input file-input-bordered file-input-sm  w-full" required>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-sm bg-gray-800 text-white">Create</button>
                </div>
            </form>
        </div>
    </dialog>
@endsection
