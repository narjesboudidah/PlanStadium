<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\societeMaintenanceResource;
use App\Models\societe_maintenances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
            'contact_nom' => 'nullable|string|max:255',
            'contact_telephone' => 'nullable|string|unique:societe_maintenances',
            'contact_email' => 'nullable|email|unique:societe_maintenances',
            'user_id' => 'required|exists:users,id',
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
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'tel' => 'required|unique:societe_maintenances',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|unique:societe_maintenances',
            'email' => 'required|email|unique:societe_maintenances',
            'contact_nom' => 'nullable|string|max:255',
            'contact_telephone' => 'nullable|string|unique:societe_maintenances',
            'contact_email' => 'nullable|email|unique:societe_maintenances',
            'user_id' => 'required|exists:users,id',
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

        $societeMaintenance = societe_maintenances::find($id);
        if (!$societeMaintenance) {
            $array = [
                'data' => null,
                'message' => 'The societeMaintenance not Found',
                'status' => 404,
            ];
            return $array;
        }

        $societeMaintenance->update($request->all());
        if ($societeMaintenance) {
            $array = [
                'data' => new societeMaintenanceResource($societeMaintenance),
                'message' => 'The societe Maintenance update',
                'status' => 201,
            ];
            return response($array);
        }
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