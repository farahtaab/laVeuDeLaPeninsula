<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Obtener comentarios de una noticia específica.
     */
    public function getComments($newsId)
    {
        $comments = Comment::where('news_id', $newsId)
            ->with('user:id,name') // Incluye el nombre del usuario
            ->latest()
            ->get();

        return response()->json($comments);
    }

    /**
     * Crear un nuevo comentario en una noticia.
     */
    public function store(Request $request, $newsId)
    {
        // Validar la entrada
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Verificar que la noticia exista
        $news = News::findOrFail($newsId);

        // Crear el comentario
        $comment = Comment::create([
            'content' => $request->input('content'),
            'news_id' => $news->id,
            'user_id' => Auth::id(), // El usuario autenticado
        ]);

        // Redirigir a la página de la noticia con un mensaje de éxito
    return redirect()->route('news.show', ['id' => $newsId])
    ->with('success', 'Comentario creado con éxito.');
    }


    public function destroy(Request $request, $id)
{
    $comment = Comment::findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
    }

    $comment->delete();

    // Redirige a la página anterior si no es una solicitud JSON
    return redirect()->route('news.show', ['id' => $comment->news_id])
        ->with('success', 'Comentario eliminado con éxito.');
}

    
}