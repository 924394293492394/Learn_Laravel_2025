@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">{{ isset($post) ? 'Редактирование поста' : 'Новый пост' }}</h1>

    <form method="POST" action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @isset($post) @method('PUT') @endisset

        <!-- Поле "Заголовок" -->
        <div>
            <label class="block text-gray-700 mb-2">Заголовок *</label>
            <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}"
                class="w-full rounded-md border-gray-300 @error('title') border-red-500 @enderror">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Поле "Категория" -->
        <div>
            <label class="block text-gray-700 mb-2">Категория *</label>
            <select name="category_id" class="w-full rounded-md border-gray-300">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Поле "Теги" -->
        <div>
            <label class="block text-gray-700 mb-2">Теги</label>
            <select name="tags[]" multiple class="w-full rounded-md border-gray-300" size="4">
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Поле "Изображение" -->
        <div>
            <label class="block text-gray-700 mb-2">Изображение</label>
            <input type="file" name="image" class="w-full">
            @if (isset($post) && $post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="mt-2 w-32">
            @endif
            @if (isset($post) && $post->image)
            <div class="mt-2">
                <label class="flex items-center">
                    <input type="checkbox" name="remove_image" class="mr-2">
                    <span class="text-red-600">Удалить изображение</span>
                </label>
            </div>
            @endif
        </div>

        <!-- Поле "Контент" -->
        <div>
            <label class="block text-gray-700 mb-2">Содержание *</label>
            <textarea name="content" rows="6"
                class="w-full rounded-md border-gray-300 @error('content') border-red-500 @enderror">{{ old('content', $post->content ?? '') }}</textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Кнопка Предпросмотр -->
        <div class="mt-2">
            <button type="button"
                onclick="document.getElementById('preview').innerText = document.querySelector('textarea[name=content]').value"
                class="bg-gray-200 px-4 py-2 rounded-md hover:bg-gray-300">
                Предпросмотр
            </button>
        </div>

        <!-- Блок предпросмотра -->
        <div id="preview" class="mt-4 p-4 bg-gray-50 rounded-md border border-gray-300 whitespace-pre-wrap"></div>

    </form>
</div>
@endsection

@if ($errors->any())
<div class="bg-red-100 text-red-700 p-4 rounded-md mb-6">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif