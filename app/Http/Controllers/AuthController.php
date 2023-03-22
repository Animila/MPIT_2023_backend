<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        $validatedData = $request->validated();

        $user = User::create([
            'tel' => $validatedData['tel'],
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'password' => Hash::make($validatedData['password']),
        ]);

        if(!$user) {
            return response()->json([
                'message' => 'Ошибка регистрации',
                'error' => "Проблемы на стороне сервера"
            ], 500);
        }

        return response()->json([
            'message' => 'Регистрация успешно завершена',
            'user' => $user
        ], 201);
    }

    public function login(LoginRequest $request) {
        $validatedData = $request->validated();
        $user = User::where('tel', $validatedData['tel'])->first();
        if($user == null) {
            return response()->json([
                'message' => 'Нет такого аккаунта',
            ], 401);
        }
        if(!Hash::check($validatedData['password'], $user->password)) {
            return response()->json([
                'message' => 'Неправильный пароль',
            ], 401);
        }
        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'message' => 'Авторизация успешно завершена',
            'user' => $user,
            'token'=> $token
        ]);



    }
}
