<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Ayu Elektrik - @yield('title')</title>
    <script src="https://kit.fontawesome.com/255fd51aa4.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body>
    <div class="flex min-h-screen">
        @include('components/admin/sidebar')

        <!-- Content -->
        <div class="flex-1 ml-52">
            <livewire:admin.navbar />
            <div class="mt-24 mb-12 px-8">
                @yield('content')
            </div>
        </div>
    </div>

    @livewireScripts
</body>

</html>
