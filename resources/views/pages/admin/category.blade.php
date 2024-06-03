@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <div class="flex flex-col">
                <h1 class="text-lg font-semibold">Kategori</h1>
                <div class="text-sm breadcrumbs">
                    <ul>
                        <li>
                            <a>Admin</a>
                        </li>
                        <li>
                            <a>Kategori</a>
                        </li>
                    </ul>
                </div>
            </div>
            <button class="btn btn-sm bg-gray-800 text-white" onclick="addNewCategoryModal.showModal()">Tambah Kategori</button>
        </div>
        <div class="card bg-white">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->category_description }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $category->category_img) }}" alt="Category Img" class="w-16 rounded-md">
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.deleteCategory', ['category_id' => $category->category_id]) }}" method="POST">
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
    {{-- Add New Category Modal --}}
    <dialog id="addNewCategoryModal" class="modal">
        <div class="modal-box">
            <div class="flex items-center justify-between">
                <p class="font-semibold text-lg">Tambah Kategori</p>
                <form method="dialog">
                    <button class="btn btn-sm">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>
            </div>
            <div class="divider"></div>
            <form action="{{ route('admin.storeCategory') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Nama</label>
                        <input type="text" placeholder="Nama Kategori" name="category_name" class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Deskripsi</label>
                        <input type="text" placeholder="Deskripsi Kategori" name="category_description" class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Gambar</label>
                        <input type="file" accept="image/*" name="category_img" class="file-input file-input-bordered file-input-sm  w-full" required>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-sm bg-gray-800 text-white">Buat Kategori</button>
                </div>
            </form>
        </div>
    </dialog>
@endsection
