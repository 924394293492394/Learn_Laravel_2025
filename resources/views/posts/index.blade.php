@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Все посты</h1>

        <!-- Фильтры и сортировка -->
        <div class="mb-6 flex justify-between items-center">
            <div class="flex space-x-4">
                <a href="{{ route('posts.index', ['sort' => 'latest']) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Новые
                </a>
                <a href="{{ route('posts.index', ['sort' => 'popular']) }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Популярные
                </a>
            </div>
        </div>

        <!-- Список постов -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             alt="{{ $post->title }}"
                             class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="text-sm text-gray-600">
                                {{ $post->created_at->format('d.m.Y') }}
                            </span>
                            <span class="mx-2">•</span>
                            <span class="text-sm text-blue-600">
                                {{ $post->category->name }}
                            </span>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $post->title }}
                        </h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 150) }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                @foreach ($post->tags as $tag)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <a href="{{ route('posts.show', $post) }}" 
                               class="text-blue-600 hover:text-blue-800">
                                Читать →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
@endsection