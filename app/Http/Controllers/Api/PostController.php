<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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
    public function store(StorePostRequest $request)
    {
        $data = $this->processData($request);
        $post = Post::create($data);

        return response()->json($post, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Obtener un post por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del post",
     *         @OA\Schema(type="integer")
     *     ),
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
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del post",
     *         @OA\Schema(type="integer")
     *     ),
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
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $this->processData($request, $post);
        $post->fill($data)->save();

        return response()->json($post, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Eliminar un post",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del post",
     *         @OA\Schema(type="integer")
     *     ),
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


    private function processData($request, Post $post = null): array
    {
        $data = $request->validated();

        $data['image'] = $post?->image ?? null;
        $data['track'] = $post?->track ?? null;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts/images', 'public');
        }

        if ($request->hasFile('track')) {
            $data['track'] = $request->file('track')->store('posts/tracks', 'public');
        }

        $hours = (int)$request->input('duration_hours', 0);
        $minutes = (int)$request->input('duration_minutes', 0);
        $data['duration'] = ($hours * 60) + $minutes;

        $data['slug'] = Str::slug($data['title']);
        $data['status'] = 'pending';

        if (!$post) {
            $data['user_id'] = auth()->id();
        }

        if ($post) {
            $data['rejection_reason'] = null;
        }

        return $data;
    }

}
