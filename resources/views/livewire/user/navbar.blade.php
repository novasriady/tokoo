<nav class="px-12 py-2 bg-white">
    <div class="flex justify-between items-center">
        <p class="text-xl font-semibold">Toko Ayu Elektrik</p>
        <ul class="flex items-center gap-8">
            <li class="text-sm">
                <a href="{{ route('user.home') }}">Home</a>
            </li>
            <li class="text-sm">
                <a href="{{ route('user.product') }}">Produk</a>
            </li>
            <li class="text-sm">
                <a href="{{ route('user.about') }}">Tentang Kami</a>
            </li>
        </ul>
        @if (!Auth::check())
            <div class="flex items-center gap-4 py-2">
                <a href="{{ route('auth.login') }}" class="btn btn-outline border border-gray-800 btn-sm">Masuk</a>
                <a href="{{ route('auth.register') }}" class="btn btn-sm bg-gray-800 text-white">Daftar</a>
            </div>
        @else
            <div class="px-4 py-2 transition-all cursor-pointer duration-300 rounded-lg hover:bg-gray-200"
                wire:click="toggleProfileBox">
                <div class="flex items-center gap-4 cursor-pointer">
                    <p class="text-sm font-semibold">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                    <div class="w-10 h-10 flex items-center justify-center bg-gray-200 rounded-full">
                        <span class="font-bold">
                            {{ Auth::user()->firstname[0] }}
                        </span>
                    </div>
                </div>
            </div>
            @if ($isOpenProfileBox)
                <div class="p-2 bg-white w-36 rounded-md absolute top-16 right-12 shadow-sm z-10">
                    <ul class="flex flex-col gap-1">
                        <li class="px-4 py-2 cursor-pointer rounded-md transition-all duration-300 hover:bg-gray-200">
                            <a href="{{ route('user.payment') }}" class="flex items-center gap-3">
                                <i class="fa-solid fa-money-bill"></i>
                                <span class="text-sm">Pembayaran</span>
                            </a>
                        </li>
                        <li class="px-4 py-2 cursor-pointer rounded-md transition-all duration-300 hover:bg-gray-200">
                            <a href="{{ route('user.cart') }}" class="flex items-center gap-3">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="text-sm">Keranjang</span>
                            </a>
                        </li>
                        <li class="px-4 py-2 cursor-pointer rounded-md transition-all duration-300 hover:bg-gray-200">
                            <a href="{{ route('auth.logoutAction') }}" class="flex items-center gap-3">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="text-sm">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        @endif
    </div>
</nav>
