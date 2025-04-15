<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/comments",
     *     summary="Listar todos los comentarios",
     *     tags={"Comments"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de comentarios"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */

    public function index()
    {
        $comments = Comment::with(['user', 'post'])->get();
        return response()->json($comments, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/comments/{id}",
     *     summary="Mostrar un comentario especifico",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del comentario"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comentario encontrado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comentario no encontrado"
     *     )
     * )
     */

    public function show($id)
    {
        $comment = Comment::with(['user', 'post', 'replies.user'])->findOrFail($id);
        return response()->json($comment);
    }
}
