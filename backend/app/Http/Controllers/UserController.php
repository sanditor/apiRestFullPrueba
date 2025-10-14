<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // 🔐 LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'id' => $user->id,
            'name' => $user->name,
            'token' => $token
        ]);
    }

    // 🔒 LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada']);
    }

    // ✅ REGISTRO (requiere token si está en middleware)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201);
    }

    // 📄 LISTAR USUARIOS (restringido por auth)
    public function index()
    {
        return User::all();
    }

    // 🧍‍♂️ OBTENER USUARIO LOGUEADO POR ID
    public function getUserById(Request $request, $id)
    {
        // Verifica si el usuario autenticado coincide con el id solicitado
        $authUser = $request->user();

        if (!$authUser) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        // Solo permite traer su propio perfil, no el de otros
        if ($authUser->id != $id) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }

        return response()->json($authUser);
    }

    // ✏️ ACTUALIZAR USUARIO
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email'));
        return response()->json($user);
    }

    // ❌ ELIMINAR USUARIO
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado']);
    }
}
