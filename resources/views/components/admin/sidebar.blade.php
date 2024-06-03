<div class="fixed top-0 left-0 w-52 h-screen bg-white px-4 py-6 border-r border-gray-200 z-20">
    <h2 class="text-xl font-bold mb-6">Toko Ayu Elektrik Admin</h2>
    <ul class="flex flex-col gap-3">
        <li class="px-4 py-2 cursor-pointer rounded-md transition-all duration-300 hover:bg-gray-200">
            <a class="flex items-center gap-3" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>
        <li class="px-4 py-2 cursor-pointer rounded-md transition-all duration-300 hover:bg-gray-200">
            <a class="flex items-center gap-3" href="{{ route('admin.product') }}">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="text-sm">Produk</span>
            </a>
        </li>
        <li class="px-4 py-2 cursor-pointer rounded-md transition-all duration-300 hover:bg-gray-200">
            <a class="flex items-center gap-3" href="{{ route('admin.category') }}">
                <i class="fa-solid fa-list"></i>
                <span class="text-sm">Kategori</span>
            </a>
        </li>
        <li class="px-4 py-2 cursor-pointer rounded-md transition-all duration-300 hover:bg-gray-200">
            <a class="flex items-center gap-3" href="{{ route('admin.order') }}">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="text-sm">Pesanan</span>
            </a>
        </li>
    </ul>
</div>
