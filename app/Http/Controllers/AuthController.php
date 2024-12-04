<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\EmailConfirmationMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email", "=", $request->email)->first();

        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
                //creamos el token
                $token = $user->createToken("auth_token")->plainTextToken;
                //si está todo ok
                return response()->json([
                    "status" => 1,
                    "msg" => "¡Usuario logueado exitosamente!",
                    "access_token" => $token
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "msg" => "Datos incorrectos",
                ], 404);
            }
        } else {
            return response()->json([
                "status" => 0,
                "msg" => "Usuario no registrado",
            ], 404);
        }
    }

    public function userProfile()
    {
        $user = Auth::guard('sanctum')->user();
        return response()->json([
            "status" => 0,
            "msg" => "Acerca del perfil de usuario",
            "data" => $user
        ]);
    }

    public function logout()
    {
        Auth::guard('sanctum')->user()->tokens()->delete();

        return response()->json([
            "status" => 1,
            "msg" => "Cierre de Sesión",
        ]);
    }
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password) //Encriptamos la contraseña al registrarlo
            ]);

            event(new Registered($user));
            DB::commit();
            return response()->json([
                "status" => 1,
                "msg" => "¡Registro de usuario exitoso!",
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack(); //Si hay un error, deshacemos la transacción para dejar la base de datos limpia.
            return response()->json([
                "status" => 1,
                "msg" => "Error",
                "error" => $th->getMessage(),
            ], 500);
        }
    }

    public function sendVerificationEmail(Request $request): JsonResponse
    {
        $user = Auth::guard("sanctum")->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'El correo ya fue verificado.'], 200);
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Correo de verificación enviado.'], 200);
    }
    public function verifyEmail(EmailVerificationRequest $request): JsonResponse
    {
        $user = Auth::guard("sanctum")->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'El correo ya fue verificado.'], 200);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json(['message' => 'Correo electrónico verificado exitosamente.'], 200);
    }
}
