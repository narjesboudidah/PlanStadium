<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\societeMaintenanceResource;
use App\Models\societe_maintenances;
use App\Http\Resources\historiqueResource;
use App\Models\historiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


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
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $societeMaintenance = societe_maintenances::create($request->all());
        if ($societeMaintenance) {
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'ajout Ste',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);

            if ($historique) {
                $array = [
                    'data' => new societeMaintenanceResource($societeMaintenance),
                    'message' => 'The societeMaintenance saved',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
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

    $todayDate = date('Y-m-d H:i:s');
    $admin_id = Auth::id();
    $historique = historiques::create([
        'action' => 'Modifier Ste',
        'date' => $todayDate,
        'admin_fed_id' => $admin_id,
    ]);

    if ($historique) {
        $array = [
            'data' => new societeMaintenanceResource($societeMaintenance),
            'message' => 'SocieteMaintenance updated successfully',
            'historique' => new HistoriqueResource($historique),
            'status' => 201,
        ];
        return response()->json($array);
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
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Supprimer Ste',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);

            if ($historique) {
                $array = [
                    'data' => new societeMaintenanceResource($societeMaintenance),
                    'message' => 'The societe Maintenance delete',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
        }
    }
}