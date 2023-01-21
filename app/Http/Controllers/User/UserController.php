<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;

use App\Models\UserModel;

use Validator;

class UserController extends Controller
{
    public function GetAllUsers()
    {
        return response()->json(UserModel::get(), 200);
    }

    public function GetUserById($id)
    {
        $user = UserModel::find($id);
        if (is_null($user)) {
            return response()->json([
                'error' => true,
                'message' => 'Not found'
            ], 404);
        }
        return response()->json($user, 200);
    }

    public function getUserInfo(Request $request)
    {
        try {
            // Отримати авторизаційний токен з заголовка
            $token = $request->header('Authorization');
            // Видалити префікс "Bearer" із токену
            $token = str_replace('Bearer ', '', $token);
            // Отримати інформацію про юзера, що аутентифікований за токеном
            $user = JWTAuth::toUser($token);
            // Повернути інформацію про юзера
            return response()->json($user);
        } catch (JWTException $e) {
            // Якщо виникла помилка при аутентифікації, повернути помилку
            return response()->json(['error' => 'invalid_token'], 401);
        }
    }

    public function CreateUser(Request $req)
    {
        //Перерка комірок
        $rules = [
            'name' => 'required|unique:users|min:3|max:12',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5|max:18'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hashedPassword = password_hash($req->password, PASSWORD_DEFAULT);

        // Створення нового користувача
        $user = new UserModel;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->skin_path = "1";
        $user->password = $hashedPassword;
        $user->created_at = \Carbon\Carbon::now()->timestamp;
        $user->updated_at = \Carbon\Carbon::now()->timestamp;
        $user->save();
        return response()->json($user, 201);
    }

    public function EditUser(Request $req, $id)
    {
        //Перевірка на наявність юзера
        $user = UserModel::find($id);
        if (is_null($user)) {
            return response()->json([
                'error' => true,
                'message' => 'Not found'
            ], 404);
        }


        if (!password_verify($req->password, $user->password)) {
            return response()->json([
                'error' => true,
                'message' => 'Bad password'
            ], 403);
        }

        //Перерка комірок
        $jsonArray = json_decode($user, true);
        $rules = [
            'name' => $req->has('name') ? ($user->name === $req->input('name') ? 'min:3|max:12' : 'unique:users|min:3|max:12') : '',
            'email' => $req->has('email') ? ($user->email === $req->input('email') ? 'email' : 'unique:users|email') : '',
            'newPassword' => $req->has('newPassword') ? 'min:5|max:18' : '',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $name = $req->name ? $req->name : $user->name;
        $email = $req->email ? $req->email : $user->email;
        $newPassword = $req->newPassword ? password_hash($req->newPassword, PASSWORD_DEFAULT) : $user->password;

        $updated_at = \Carbon\CarbonImmutable::now()->toDateTimeString();


        DB::table("users")
            ->where('id', $id)
            ->update(['name' => $name, 'email' => $email, 'password' => $newPassword, 'updated_at' => $updated_at]);
        return response()->json($user, 200);
    }

    public function DeleteUser(Request $req, UserModel $id)
    {
        //Перевірка на наявність юзера
        $user = UserModel::find($id)[0];
        if (is_null($user)) {
            return response()->json([
                'error' => true,
                'message' => 'Not found'
            ], 404);
        }

        $user->delete();
        return response()->json('', 204);
    }
}
