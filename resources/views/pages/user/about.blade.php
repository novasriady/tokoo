@extends('layouts.user')

@section('title', 'Tentang Kami')

@section('content')
    <section class="px-12 my-16">
        <div class="flex flex-col items-center gap-4">
            <div class="flex flex-col items-center gap-2">
                <h1 class="font-semibold text-2xl">Hubungi Kami</h1>
                <p class="text-gray-500">Kami bersedia setiap saat untuk melayani anda.</p>
            </div>
            <div class="grid grid-cols-3 gap-x-6 mt-6">
                <div class="card rounded-lg shadow border">
                    <div class="card-body">
                        <div class="flex gap-4">
                            <i class="fa-solid fa-location-dot text-2xl"></i>
                            <div class="flex flex-col gap-2">
                                <h2 class="font-semibold text-xl">Lokasi</h2>
                                <p class="text-gray-500">Jl. Hayam Wuruk No.39C, Kwarungan, Kalongan, Kec. Purwodadi, Kabupaten Grobogan, Jawa Tengah 58114</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card rounded-lg shadow border">
                    <div class="card-body">
                        <div class="flex gap-4">
                            <i class="fa-solid fa-volume-control-phone text-2xl"></i>
                            <div class="flex flex-col gap-2">
                                <h2 class="font-semibold text-xl">Kontak</h2>
                                <div class="flex flex-col gap-1">
                                    <p class="text-gray-500">
                                        Mobile: <strong>085845732344</strong>
                                    </p>
                                    <p class="text-gray-500">
                                        Phone: <strong>085845732344</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card rounded-lg shadow border">
                    <div class="card-body">
                        <div class="flex gap-4">
                            <i class="fa-solid fa-envelope text-2xl"></i>
                            <div class="flex flex-col gap-2">
                                <h2 class="font-semibold text-xl">Jam Operasional</h2>
                                <p class="text-gray-500">
                                    Senin - Jumat: <strong>10.00 - 21.00</strong>
                                </p>
                                <p class="text-gray-500">
                                    Sabtu - Minggu: <strong>09.00 - 22.00</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
