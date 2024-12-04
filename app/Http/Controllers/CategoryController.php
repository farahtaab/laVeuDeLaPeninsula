<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Método para listar todas las categorías
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function news($id)
    {
        $category = Category::findOrFail($id); // Encuentra la categoría o lanza error 404.
        $news = $category->news()->latest()->paginate(10); // Obtén las noticias paginadas.
    
        return view('categories.index', compact('category', 'news')); // Usa 'index' para mostrar las noticias.
    }    

}
