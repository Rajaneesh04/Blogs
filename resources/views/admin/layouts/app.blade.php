<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 overflow-x-hidden">
    <div class="min-h-screen md:flex">
        @include('admin.partials.sidebar')
        <main class="flex-1 min-w-0 pb-20 md:pb-0">
            @yield('content')
        </main>
    </div>
</body>
</html>
