<?php

namespace App\Http\Controllers\API;

use App\Mail\UserCreatedEmail;
use App\Http\Controllers\Controller;
use App\Http\Resources\userResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


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
    public function showuser()
    {
        $id = Auth::id();
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
            'password' => 'required|string',
            'role' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'telephone' => $request->input('telephone'),
            'adresse' => $request->input('adresse'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->assignRole($request->input('role'));

        foreach ($request->input('permissions') as $permission) {
            $user->givePermissionTo($permission);
        }

        if ($user) {
            $array = [
                'data' => new UserResource($user),
                'message' => 'The user is saved',
                'status' => 201,
            ];
    
            $email = $request->input('email');
            $password = $request->input('password');
    
            Mail::to($email)->send(new UserCreatedEmail($email, $password));
    
            return response()->json($array);
        }

        return response()->json(['message' => 'The user is not saved'], 400);
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
    public function updateUser(Request $request)
{
    $id = Auth::id();
    $user = User::find($id);
    
    if (!$user) {
        return response()->json([
            'data' => null,
            'message' => 'User not found',
            'status' => 404,
        ], 404);
    }

    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|unique:users,telephone,'.$user->id,
        'email' => 'required|email|unique:users,email,'.$user->id,
        'adresse' => 'required|string',
    ]);

    $user->update($validatedData);

    return response()->json([
        'data' => new UserResource($user),
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

    public function getUser(Request $request)
    {
        return response([
            'user' => $request->user(),
            'role' => $request->user()->Roles()->get()[0]["name"],
            'permissions' => $request->user()->Permissions()->get()->map(function ($permission) {
                return $permission->name;
            }),
        ]);
    }
}