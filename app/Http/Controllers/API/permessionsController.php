<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\permissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class permessionsController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $permissions = permissionResource::collection(permission::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $permissions,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $permission = permission::find($id);
        if ($permission) {
            $array = [
                'data' => new permissionResource($permission),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The permission not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $permission = permission::create($request->all());
        if ($permission) {
            $array = [
                'data' => new permissionResource($permission),
                'message' => 'The permission save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The permission not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
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

        $permission = permission::find($id);
        if (!$permission) {
            $array = [
                'data' => null,
                'message' => 'The permission not Found',
                'status' => 404,
            ];
            return $array;
        }

        $permission->update($request->all());
        if ($permission) {
            $array = [
                'data' => new permissionResource($permission),
                'message' => 'The permission update',
                'status' => 201,
            ];
            return response($array);
        }
    }


    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $permission = permission::find($id);
        if (!$permission) {
            $array = [
                'data' => null,
                'message' => 'The permission not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $permission->delete($id);
        if ($permission) {
            $array = [
                'data' => null,
                'message' => 'The permission delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}