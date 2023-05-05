<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\maintenanceResource;
use App\Models\maintenances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


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
            'heure_debut' => 'required|date_format:H:i',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'heure_fin' => 'required|date_format:H:i',
            'etat' => 'required|string|max:255',
            'statut' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'admin_fed_id' => 'required|exists:users,id',
            'admin_ste_id' => 'required|exists:users,id',
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
    $maintenance = maintenances::find($id);
    if (!$maintenance) {
        return response()->json([
            'data' => null,
            'message' => 'maintenance not found',
            'status' => 404,
        ], 404);
    }

    $validatedData = $request->validate([
        'date_debut' => 'date|date_format:Y-m-d',
        'heure_debut' => 'date_format:H:i',
        'date_fin' => 'date|date_format:Y-m-d|after:date_debut',
        'heure_fin' => 'date_format:H:i',
        'etat' => 'string|max:255',
        'statut' => 'string|max:255',
        'description' => 'string|max:255',
        'admin_fed_id' => 'exists:users,id',
        'admin_ste_id' => 'exists:users,id',
        'stade_id' => 'exists:stades,id',
    ]);

    $maintenance->update($validatedData);

    return response()->json([
        'data' => new maintenanceResource($maintenance),
        'message' => 'maintenance updated successfully',
        'status' => 201,
    ], 201);
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