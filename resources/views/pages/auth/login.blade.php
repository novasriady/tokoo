@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card bg-white shadow-md rounded-xl h-fit w-[22rem]">
    <div class="card-body">
        <h1 class="font-semibold text-lg">Thrift Login</h1>
        <div class="divider my-0"></div>
        <form action="{{ route('auth.loginAction') }}" method="POST">
            @csrf
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label class="label-text">Username</label>
                    <input type="text" placeholder="Username" name="username" class="input input-bordered input-sm w-full" required>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label-text">Password</label>
                    <input type="password" placeholder="Password" name="password" class="input input-bordered input-sm w-full" required>
                </div>
                <button type="submit" class="btn btn-sm bg-gray-800 text-white">Login</button>
            </div>
        </form>
        <div class="mt-6">
            <p class="text-sm text-center">
                Don't have account? 
                <a href="{{ route('auth.register') }}" class="underline text-blue-600">Register now</a>
            </p>
        </div>
    </div>
</div>
@endsection