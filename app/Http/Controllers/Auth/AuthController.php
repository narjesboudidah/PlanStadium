<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'telephone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'adresse' => 'required',
            'password' => 'required|string'/*.new isValidPassword()*/,
        ]);

        if ($validator->fails()) { //   ken fama mochkil
            return response('null', 400, [$validator->errors()]);
        }

        $user =  User::create([
            'nom' => $request["nom"],
            'prenom' => $request["prenom"],
            'telephone' => $request["telephone"],
            'adresse' => $request["adresse"],
            'email' => $request["email"],
            'email_verified_at' => now(),
            'password' => bcrypt($request["password"]),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => NULL,
        ]);
        $token = $user->createToken('123')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
        ],201);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'/*.new isValidPassword()*/,
        ]);

        if ($validator->fails()) { //   ken fama mochkil
            return response('null', 400, [$validator->errors()]);
        }

        $user = User::Where('email', $request["email"])->first();
        if(!$user || !Hash::check($request["password"],$user->password))
        {
            return response("bad infos",401);
        }

        $token = $user->createToken('mySecretKey')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
        ],201);
    }
}