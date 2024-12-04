<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function create()
{
    return view('home.create'); // O la vista donde quieres mostrar el formulario de crear noticia
}

}
