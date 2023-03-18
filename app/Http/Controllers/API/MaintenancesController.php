<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\maintenanceResource;
use App\Models\maintenances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaintenancesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $maintenances = maintenanceResource::collection(maintenances::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $maintenances,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $maintenance = maintenances::find($id);
        if ($maintenance) {
            $array = [
                'data' => new maintenanceResource($maintenance),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The maintenance not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date_debut' => 'required|date|date_format:Y-m-d',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'statut' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'ste_id' => 'required|exists:societe_maintenances,id',
            'stade_id' => 'required|exists:stades,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $maintenance = maintenances::create($request->all());
        if ($maintenance) {
            $array = [
                'data' => new maintenanceResource($maintenance),
                'message' => 'The user save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The maintenance not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'date_debut' => 'required|date|date_format:Y-m-d',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'statut' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'ste_id' => 'required|exists:societe_maintenances,id',
            'stade_id' => 'required|exists:stades,id',
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

        $maintenance = maintenances::find($id);
        if (!$maintenance) {
            $array = [
                'data' => null,
                'message' => 'The maintenance not Found',
                'status' => 404,
            ];
            return $array;
        }

        $maintenance->update($request->all());
        if ($maintenance) {
            $array = [
                'data' => new maintenanceResource($maintenance),
                'message' => 'The user update',
                'status' => 201,
            ];
            return response($array);
        }
    }


    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $maintenance = maintenances::find($id);
        if (!$maintenance) {
            $array = [
                'data' => null,
                'message' => 'The maintenance not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $maintenance->delete($id);
        if ($maintenance) {
            $array = [
                'data' => null,
                'message' => 'The maintenance delete',
                'status' => 200,
            ];
            return response($array);
        }
    }


}