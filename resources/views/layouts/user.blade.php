<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Ayu Elektrik - @yield('title')</title>
    <script src="https://kit.fontawesome.com/255fd51aa4.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen">
    <livewire:user.navbar />
    <main class="flex-grow mb-24">
        @yield('content')
    </main>
    @include('components.user.footer')
</body>

</html>
