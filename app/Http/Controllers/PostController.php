<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'latest');

        $query = Post::with(['category', 'tags', 'comments']);

        switch ($sort) {
            case 'popular':
                $query->withCount('comments')->orderBy('comments_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $posts = $query->paginate(10);
        return view('posts.index', compact('posts', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url',
        ]);

        // Указываем, что пост принадлежит текущему пользователю
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image_url' => $validated['image_url'] ?? null,
            'user_id' => auth()->id(), // Добавляем ID авторизованного пользователя
        ]);

        return redirect()->route('posts.index')->with('success', 'Пост успешно создан!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['category', 'tags', 'comments', 'media'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        app()->setLocale('ru');
        $validated = $request->validate([
            'title' => 'required|max:255|unique:posts,title,' . $post->id,  // поправил уникальность для обновления
            'content' => 'required|min:50',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // Обновляем основные поля
        $post->update($validated);

        // Обновляем теги
        $post->tags()->sync($request->tags);

        // Загрузка нового изображения (если есть)
        if ($request->hasFile('image')) {
            // Удаляем старое изображение, если оно есть
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            $path = $request->file('image')->store('posts', 'public');
            $post->update(['image' => $path]);
        }

        // Удаление изображения по чекбоксу "Удалить изображение"
        if ($request->has('remove_image')) {
            if ($post->image) {
                Storage::delete('public/' . $post->image);
                $post->update(['image' => null]);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Пост обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост удален!');
    }

    public function destroyFile(Media $media)
    {
        Storage::disk('s3-fake')->delete($media->path);
        $media->delete();
        return back()->with('success', 'Файл удалён!');
    }
}
