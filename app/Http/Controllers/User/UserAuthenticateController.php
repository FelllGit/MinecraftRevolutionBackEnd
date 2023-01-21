<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

use App\Models\UserModel;

class UserAuthenticateController extends Controller
{
    public function AuthenticateUser(Request $request)
    {
        // Отримуємо дані з форми входу
        $credentials = $request->only('email', 'password');

        // Шукаємо користувача за наданою адресою електронної пошти
        $user = UserModel::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        // Перевіряємо пароль
        if (!password_verify($credentials['password'], $user->password)) {
            return response()->json(['error' => 'invalid_password'], 401);
        }

        try {
            // Створюємо токен для користувача
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            // Якщо виникла помилка при створенні токену, повертаємо помилку
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // Якщо все добре, повертаємо токен
        return response()->json(compact('token'));
    }

    public function LogoutUser(Request $request)
    {
        // Знехтування токену
        JWTAuth::invalidate($request->token);

        return response()->json([
            'status' => 'success',
            'message' => 'Ви успішно вийшли з аккаунту.'
        ], 200);
    }
}
