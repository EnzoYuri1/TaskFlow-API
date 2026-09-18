<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Autentica o usuário e gera um token de acesso via Laravel Sanctum.
     *
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        // Validação básica de credenciais
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenta autenticar o usuário com as credenciais fornecidas
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Gera um novo Personal Access Token do Sanctum
            $token = $user->createToken('access_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login realizado com sucesso!',
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                ],
            ], 200, [], JSON_UNESCAPED_UNICODE);
        }

        // Caso a autenticação falhe, retorna erro de validação
        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas estão incorretas.'],
        ]);
    }

    /**
     * Revoga o token de acesso atual do usuário, encerrando a sessão da API.
     */
    public function logout(Request $request): JsonResponse
    {
        // Deleta o token que foi utilizado para autenticar a requisição atual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout realizado com sucesso!',
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
