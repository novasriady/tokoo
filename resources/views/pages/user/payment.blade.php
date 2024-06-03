@extends('layouts.user')

@section('title', 'Pembayaran')

@section('content')
    <div class="px-12 my-8">
        <div class="grid grid-cols-2 gap-x-6">
            <livewire:user.payment.payment-list />
            <livewire:user.payment.payment-details />
        </div>
    </div>
@endsection
