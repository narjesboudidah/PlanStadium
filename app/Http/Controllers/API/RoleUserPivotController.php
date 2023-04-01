<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleUserPivotResource;
use App\Models\role_user_pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleUserPivotController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $RoleUserPivots = RoleUserPivotResource::collection(role_user_pivot::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $RoleUserPivots,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $RoleUserPivot = role_user_pivot::find($id);
        if ($RoleUserPivot) {
            $array = [
                'data' => new RoleUserPivotResource($RoleUserPivot),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The RoleUserPivots not found']);
    }

    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
            'ste_id' => 'nullable|exists:societe_maintenances,id',
            'equipe_id' => 'nullable|exists:equipes,id',
        ]);

        if ($validator->fails()) {
            return response(null, 400, [$validator->errors()]);
        }


        $RoleUserPivot = role_user_pivot::create($request->all());
        if ($RoleUserPivot) {
            $array = [
                'data' => new RoleUserPivotResource($RoleUserPivot),
                'message' => 'The RoleUserPivots save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The RoleUserPivots not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
            'ste_id' => 'nullable|exists:societe_maintenances,id',
            'equipe_id' => 'nullable|exists:equipes,id',
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

        $RoleUserPivot = role_user_pivot::find($id);
        if (!$RoleUserPivot) {
            $array = [
                'data' => null,
                'message' => 'The RoleUserPivots not Found',
                'status' => 404,
            ];
            return $array;
        }

        $RoleUserPivot->update($request->all());
        if ($RoleUserPivot) {
            $array = [
                'data' => new RoleUserPivotResource($RoleUserPivot),
                'message' => 'The RoleUserPivots update',
                'status' => 201,
            ];
            return response($array);
        }
    }



    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $RoleUserPivot = role_user_pivot::find($id);
        if (!$RoleUserPivot) {
            $array = [
                'data' => null,
                'message' => 'The RoleUserPivots not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $RoleUserPivot->delete($id);
        if ($RoleUserPivot) {
            $array = [
                'data' => null,
                'message' => 'The RoleUserPivots delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}