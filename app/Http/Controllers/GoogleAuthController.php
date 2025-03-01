<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
class GoogleAuthController extends Controller
{ 
    protected $auth;

    public function __construct()
    {
     $this->auth = app('firebase.auth');
    }

    public function loginWithGoogle(Request $request)
    {
        $request->validate([
            'idToken' => 'required|string',
        ]);

        try {
            // Verificar el token de Firebase
            $verifiedIdToken = $this->auth->verifyIdToken($request->idToken);
            $firebaseUser = $this->auth->getUser($verifiedIdToken->claims()->get('sub'));

            // Buscar usuario por email o firebase_uid
            $user = User::where('email', $firebaseUser->email)
                ->orWhere('firebase_uid', $firebaseUser->uid)
                ->first();

            if (!$user) {
                // Crear nuevo usuario con datos de Google
                $user = User::create([
                    'name' => explode(' ', $firebaseUser->displayName)[0] ?? 'Usuario',
                    'lastname' => explode(' ', $firebaseUser->displayName)[1] ?? 'Google',
                    'email' => $firebaseUser->email,
                    'password' => '', // No necesitamos contraseña para usuarios de Google
                    'firebase_uid' => $firebaseUser->uid,
                    'registration_method' => 'google',
                    'image' => $firebaseUser->photoUrl ?? 'https://images.vexels.com/content/145908/preview/male-avatar-maker-2a7919.png',
                ]);
            }


            // Generar token de Sanctum
            $token = $user->createToken('google-auth-token')->plainTextToken;

            return response()->json([
                'message' => 'Autenticación exitosa',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error en autenticación con Google',
                'error' => $e->getMessage(),
            ], 401);
        }
    }
}
