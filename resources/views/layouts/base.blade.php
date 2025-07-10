<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'Ma Bibliothèque')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body ">

    @include('layouts.navbar')

    <main class="flex-grow p-6">
        @yield('content')
    </main>

    @include('layouts.footer')

    @stack('scripts')
</body>
</html>
