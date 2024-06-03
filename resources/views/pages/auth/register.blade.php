@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card bg-white shadow-md rounded-xl h-fit w-[28rem]">
    <div class="card-body">
        <h1 class="font-semibold text-lg">Toko Ayu Elektrik Daftar</h1>
        <div class="divider my-0"></div>
        <form action="{{ route('auth.registerAction') }}" method="POST">
            @csrf
            <div class="flex flex-col gap-4">
                <div class="grid grid-cols-2 gap-x-4 gap-y-4">
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Nama Awal</label>
                        <input type="text" placeholder="Nama Awal" name="firstname" class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Nama Akhir</label>
                        <input type="text" placeholder="Nama Akhir" name="lastname" class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Username</label>
                        <input type="text" placeholder="Username" name="username" class="input input-bordered input-sm w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Email</label>
                        <input type="email" placeholder="Email" name="email" class="input input-bordered input-sm w-full" required>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label-text">Password</label>
                    <input type="password" placeholder="Password" name="password" class="input input-bordered input-sm w-full" required>
                </div>
                <button type="submit" class="btn btn-sm bg-gray-800 text-white">Daftar</button>
            </div>
        </form>
        <div class="mt-6">
            <p class="text-sm text-center">
                Sudah memiliki akun? 
                <a href="{{ route('auth.login') }}" class="underline text-blue-600">Masuk sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection