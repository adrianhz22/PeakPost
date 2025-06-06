<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Listar todos los usuarios",
     *     @OA\Response(
     *         response="200",
     *         description="Listado de usuarios"
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autenticado"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Crear un nuevo usuario",
     *     @OA\Response(
     *         response="201",
     *         description="Usuario creado"
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error de validación"
     *     )
     * )
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json($user, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Mostrar un usuario especifico",
     *     @OA\Response(
     *         response="200",
     *         description="Usuario encontrado"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Usuario no encontrado"
     *     )
     * )
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Actualizar un usuario",
     *     @OA\Response(
     *         response="200",
     *         description="Usuario actualizado"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Usuario no encontrado"
     *     )
     * )
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json($user, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Eliminar un usuario",
     *     @OA\Response(
     *         response="200",
     *         description="Usuario eliminado"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Usuario no encontrado"
     *     )
     * )
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado'], 200);
    }
}
