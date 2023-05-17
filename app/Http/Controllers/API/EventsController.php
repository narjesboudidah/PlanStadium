<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\eventResource;
use App\Models\events;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $events = eventResource::collection(events::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $events,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $event = events::find($id);
        if ($event) {
            $array = [
                'data' => new eventResource($event),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The event not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date_debut' => 'required|date|date_format:Y-m-d',
            'heure_debut' => 'required|date_format:H:i',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'heure_fin' => 'required|date_format:H:i',
            'type_event' => 'required|string|max:255',
            'nom_event' => 'nullable|string|max:255',
            'type_match' => 'nullable|string|max:255',
            'equipe1_id' => 'nullable|exists:equipes,id',
            'equipe2_id' => 'nullable|exists:equipes,id',
            'stade_id' => 'required|exists:stades,id',
            'admin_fed_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }

        $admin_fed_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté

        $event = events::create(array_merge($request->all(), ['admin_fed_id' => $admin_fed_id]));
        if ($event) {
            $array = [
                'data' => new eventResource($event),
                'message' => 'The event save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The event not save']);
    }

    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date_debut' => 'date_format:Y-m-d',
            'heure_debut' => 'date_format:H:i',
            'date_fin' => 'date_format:Y-m-d|after:date_debut',
            'heure_fin' => 'date_format:H:i',
            'type_event' => 'string|max:255',
            'nom_event' => 'string|max:255',
            'type_match' => 'string|max:255',
            'stade_id' => 'exists:stades,id',
            'admin_fed_id' => 'exists:users,id',
            'equipe1_id' => 'exists:equipes,id',
            'equipe2_id' => 'exists:equipes,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => null,
                'message' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $event = events::find($id);
        if (!$event) {
            return response()->json([
                'data' => null,
                'message' => 'The event not Found',
                'status' => 404,
            ], 404);
        }

        $admin_fed_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté

        $event->update(array_merge($request->all(), ['admin_fed_id' => $admin_fed_id]));
        if ($event) {
            return response()->json([
                'data' => new eventResource($event),
                'message' => 'The event update',
                'status' => 201,
            ], 201);
        }
    }



    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $event = events::find($id);
        if (!$event) {
            $array = [
                'data' => null,
                'message' => 'The event not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $event->delete($id);
        if ($event) {
            $array = [
                'data' => null,
                'message' => 'The event delete',
                'status' => 200,
            ];
            return response($array);
        }
    }

    public function eventFilter($date_debut, $stade_id)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if (isset($date_debut)) {
            // Supprimer les caractères indésirables de la chaîne de date
            $date_debut = str_replace(['{', '}'], '', $date_debut);
    
            // Convertir la date de début de filtrage en objet Carbon pour une manipulation facile
            $filterDate = Carbon::parse($date_debut)->toDateString();
    
            // Effectuer la requête pour filtrer les événements en fonction de l'ID du stade et de la date de début
            $events = events::where('stade_id', $stade_id)
                ->whereDate('date_debut', '=', $filterDate)
                ->get();
    
            $eventResource = eventResource::collection($events);
            $array = [
                'data' => $events,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune date de filtrage n'est spécifiée, récupérer tous les événements
            $events = events::all();
            $eventResource = eventResource::collection($events);
            $array = [
                'data' => $eventResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }
    
        // Retourner les événements filtrés à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }    

}