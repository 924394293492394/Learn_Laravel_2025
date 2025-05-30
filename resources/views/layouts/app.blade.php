<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Блог' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-gray-300 to-gray-100">
    <!-- Навигационное меню -->
    <nav class="bg-white border-b border-gray-400 shadow-xl">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">


                <!-- Главное меню (широко раскидано) -->
                <div class="flex justify-between items-center w-full px-16 text-lg font-medium">
                <a href="{{ route('home') }}" class="text-3xl font-extrabold text-gray-800 hover:text-blue-600 transition">
                    📝 Блог
                </a>    
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 transition">О нас</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 transition">Контакты</a>
                    <a href="{{ route('posts.index') }}" class="text-gray-700 hover:text-blue-600 transition">Посты</a>
                </div>


                <!-- Кнопка входа -->
                <div>
                    <a href="{{ route('contact') }}" class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition">
                        Войти
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Контент страницы -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>