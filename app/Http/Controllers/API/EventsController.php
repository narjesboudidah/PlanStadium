<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\eventResource;
use App\Models\events;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'stade_id' => 'required|exists:stades,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $event = events::create($request->all());
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
        'stade_id' => 'exists:stades,id',
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

    $event->update($request->all());
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

    public function eventFilter($date_debut)
    {
        // Vérifier si une date_debut de filtrage a été spécifiée
        if ($date_debut) {
            // Convertir la date_debut de filtrage en objet Carbon pour une manipulation facile
            $filterDate = Carbon::parse($date_debut)->toDateString();

            // Effectuer la requête pour filtrer les events en fonction de la date_debut
            $events = events::whereDate('date_debut', $filterDate)->get();
            $EventResource = EventResource::collection($events);
            $array = [
                'data' => $EventResource,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune date de filtrage n'est spécifiée, récupérer tous les events
            $events = events::all();
            $EventResource = EventResource::collection($events);
            $array = [
                'data' => $EventResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }

        // Retourner les events filtrés à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }
}