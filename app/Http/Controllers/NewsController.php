<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
<<<<<<< HEAD
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
    
=======
    public function home()
{
    // Obtener las noticias más recientes o las noticias para mostrar en la página de inicio
    $news = News::latest()->take(5)->get(); // Obtén las últimas 5 noticias, por ejemplo

    // Asegúrate de pasar la variable $news a la vista
    return view('home', compact('news')); // Pasa $news a la vista 'home'
}

>>>>>>> df0ff5571bd50e0f9da3c0631f98ff76bec9529b
    // Mostrar una noticia individual
    public function show($id)
    {
        $news = News::with(['comments.user'])->findOrFail($id);
        return view('news.show', compact('news'));
    }

    // Editar una noticia existente
    public function edit($id)
    {
        // Encuentra la noticia por su ID
        $news = News::findOrFail($id);

        // Obtén todas las categorías para mostrar en el formulario
        $categories = Category::all();

        // Muestra la vista de edición con los datos de la noticia y categorías
        return view('news.edit', compact('news', 'categories'));
    }

    // Actualizar una noticia
    public function update(Request $request, $id)
    {
        // Buscar la noticia por su ID
        $news = News::findOrFail($id);
    
        // Validación de los datos recibidos
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url', // Solo si la imagen es opcional
        ]);
    
        // Actualizar la noticia
        $news->update($request->all());
    
        // Redirigir a la vista de la noticia con los cambios realizados
        return redirect()->route('news.show', $news->id);
    }
    

    // Eliminar una noticia
    public function destroy($id)
    {
        $news = News::findOrFail($id);
    
        // Eliminar la noticia
        $news->delete();
    
        return redirect()->route('home')->with('success', 'Noticia eliminada correctamente.');
    }
}
