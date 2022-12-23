<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            
            return response()
                ->json([
                    'message' => 'No autorizado, credenciales Incorrectas..!',
                    'error_codigo' => '401'
                ]);

        }
 
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json([
                'accessToken' => $token,
                'token_type' => 'Bearer',
                'statusText' => 'Ok',
                'user' => $user
            ]);
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $token = $request->session()->regenerateToken();

        return response()
            ->json([
                'accessToken' => $token,
                'token_type' => ''
            ]);
    }
}
