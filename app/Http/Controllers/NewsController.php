<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Obtener todas las noticias
    public function index()
    {
        $news = News::with('category')->get();
        return response()->json($news);
    }

    // Mostrar noticias en la página principal (home)
    public function home()
    {
        // Obtener las últimas 14 noticias
        $news = News::latest()->take(14)->get();
        return view('home', compact('news'));
    }

    // Mostrar noticias de una categoría específica
    public function byCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId); // Buscar la categoría
        $news = $category->news()->latest()->paginate(10); // Obtener noticias relacionadas
        return view('categories.show', compact('category', 'news'));
    }

    // Mostrar una noticia individual
    public function show($id)
    {
        $news = News::findOrFail($id); // Buscar la noticia
        return view('news.show', compact('news'));
    }

    // Crear una nueva noticia
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'image_url' => 'required|url'
        ]);

        $news = News::create($request->all());
        return response()->json($news, 201);
    }

    // Editar una noticia existente
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $news->update($request->all());
        return response()->json($news);
    }

    // Eliminar una noticia
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return response()->json(['message' => 'News deleted successfully']);
    }
}
