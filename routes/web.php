<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
// Статические страницы
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/post/{slug}', [PageController::class, 'showPost'])->name('post.show');
Route::resource('posts', PostController::class);

// Route::get('/', function () {
//     return view('welcome');
// });

// Динамический маршрут с параметром
Route::get('/post/{slug}', function ($slug) {
    return view('pages.post', ['slug' => $slug]);
})->where('slug', '[a-z0-9-]+');