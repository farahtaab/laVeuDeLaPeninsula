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
Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit'); // Formulario de edición
Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update'); // Actualizar noticia
Route::post('/news', [NewsController::class, 'store']); // Crear noticia
Route::delete('/news/{id}', [NewsController::class, 'destroy']); // Eliminar noticia

// Ruta para noticias por categoría
Route::get('/news/category/{categoryId}', [NewsController::class, 'byCategory']); // Obtener noticias por categoría

Route::get('/news/{newsId}/comments', [CommentController::class, 'getComments']);  // Obtener comentarios de una noticia
Route::put('/comments/{id}', action: [CommentController::class, 'update']);  // Editar comentario

// Ruta para crear un comentario en una noticia
Route::post('/news/{newsId}/comments', [CommentController::class, 'store'])->name('news.comments.store')->middleware('auth:sanctum');

// Eliminar un comentario propio
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth:sanctum');
