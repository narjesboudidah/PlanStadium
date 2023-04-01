<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\permission_roleResource;
use App\Models\permission_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class permission_rolesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $permission_roles = permission_roleResource::collection(permission_role::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $permission_roles,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $permission_role = permission_role::find($id);
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
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
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
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        if ($validator->fails()) {
            $array = [
                'data' => null,
                'message' => $validator->errors(),
                'status' => 400,
            ];
            //return response(null,400,[$validator->errors()]);
            return $array;
        }

        $permission_role = permission_role::find($id);
        if (!$permission_role) {
            $array = [
                'data' => null,
                'message' => 'The permission_role not Found',
                'status' => 404,
            ];
            return $array;
        }

        $permission_role->update($request->all());
        if ($permission_role) {
            $array = [
                'data' => new permission_roleResource($permission_role),
                'message' => 'The permission role update',
                'status' => 201,
            ];
            return response($array);
        }
    }


    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $permission_role = permission_role::find($id);
        if (!$permission_role) {
            $array = [
                'data' => null,
                'message' => 'The permission role not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $permission_role->delete($id);
        if ($permission_role) {
            $array = [
                'data' => null,
                'message' => 'The permission role delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}