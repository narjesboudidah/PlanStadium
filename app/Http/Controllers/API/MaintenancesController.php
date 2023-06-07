<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\maintenanceResource;
use App\Mail\maintenanceaccepter;
use App\Mail\maintenancerefuse;
use App\Models\events;
use App\Models\maintenances;
use App\Http\Resources\historiqueResource;
use App\Models\historiques;
use App\Models\societe_maintenances;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class MaintenancesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index(Request $request)
    {   //En cas de retour plusieurs maintenances
        $maintenances = maintenanceResource::collection(maintenances::get());
        $array = [
            'data' => $maintenances,
            'message' => 'ok',
            'status' => 200,
            'user' => $request->user(),
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
            'date_debut' => 'required|date|date_format:Y-m-d|after_or_equal:'.date('Y-m-d'),
            'heure_debut' => 'required|date_format:H:i',
            'date_fin' => 'required|date|date_format:Y-m-d|after_or_equal:date_debut',
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
        $staut = 'en attente';

        $maintenanceData = [
            'date_debut' => $request->date_debut,
            'heure_debut' => $request->heure_debut,
            'date_fin' => $request->date_fin,
            'heure_fin' => $request->heure_fin,
            'etat' => $request->etat,
            'description' => $request->description,
            'admin_ste_id' => Auth::id(),
            'admin_fed_id' => Auth::id(),
            'stade_id' => $request->stade_id,
            'statut' => $staut,
        ];

        // Vérifier si une maintenance existe avec les mêmes valeurs de state, date_debut
        $existingMaintenance = maintenances::where('stade_id', $request->stade_id)
            ->where('statut', 'accepté')
            ->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
            ->first();

        // Vérifier si un event existe avec les mêmes valeurs de state, date_debut
        $existingEvent = events::where('stade_id', $request->stade_id)
        ->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
        ->first();

        if ($existingMaintenance && $existingEvent) {
            return response()->json(['message' => 'Date déjà réserver'], 400);
        }

        $admin_ste_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté
        $maintenanceData['admin_ste_id'] = $admin_ste_id;
        $maintenanceData['admin_fed_id'] = $admin_ste_id;
        $maintenance = maintenances::create($maintenanceData);

        if ($maintenance) {
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Ajout maintenance',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id
            ]);

            if ($historique) {
                $array = [
                    'data' => new MaintenanceResource($maintenance),
                    'message' => 'La maintenance a été enregistrée',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201
                ];
                return response()->json($array);
            }
        }

        return response()->json(['message' => 'La maintenance n\'a pas pu être enregistrée'], 400);
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

        if($maintenance->statut === 'en attente'){
        $validatedData = $request->validate([
            'date_debut' => 'required|date|date_format:Y-m-d|after_or_equal:'.date('Y-m-d'),
            'heure_debut' => 'required|date_format:H:i',
            'date_fin' => 'required|date|date_format:Y-m-d|after_or_equal:date_debut',
            'heure_fin' => 'required|date_format:H:i',
            'etat' => 'required|string|max:255',
            'description' => 'string|max:255',
            'admin_fed_id' => 'exists:users,id',
            'admin_ste_id' => 'exists:users,id',
            'stade_id' => 'required|exists:stades,id',
        ]);

        $maintenance->update($validatedData);
        $todayDate = date('Y-m-d H:i:s');
        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'Modifier maintenance',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            $array = [
                'data' => new MaintenanceResource($maintenance),
                'message' => 'maintenance updated successfully',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
            ];
            return response()->json($array);
        }}
        else{
            return response()->json(['message' => 'Il n\'est pas possible de modifier la maintenance car elle a déjà été acceptée.'], 400);
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
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Supprimer maintenance',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);

            if ($historique) {
                $array = [
                    'data' => new MaintenanceResource($maintenance),
                    'message' => 'The maintenance delete',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
        }
    }
    //Confirmer maintenance
    public function confirmerMaintenance($id)
    {
        // Trouver la maintenance en fonction de l'ID
        $maintenance = maintenances::find($id);

        // Vérifier si la maintenance existe
        if (!$maintenance) {
            $array = [
                'data' => null,
                'message' => 'échec operation',
                'status' => 501,
            ];
            return response($array);
        }
        $admin_fed_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté

        // Vérifier si un event existe avec les mêmes valeurs de state, date_debut
        $existingEvent = events::where('stade_id', $maintenance->stade_id)
            ->whereBetween('date_debut', [$maintenance->date_debut, $maintenance->date_fin])
            ->first();

        $existingMaintenance = maintenances::where('stade_id', $maintenance->stade_id)
        ->where('statut', 'accepté')
        ->whereBetween('date_debut', [$maintenance->date_debut, $maintenance->date_fin])
        ->first();

        if ($existingEvent && $existingMaintenance) {
            return response()->json(['message' => 'Date déjà réserver'], 400);
        }

        // Confirmer la maintenance (mettre à jour le statut par exemple)
        $maintenance->update([
            'statut' => 'accepté',
            'admin_fed_id' => $admin_fed_id
        ]);

        $admin_ste_id = $maintenance->admin_ste_id;
        $admin_ste = User::find($admin_ste_id);
        $admin_email = $admin_ste->email;
        Mail::to($admin_email)->send(new maintenanceaccepter($maintenance));

        $todayDate = date('Y-m-d H:i:s');
        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'Accepter maintenance',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            $array = [
                'data' => new MaintenanceResource($maintenance),
                'message' => 'accepté avec success',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
            ];
            return response()->json($array);
        }
    }

    //Annuler Maintenance
    public function annulerMaintenance($id)
    {
        // Trouver la maintenances en fonction de l'ID
        $maintenance = maintenances::find($id);

        // Vérifier si la maintenance existe
        if (!$maintenance) {
            $array = [
                'data' => null,
                'message' => 'échec operation',
                'status' => 501,
            ];
            return response($array);
        }

        $admin_fed_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté

        $admin_ste_id = $maintenance->admin_ste_id;
        $admin_ste = User::find($admin_ste_id);
        $admin_email = $admin_ste->email;
        Mail::to($admin_email)->send(new maintenancerefuse($maintenance));

        // Annuler la maintenance (mettre à jour le statut par exemple)
        $maintenance->update([
            'statut' => 'refusé',
            'admin_fed_id' => $admin_fed_id
        ]);

        $todayDate = date('Y-m-d H:i:s');
        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'Refuser maintenance',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            $array = [
                'data' => new MaintenanceResource($maintenance),
                'message' => 'refusé avec success',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
            ];
            return response()->json($array);
        }
    }

    //filter les maintenances en attentes d'aujourd'hui
    public function Maintenancelogo($id)
{
    $user = User::select('nom_ste')->where('id', $id)->first();

    if ($user) {
        $logo = societe_maintenances::select('logo')->where('nom', $user->nom_ste)->first();

        if ($logo) {
            $logo1 = 'http://127.0.0.1:8000/' . $logo->logo;
            $array = [
                'data' => $logo1,
                'message' => 'OK',
                'statut' => 200,
            ];

            return response($array);
        }
    }

    // Si aucun utilisateur ou logo n'est trouvé, retourner une réponse appropriée
    return response([
        'message' => 'Logo introuvable',
        'statut' => 404,
    ], 404);
}
    public function MaintenanceFilter(Request $request)
    {
        // Obtenez la date d'aujourd'hui
        $today = date('Y-m-d');

        // Obtenez l'utilisateur connecté
        $user = auth()->user();
        $statut = 'en attente';
        // Vérifiez le rôle de l'utilisateur
        if ($request->user()->Roles()->get()[0]["name"] == "Admin Federation") {
            // Effectuer la requête pour filtrer les maintenances en fonction de la date d'aujourd'hui
            $maintenances = maintenances::whereDate('created_at', $today)
                ->where('statut', $statut)
                ->get();
        } elseif ($request->user()->Roles()->get()[0]["name"] == 'Admin Ste') {
            $admin_id = Auth::id();
            // Si l'utilisateur est un admin d'équipe, filtrez les maintenances en fonction de l'utilisateur et de la date d'aujourd'hui
            $maintenances = maintenances::where('admin_Ste_id', $user->id)
                ->where('statut', $statut)
                ->whereDate('created_at', $today)
                ->where('admin_ste_id', $admin_id)
                ->get();
        } else {
            // Si l'utilisateur a un autre rôle, renvoyez une réponse vide
            $maintenances = [];
        }
        $maintenancesResource = maintenanceResource::collection($maintenances);

        $array = [
            'data' => $maintenancesResource,
            'message' => 'OK',
            'statut' => 200,
        ];

        // Retourner les maintenances filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //filter les maintenances par etat
    public function MaintenanceFilterEtat($etat)
    {
        // Vérifier si un état de filtrage a été spécifié
        if (!is_null($etat)) {
            // Effectuer la requête pour filtrer les maintenances en fonction de l'état
            $maintenances = maintenances::where('etat', $etat)->get();
        } else {
            // Si aucun état de filtrage n'est spécifié, récupérer toutes les maintenances
            $maintenances = maintenances::all();
        }

        // Créer une collection de ressources pour les maintenances filtrées
        $maintenancesResource = MaintenanceResource::collection($maintenances);

        $array = [
            'data' => $maintenancesResource,
            'message' => 'OK',
            'status' => 200,
        ];

        // Retourner les maintenances filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //filter les maintenances par stade
    public function MaintenanceFilterStades($stade_id)
    {
        // Vérifier si un état de filtrage a été spécifié
        if (!is_null($stade_id)) {
            $statut = 'accepté';
            // Effectuer la requête pour filtrer les maintenances en fonction de l'état
            $maintenances = maintenances::where('stade_id', $stade_id)
                        ->where('statut',$statut)
                        ->get();
        } else {
            // Si aucun état de filtrage n'est spécifié, récupérer toutes les maintenances
            $maintenances = maintenances::all();
        }

        // Créer une collection de ressources pour les maintenances filtrées
        $maintenancesResource = MaintenanceResource::collection($maintenances);

        $array = [
            'data' => $maintenancesResource,
            'message' => 'OK',
            'status' => 200,
        ];

        // Retourner les maintenances filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //filter les maintenances accepté
    public function MaintenanceFilterstatut(Request $request)
    {
        $statut = 'accepté';

        if ($request->user()->Roles()->get()[0]["name"] == "Admin Federation") {
            // Effectuer la requête pour filtrer les maintenances en fonction de la statut
            $maintenances = maintenances::where('statut', $statut)->get();
        } elseif ($request->user()->Roles()->get()[0]["name"] == 'Admin Ste') {
            $admin_id = Auth::id();
            // Si l'utilisateur est un admin d'équipe, filtrez les maintenances en fonction de l'utilisateur et de la date d'aujourd'hui
            $maintenances = maintenances::where('statut', $statut)
                ->where('admin_ste_id', $admin_id)
                ->get();
        } else {
            // Si l'utilisateur a un autre rôle, renvoyez une réponse vide
            $maintenances = [];
        }
        // Créer une collection de ressources pour les maintenances filtrées
        $maintenancesResource = MaintenanceResource::collection($maintenances);

        $array = [
            'data' => $maintenancesResource,
            'message' => 'OK',
            'status' => 200,
            'stadename' => $maintenances[0]->stades()->get(),
        ];

        // Retourner les maintenances filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //filter liste de tous les maintenances en attentes
    public function Maintenancestatut(Request $request)
    {
        $statut = 'en attente';
        // Vérifiez le rôle de l'utilisateur
        if ($request->user()->Roles()->get()[0]["name"] == "Admin Federation") {
            // Effectuer la requête pour filtrer les maintenances en fonction de la date d'aujourd'hui
            $maintenances = maintenances::where('statut', $statut)
                ->get();
        } elseif ($request->user()->Roles()->get()[0]["name"] == 'Admin Ste') {
            $admin_id = Auth::id();
            // Si l'utilisateur est un admin d'équipe, filtrez les maintenances en fonction de l'utilisateur et de la date d'aujourd'hui
            $maintenances = maintenances::where('statut', $statut)
                ->where('admin_ste_id', $admin_id)
                ->get();
        } else {
            // Si l'utilisateur a un autre rôle, renvoyez une réponse vide
            $maintenances = [];
        }
        $maintenancesResource = maintenanceResource::collection($maintenances);

        $array = [
            'data' => $maintenancesResource,
            'message' => 'OK',
            'statut' => 200,
        ];

        // Retourner les maintenances filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //filter liste de tous les maintenances refusés ou acceptés
    public function MaintenancesHistorique()
    {
        $statut = 'en attente';

        // Effectuer la requête pour filtrer les maintenances en fonction de la statut
        $maintenances = maintenances::where('statut', '!=', $statut)->get();

        // Créer une collection de ressources pour les maintenances filtrées
        $maintenancesResource = MaintenanceResource::collection($maintenances);

        $array = [
            'data' => $maintenancesResource,
            'message' => 'OK',
            'status' => 200,
        ];

        // Retourner les maintenances filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //filter des maintenances par date début et stade
    public function MaintenanceFilterStade($date_debut, $stade_id)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if (isset($date_debut)) {
            // Supprimer les caractères indésirables de la chaîne de date
            $date_debut = str_replace(['{', '}'], '', $date_debut);

            // Convertir la date de début de filtrage en objet Carbon pour une manipulation facile
            $filterDate = Carbon::parse($date_debut)->toDateString();
            $statut = "accepté";

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
