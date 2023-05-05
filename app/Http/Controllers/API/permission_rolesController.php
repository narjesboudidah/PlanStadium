<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\permission_roleResource;
use App\Models\permission_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class permission_rolesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $permission_roles = permission_role::all();

        return response()->json([
            'data' => permission_roleResource::collection($permission_roles),
            'message' => 'ok',
            'status' => 200,
        ]);
    }

    /*Display the specified resource.*/
    public function show($role_id, $permission_id)
    {
        $permission_role = permission_role::where('role_id', $role_id)
            ->where('permission_id', $permission_id)
            ->first();

        if ($permission_role) {
            $array = [
                'data' => new permission_roleResource($permission_role),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The permission role pivot not found']);
    }



    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'role_id' => [
                'required',
                'exists:roles,id', Rule::unique('permission_role')->where(function ($query) use ($request) {
                    return $query->where('permission_id', $request->permission_id);
                })
            ],
            'permission_id' => 'required|exists:permissions,id',
        ]);


        if ($validator->fails()) {
            return response(null, 400, [$validator->errors()]);
        }

        $permission_role = permission_role::create($request->all());
        if ($permission_role) {
            $array = [
                'data' => new permission_roleResource($permission_role),
                'message' => 'The permission_role save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The permission_role not save']);

    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $role_id, $permission_id)
    {
        $permission_role = permission_role::where('role_id', $role_id)
            ->where('permission_id', $permission_id)
            ->first();
    
        if (!$permission_role) {
            return response()->json([
                'data' => null,
                'message' => 'Permission role not found',
                'status' => 404,
            ], 404);
        }
    
        $validatedData = $request->validate([
            'role_id' => [
                'required',
                'exists:roles,id',
                Rule::unique('permission_role')->where(function ($query) use ($request) {
                    return $query->where('permission_id', $request->permission_id);
                })
            ],
            'permission_id' => 'required|exists:permissions,id',
        ]);
    
        $permission_role->update($validatedData);
    
        return response()->json([
            'data' => new permission_roleResource($permission_role),
            'message' => 'Permission role updated successfully',
            'status' => 200,
        ], 200);
    }
    

    public function destroy($role_id, $permission_id)
{
    $permissionRole = permission_role::where('role_id', $role_id)
        ->where('permission_id', $permission_id)
        ->first();

    if (!$permissionRole) {
        return response()->json([
            'message' => 'The permission role was not found.',
        ], 404);
    }

    $permissionRole->delete();

    return response(null, 204);
}


}