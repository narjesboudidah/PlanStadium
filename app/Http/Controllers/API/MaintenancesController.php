<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\maintenanceResource;
use App\Models\maintenances;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class MaintenancesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index(Request $request)
    {
        if($request->user()->Roles()->get()[0]["name"] == "Admin Federation"){
            $maintenances = maintenanceResource::collection(maintenances::get());//ki tabda bech trajaa akther min 7aja
            return response([
                'data' => $maintenances,
                'message' => 'ok',
                'status' => 200,
            ]);
        } else if ($request->user()->Roles()->get()[0]["name"] == "Admin Ste"){
            return response([
                "data" => $request->user()->maintenances()->get(),
            ]);
        } else {
            return response([
                "data" => [],
            ],403);
        }
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
        'description' => 'nullable|string|max:255',
        'admin_fed_id' => 'nullable|exists:users,id',
        'admin_ste_id' => 'exists:users,id',
        'stade_id' => 'required|exists:stades,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $admin_ste_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté

    $maintenance = maintenances::create(array_merge($request->all(), ['admin_ste_id' => $admin_ste_id,'admin_fed_id' => $admin_ste_id]));

    if ($maintenance) {
        $array = [
            'data' => new MaintenanceResource($maintenance),
            'message' => 'The maintenance saved',
            'status' => 201,
        ];
        return response()->json($array);
    }

    return response()->json(['message' => 'The maintenance could not be saved'], 400);
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
    public function confirmerMaintenance($id)
    {
        // Trouver la réservation en fonction de l'ID
        $maintenance = maintenances::find($id);

        // Vérifier si la réservation existe
        if (!$maintenance) {
            $array = [
                'data' => null,
                'message' => 'échec operation',
                'status' => 501,
            ];
            return response($array);
        }

        // Confirmer la réservation (mettre à jour le statut par exemple)
        $maintenance->update([
            'statut' => 'accepté'
        ]);

        // Rediriger avec un message de succès
        $array = [
            'data' => null,
            'message' => 'accepté avec success',
            'status' => 501,
        ];
        return response($array);
    }

    public function annulerMaintenance($id)
    {
        // Trouver la réservation en fonction de l'ID
        $maintenance = maintenances::find($id);

        // Vérifier si la réservation existe
        if (!$maintenance) {
            $array = [
                'data' => null,
                'message' => 'échec operation',
                'status' => 501,
            ];
            return response($array);
        }

        // Annuler la réservation (mettre à jour le statut par exemple)
        $maintenance->update([
            'statut' => 'refusé'
        ]);

        // Rediriger avec un message de succès
        $array = [
            'data' => null,
            'message' => 'refusé avec success',
            'status' => 501,
        ];
        return response($array);
    }

    public function MaintenanceFilter($date)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if (isset($date)) {
            // Convertir la date de filtrage en objet Carbon pour une manipulation facile
            $filterDate = Carbon::parse($date)->toDateString();

            // Effectuer la requête pour filtrer les maintenances en fonction de la date
            $maintenances = maintenances::whereDate('date', $filterDate)->get();
            $maintenancesResource = maintenanceResource::collection($maintenances);
            $array = [
                'data' => $maintenancesResource,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune date de filtrage n'est spécifiée, récupérer tous les maintenances
            $maintenances = maintenances::all();
            $maintenancesResource = maintenanceResource::collection($maintenances);
            $array = [
                'data' => $maintenancesResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }

        // Retourner les maintenances filtrés à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }
    public function MaintenanceFilterStade ($date_debut, $stade_id, $statut)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if (isset($date_debut)) {
            // Supprimer les caractères indésirables de la chaîne de date
            $date_debut = str_replace(['{', '}'], '', $date_debut);
    
            // Convertir la date de début de filtrage en objet Carbon pour une manipulation facile
            $filterDate = Carbon::parse($date_debut)->toDateString();
    
            // Effectuer la requête pour filtrer les événements en fonction de l'ID du stade et de la date de début
            $maintenances = maintenances::where('stade_id', $stade_id)
                ->whereDate('date_debut', '=', $filterDate)
                ->where('statut', $statut)
                ->get();
    
            $maintenanceResource = maintenanceResource::collection($maintenances);
            $array = [
                'data' => $maintenances,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune date de filtrage n'est spécifiée, récupérer tous les événements
            $maintenances = maintenances::all();
            $maintenanceResource = maintenanceResource::collection($maintenances);
            $array = [
                'data' => $maintenanceResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }
    
        // Retourner les événements filtrés à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }   


}
