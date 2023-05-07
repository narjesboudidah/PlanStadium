<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\societeMaintenanceResource;
use App\Models\societe_maintenances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class SocieteMaintenancesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $societeMaintenances = societeMaintenanceResource::collection(societe_maintenances::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $societeMaintenances,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $societeMaintenance = societe_maintenances::find($id);
        if ($societeMaintenance) {
            $array = [
                'data' => new societeMaintenanceResource($societeMaintenance),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The societe Maintenance not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'tel' => 'required|unique:societe_maintenances',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|unique:societe_maintenances',
            'email' => 'required|email|unique:societe_maintenances',
            'description' => 'nullable|string',
            'admin_ste_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $societeMaintenance = societe_maintenances::create($request->all());
        if ($societeMaintenance) {
            $array = [
                'data' => new societeMaintenanceResource($societeMaintenance),
                'message' => 'The societeMaintenance save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The societeMaintenance not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'nom' => 'string|max:255',
        'adresse' => 'string',
        'tel' => [
            Rule::unique('societe_maintenances')->ignore($id),
        ],
        'logo' => [
            'image',
            'mimes:jpeg,png,jpg,gif,svg',
            'max:2048',
            Rule::unique('societe_maintenances')->ignore($id),
        ],
        'email' => [
            'email',
            Rule::unique('societe_maintenances')->ignore($id),
        ],
        'description' => 'nullable|string',
        'admin_ste_id' => 'exists:users,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'data' => null,
            'message' => $validator->errors(),
            'status' => 400,
        ], 400);
    }

    $societeMaintenance = societe_maintenances::find($id);
    if (!$societeMaintenance) {
        return response()->json([
            'data' => null,
            'message' => 'SocieteMaintenance not found',
            'status' => 404,
        ], 404);
    }

    $societeMaintenance->update($validator->validated());

    return response()->json([
        'data' => new SocieteMaintenanceResource($societeMaintenance),
        'message' => 'SocieteMaintenance updated successfully',
        'status' => 201,
    ], 201);
}



    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $societeMaintenance = societe_maintenances::find($id);
        if (!$societeMaintenance) {
            $array = [
                'data' => null,
                'message' => 'The societe Maintenance not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $societeMaintenance->delete($id);
        if ($societeMaintenance) {
            $array = [
                'data' => null,
                'message' => 'The societe Maintenance delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}