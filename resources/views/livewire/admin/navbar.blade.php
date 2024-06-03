<nav class="fixed top-0 left-52 right-0 w-auto z-10 bg-white px-8 py-2 border-b border-gray-200">
    <div class="flex items-center justify-between">
        <p class="font-semibold">Selamat Datang, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
        <div class="flex flex-col gap-1">
            <div class="px-4 py-2 transition-all cursor-pointer duration-300 rounded-lg hover:bg-gray-200" wire:click="toggleProfileBox">
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
                <div class="p-2 bg-white w-36 rounded-md absolute top-16 shadow-sm">
                    <ul class="flex flex-col gap-1">
                        <li class="px-4 py-2 cursor-pointer rounded-md transition-all duration-300 hover:bg-gray-200">
                            <a href="{{ route('auth.logoutAction') }}" class="flex items-center gap-3">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="text-sm">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>
