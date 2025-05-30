@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-10 bg-white rounded-lg shadow-xl">
        <h1 class="text-4xl font-bold text-gray-900 mb-10 text-center">📌 Все посты</h1>

        <!-- Фильтры и сортировка -->
        <div class="mb-8 flex justify-center space-x-6">
            <a href="{{ route('posts.index', ['sort' => 'latest']) }}" 
               class="px-6 py-3 bg-blue-600 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                🔥 Новые
            </a>
            <a href="{{ route('posts.index', ['sort' => 'popular']) }}" 
               class="px-6 py-3 bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-400 transition">
                ⭐ Популярные
            </a>
        </div>

        <!-- Список постов -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <div class="bg-gray-50 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             alt="{{ $post->title }}"
                             class="w-full h-56 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="flex items-center mb-2 text-gray-600 text-sm">
                            <span>{{ $post->created_at->format('d.m.Y') }}</span>
                            <span class="mx-2 text-gray-400">|</span>
                            <span class="text-blue-600">{{ $post->category->name }}</span>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ $post->title }}
                        </h2>
                        <p class="text-gray-700 mb-4">{{ Str::limit($post->content, 140) }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($post->tags as $tag)
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                        #{{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <a href="{{ route('posts.show', $post) }}" 
                               class="text-blue-600 font-medium hover:text-blue-800 transition">
                                Читать →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="mt-10 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection