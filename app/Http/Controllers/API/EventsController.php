<?php

namespace App\Http\Controllers\API;

use App\Mail\EventModificationNotification;
use App\Mail\EventSupprimerNotification;
use App\Http\Controllers\Controller;
use App\Http\Resources\eventResource;
use App\Models\events;
use App\Http\Resources\historiqueResource;
use App\Models\User;
use App\Models\historiques;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
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
            'admin_equipe_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }

        $admin_fed_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté
        $admin_equipe_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté

        $event = events::create(array_merge($request->all(), ['admin_fed_id' => $admin_fed_id,'admin_equipe_id' => $admin_equipe_id,]));
        if ($event) {
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Ajout event',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);

            if ($historique) {
                $array = [
                    'data' => new eventResource($event),
                    'message' => 'The event save',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
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
            'admin_equipe_id' => 'exists:users,id',
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
                'message' => 'The event was not found',
                'status' => 404,
            ], 404);
        }

        // Vérifier si la date de début est supérieure ou égale à la date d'aujourd'hui + 2 jours
        $todayDate = date('Y-m-d');
        $twoDaysLater = date('Y-m-d', strtotime('+2 days'));
        $eventStartDate = $event->date_debut;
        if (strtotime($eventStartDate) < strtotime($twoDaysLater)) {
            $array = [
                'data' => null,
                'message' => 'Cannot updated event with start date within 2 days from now',
                'status' => 400,
            ];
            return response()->json($array);
        }
    
        $admin_fed_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté
        
        $event->update(array_merge($request->all(), ['admin_fed_id' => $admin_fed_id]));
    
        if ($event) {

            // Envoyer un e-mail à l'utilisateur
            $event = events::findOrFail($id);
            $admin_equipe_id = $event->admin_equipe_id;
            $admin_equipe = User::find($admin_equipe_id);
            $admin_email = $admin_equipe->email;
            Mail::to($admin_email)->send(new EventModificationNotification($event));
            
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Modifier event',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);
    
            if ($historique) {
                $array = [
                    'data' => new eventResource($event),
                    'message' => 'The event has been updated',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
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

        // Vérifier si la date de début est supérieure ou égale à la date d'aujourd'hui + 2 jours
        $todayDate = date('Y-m-d');
        $twoDaysLater = date('Y-m-d', strtotime('+2 days'));
        $eventStartDate = $event->date_debut;
        if (strtotime($eventStartDate) < strtotime($twoDaysLater)) {
            $array = [
                'data' => null,
                'message' => 'Cannot delete event with start date within 2 days from now',
                'status' => 400,
            ];
            return response()->json($array);
        }


        // Envoyer un e-mail à l'utilisateur
        $admin_equipe_id = $event->admin_equipe_id;
        $admin_equipe = User::find($admin_equipe_id);
        if ($admin_equipe) {
            $admin_email = $admin_equipe->email;
            Mail::to($admin_email)->send(new EventSupprimerNotification($event));
        }

        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'Supprimer event',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            $array = [
                'data' => new eventResource($event),
                'message' => 'The event delete',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
            ];
            $event->delete();
            return response()->json($array);
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
    public function eventFilterStade($stade_id)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if (isset($stade_id)) {
            // Effectuer la requête pour filtrer les événements en fonction de l'ID du stade et de la date de début
            $events = events::where('stade_id', $stade_id)
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