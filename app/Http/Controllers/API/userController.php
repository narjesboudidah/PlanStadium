<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\userResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class userController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $users = userResource::collection(User::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $users,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            $array = [
                'data' => new userResource($user),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The user not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'telephone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'adresse' => 'required',
            'password' => 'required|string'/*.new isValidPassword()*/,
        ]);

        if ($validator->fails()) { 
            return response(null, 400, [$validator->errors()]);
        }


        $user =  User::create([
            'nom' => $request["nom"],
            'prenom' => $request["prenom"],
            'telephone' => $request["telephone"],
            'adresse' => $request["adresse"],
            'email' => $request["email"],
            'password' => bcrypt($request["password"]),
        ]);
        if ($user) {
            $array = [
                'data' => new userResource($user),
                'message' => 'The user save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The user not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $User = User::find($id);
        if (!$User) {
            return response()->json([
                'data' => null,
                'message' => 'User not found',
                'status' => 404,
            ], 404);
        }
    
        $validatedData = $request->validate([
            'nom' => 'max:255',
            'prenom' => 'max:255',
            'telephone' => 'unique:users',
            'email' => 'email|unique:users',
            'adresse' => 'string',
            'password' => 'string',
        ]);
    
        $User->update($validatedData);
    
        return response()->json([
            'data' => new userResource($User),
            'message' => 'User updated successfully',
            'status' => 201,
        ], 201);
    }


    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $user = User::find($id);
        if (!$user) {
            $array = [
                'data' => null,
                'message' => 'The user not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $user->delete($id);
        if ($user) {
            $array = [
                'data' => null,
                'message' => 'The user delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}