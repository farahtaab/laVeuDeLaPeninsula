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

        // Responder con el comentario creado
        return response()->json([
            'message' => 'Comentario creado con éxito.',
            'comment' => $comment->load('user:id,name'), // Incluir el nombre del usuario
        ], 201);
    }


    /**
     * Eliminar un comentario propio.
     */
    public function destroy($id)
    {
        // Buscar el comentario
        $comment = Comment::findOrFail($id);

        // Verificar que el usuario autenticado es el dueño del comentario
        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar este comentario.',
            ], 403);
        }

        // Eliminar el comentario
        $comment->delete();

        return response()->json([
            'message' => 'Comentario eliminado con éxito.',
        ]);
    }
}
