<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Obtener todas las categorías
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
}
