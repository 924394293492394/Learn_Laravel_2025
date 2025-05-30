@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-8 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6">Создать новый пост</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Заголовок -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Заголовок:</label>
                <input type="text" name="title" class="w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Описание -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Описание:</label>
                <textarea name="content" class="w-full border border-gray-300 rounded p-2"></textarea>
            </div>

            <!-- Категория -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Категория:</label>
                <select name="category_id" class="w-full border border-gray-300 rounded p-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- URL изображения -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Ссылка на изображение:</label>
                <input type="text" name="image_url" class="w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Кнопка -->
            <div class="mt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-bold rounded">
                    Создать пост
                </button>
            </div>
        </form>
    </div>
@endsection
