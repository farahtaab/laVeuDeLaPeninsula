<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas autenticadas
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Ruta para mostrar todas las categorías
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
});

Route::get('/home', [NewsController::class, 'home'])->name('home'); // Noticias en el home

Route::get('/news', [NewsController::class, 'index']);  // Obtener todas las noticias
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show'); // Vista de una noticia
Route::get('/news/category/{categoryId}', [NewsController::class, 'getByCategory']);  // Obtener noticias por categoría
Route::post('/news', [NewsController::class, 'store']);  // Crear noticia
Route::put('/news/{id}', [NewsController::class, 'update']);  // Editar noticia
Route::delete('/news/{id}', [NewsController::class, 'destroy']);  // Eliminar noticia

// Ruta para listar todas las categorías
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Ruta para mostrar las noticias de una categoría específica
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/news/{newsId}/comments', [CommentController::class, 'getComments']);  // Obtener comentarios de una noticia
Route::put('/comments/{id}', action: [CommentController::class, 'update']);  // Editar comentario

// Ruta para crear un comentario en una noticia
Route::post('/news/{newsId}/comments', [CommentController::class, 'store'])->name('news.comments.store')->middleware('auth:sanctum');

// Eliminar un comentario propio
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth:sanctum');
