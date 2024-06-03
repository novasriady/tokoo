@extends('layouts.user')

@section('title', 'Keranjang')

@section('content')
    <div class="px-12 my-8">
        <div class="grid grid-cols-2 gap-x-6">
            <livewire:user.cart.cart-list />
            <livewire:user.cart.cart-details />
        </div>
    </div>
@endsection
