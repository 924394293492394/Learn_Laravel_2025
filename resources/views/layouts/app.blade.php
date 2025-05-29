<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Блог' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Навигационное меню -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">Мой Блог</a>

                <!-- Главное меню (всегда отображается) -->
                <div class="flex space-x-8">
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">О нас</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 hover:text-gray-800">Контакты</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Контент страницы -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>