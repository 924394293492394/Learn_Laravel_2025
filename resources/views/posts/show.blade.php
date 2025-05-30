@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
        <p class="text-gray-800 text-lg mb-6">{{ $post->content }}</p>

        <!-- Проверяем наличие изображения по URL -->
        @if ($post->image_url)
            <div class="mb-6">
                <img src="{{ $post->image_url }}" class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>
        @endif

        <!-- Медиафайлы -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($post->media as $media)
                <div class="relative bg-gray-100 rounded-lg p-4 shadow-md">
                    @if (Str::startsWith($media->type, 'image'))
                        <img src="{{ Storage::disk('s3-fake')->url($media->path) }}" 
                             class="w-full h-48 object-cover rounded-md">
                    @else
                        <div class="p-4 text-gray-700 text-center">
                            📄 {{ basename($media->path) }}
                        </div>
                    @endif

                    <!-- Улучшенная кнопка удаления -->
                    <form method="POST" action="{{ route('posts.deleteFile', ['media' => $media->id]) }}" 
                          class="absolute top-4 right-4">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-black font-bold rounded-md 
                                                   shadow-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">
                            УДАЛИТЬ ФАЙЛ
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
