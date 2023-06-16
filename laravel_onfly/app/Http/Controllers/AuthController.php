<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Interfaces\Auth\AuthInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(){
        auth()->setDefaultDriver('api'); 
    }

    public function login(Request $request)
    {

        $token = \JWTAuth::attempt($request->only('email', 'password'));
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não autorizado',
            ], 401);
        }
        $user = Auth::user();


        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
      }
      public function register(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        if($data){
            return response()->json([
                'status' => 'success',
                'message' => 'Usuário criado com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Houve erros ao processar sua solicitação'
        ], 400);
    }
}
