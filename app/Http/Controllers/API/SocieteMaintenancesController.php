<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\societeMaintenanceResource;
use App\Models\societe_maintenances;
use App\Http\Resources\historiqueResource;
use Illuminate\Support\Facades\Storage;
use App\Models\historiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class SocieteMaintenancesController extends Controller
{
    public function index()
    {
        $societeMaintenances = societe_maintenances::all();
    
        $societeMaintenancesData = [];
        foreach ($societeMaintenances as $societeMaintenance) {
            $logoUrl = url($societeMaintenance->logo);
            $societeMaintenancesData[] = [
                'id' => $societeMaintenance->id,
                'nom' => $societeMaintenance->nom,
                'adresse' => $societeMaintenance->adresse,
                'tel' => $societeMaintenance->tel,
                'logo' => $logoUrl,
                'email' => $societeMaintenance->email,
                'description' => $societeMaintenance->description,
            ];
        }
    
        $array = [
            'data' => $societeMaintenancesData,
            'message' => 'ok',
            'status' => 200,
        ];
    
        return response()->json($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $societeMaintenance = societe_maintenances::find($id);
        if ($societeMaintenance) {
            $logoUrl = url($societeMaintenance->logo);
            $societeMaintenancesData = [
                'nom' => $societeMaintenance->nom,
                'adresse' => $societeMaintenance->adresse,
                'tel' => $societeMaintenance->tel,
                'logo' => $logoUrl,
                'email' => $societeMaintenance->email,
                'description' => $societeMaintenance->description,
            ];
            $array = [
                'data' => $societeMaintenancesData,
                'message' => 'ok',
                'status' => 200,
            ];
        
        return response()->json($array);
        }
        return response()->json(null, 401, ['The societe Maintenance not found']);
    }

    public function showimage($nom)
{
    $societeMaintenance = societe_maintenances::where('nom', $nom)->first();
    if ($societeMaintenance) {
        $logoUrl = url($societeMaintenance->logo);
        $societeMaintenancesData = [
            'logo' => $logoUrl
        ];
        $array = [
            'data' => $societeMaintenancesData,
            'message' => 'ok',
            'status' => 200,
        ];
    
        return response()->json($array);
    }
    return response()->json(null, 401, ['The societe Maintenance not found']);
}


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nom' => 'required|string|max:255',
        'adresse' => 'required|string',
        'tel' => 'required|unique:societe_maintenances',
        'logo' => 'required|string|mimes:jpeg,png,jpg,gif,svg|max:4096|unique:societe_maintenances',
        'email' => 'required|email|unique:societe_maintenances',
        'description' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response(null, 400, [$validator->errors()]);
    }

    $societeMaintenance = societe_maintenances::create($request->all());
    if ($request->hasFile('logo')) {
        $imagePath = $request->file('logo')->store('public/images');
        $societeMaintenance->logo = str_replace('public/', 'storage/', $imagePath);
        $societeMaintenance->save();
    }
    $imageUrl = asset($societeMaintenance->logo);

    if ($societeMaintenance) {
        $todayDate = date('Y-m-d H:i:s');
        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'ajout Ste',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            // Récupérer l'URL complète de l'image
            $imageUrl = url($societeMaintenance->logo);

            $array = [
                'data' => new societeMaintenanceResource($societeMaintenance),
                'message' => 'The societeMaintenance saved',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
                'image_url' => $imageUrl,
            ];
            return response()->json($array);
        }
    }

    return response(null, 400, ['The societeMaintenance not saved']);
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