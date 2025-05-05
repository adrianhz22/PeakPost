<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class PostController extends Controller
{

    use AuthorizesRequests;

    /**
     * @OA\Get(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="Obtener todos los posts aprobados",
     *     @OA\Response(
     *         response="200",
     *         description="Listado de posts aprobados"
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autenticado"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Post::where('status', 'approved')->get(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="Crear un nuevo post",
     *     @OA\Response(
     *         response="201",
     *         description="Post creado"
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autenticado"
     *     )
     * )
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'image' => $request->image,
            'province' => $request->province,
            'difficulty' => $request->difficulty,
            'longitude' => $request->longitude,
            'altitude' => $request->altitude,
            'time' => $request->time,
            'track' => $request->track,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return response()->json($post, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Obtener un post por ID",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del post"
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Post encontrado"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Post no encontrado"
     *     )
     * )
     */
    public function show(Post $post)
    {
        return response()->json($post, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Actualizar un post",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del post"
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Post actualizado"
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autenticado"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Post no encontrado"
     *     )
     * )
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->all());

        return response()->json($post, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Eliminar un post",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del post"
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Post eliminado"
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autenticado"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Post no encontrado"
     *     )
     * )
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return response()->json(['message' => 'Post eliminado'], 200);
    }
}
