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
    // Ruta de inicio para usuarios autenticados
    Route::get('/home', [NewsController::class, 'home'])->name('home'); // Llama al método home() del NewsController

    // Ruta para mostrar todas las categorías
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
});

// Ruta para mostrar el formulario de creación de noticias (asegurarse de que esté dentro del middleware de autenticación)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
});

// Rutas para noticias
Route::get('/news', [NewsController::class, 'index']);  // Obtener todas las noticias
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show'); // Vista de una noticia
Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit'); // Formulario de edición
Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update'); // Actualizar noticia
Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

// Ruta para listar todas las categorías
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Ruta para listar noticias de una categoría específica
Route::get('/categories/{id}', [CategoryController::class, 'news'])->name('categories.news');

// Ruta para mostrar las noticias de una categoría específica
Route::get('/categories/{id}/news', [CategoryController::class, 'news'])->name('categories.news');

// Rutas para comentarios
Route::post('/news/{newsId}/comments', [CommentController::class, 'store'])->name('news.comments.store')->middleware('auth:sanctum'); // Crear comentario
Route::get('/news/{newsId}/comments', [CommentController::class, 'getComments']);  // Obtener comentarios de una noticia
Route::put('/comments/{id}', [CommentController::class, 'update']);  // Editar comentario
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth:sanctum'); // Eliminar comentario

// Rutas para categorías
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show'); // Noticias por categoría
