<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\roleResource;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class rolesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $roles = roleResource::collection(role::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $roles,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }


    /*Display the specified resource.*/
    public function show($id)
    {
        $role = role::find($id);
        if ($role) {
            $array = [
                'data' => new roleResource($role),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The role not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'titre' => 'required|max:255',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $role = role::create($request->all());
        if ($role) {
            $array = [
                'data' => new roleResource($role),
                'message' => 'The role save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The role not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $role = role::find($id);
        if (!$role) {
            return response()->json([
                'data' => null,
                'message' => 'Role not found',
                'status' => 404,
            ], 404);
        }

        $validatedData = $request->validate([
            'titre' => Rule::unique('roles')->ignore($id),
        ]);
        $role->update($validatedData);

        return response()->json([
            'data' => new roleResource($role),
            'message' => 'Role updated successfully',
            'status' => 201,
        ], 201);
    }

    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $role = role::find($id);
        if (!$role) {
            $array = [
                'data' => null,
                'message' => 'The role not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $role->delete($id);
        if ($role) {
            $array = [
                'data' => null,
                'message' => 'The role delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}