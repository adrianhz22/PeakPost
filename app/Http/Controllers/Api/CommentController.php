<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{

    use AuthorizesRequests;

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

    /**
     * @OA\Post(
     *     path="/api/comments",
     *     summary="Crear comentario",
     *     tags={"Comments"},
     *     @OA\Response(
     *         response=201,
     *         description="Comentario creado"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Datos inválidos"
     *     )
     * )
     */

    public function store(CommentRequest $request)
    {
        $comment = Comment::create([
            'content' => $request->input('content'),
            'parent_id' => $request->parent_id,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ]);

        return response()->json($comment, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/comments/{id}",
     *     summary="Actualizar comentario",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del comentario"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comentario actualizado"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No autorizado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comentario no encontrado"
     *     )
     * )
     */

    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update([
            'content' => $request->input('content'),
            'parent_id' => $request->parent_id,
        ]);

        return response()->json($comment);
    }

    /**
     * @OA\Delete(
     *     path="/api/comments/{id}",
     *     summary="Eliminar comentario",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del comentario"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Comentario eliminado"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No autorizado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comentario no encontrado"
     *     )
     * )
     */

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(null, 204);
    }
}
