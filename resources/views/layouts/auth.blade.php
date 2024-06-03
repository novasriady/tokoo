<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/255fd51aa4.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <title>Toko Ayu Elektrik - @yield('title')</title>
</head>
<body>
    <main>
        <div class="flex items-center justify-center h-screen">
            @yield('content')
        </div> 
    </main>   
</body>
</html>