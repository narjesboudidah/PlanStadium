<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\reservationResource;
use App\Mail\reservationaccepter;
use App\Mail\reservationrefuse;
use App\Models\events;
use App\Models\maintenances;
use App\Models\reservations;
use App\Http\Resources\historiqueResource;
use App\Models\historiques;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    /*Display a listing of the resource.*/
    public function index(Request $request)
    {
        $reservations = reservationResource::collection(reservations::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $reservations,
            'message' => 'ok',
            'status' => 200,
            'user' => $request->user(),
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $reservation = reservations::find($id);
        if ($reservation) {
            $array = [
                'data' => new reservationResource($reservation),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The reservation not found']);
    }

    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        //$todayDate = date('Y/m/d');
        $validator = Validator::make($request->all(), [
            'date_debut' => 'required|date|date_format:Y-m-d|after_or_equal:' . date('Y-m-d'),
            'heure_debut' => 'required|date_format:H:i',
            'date_fin' => 'required|date|date_format:Y-m-d|after_or_equal:date_debut',
            'heure_fin' => 'required|date_format:H:i',
            'type_reservation' => 'required|string',
            'statut' => 'required|string|max:2023',
            'nom_event' => 'nullable|string|max:2023',
            'type_match' => 'nullable|string|max:2023',
            'statut' => 'string|max:2023',
            'equipe1_id' => 'exists:equipes,id',
            'equipe2_id' => 'exists:equipes,id',
            'stade_id' => 'required|exists:stades,id',
            'admin_equipe_id' => 'exists:users,id',
            'admin_fed_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $statut = 'en attente';

        $reservationData = [
            'date_debut' => $request->date_debut,
            'heure_debut' => $request->heure_debut,
            'date_fin' => $request->date_fin,
            'heure_fin' => $request->heure_fin,
            'type_reservation' => $request->type_reservation,
            'statut' => $request->statut,
            'nom_event' => $request->nom_event,
            'type_match' => $request->type_match,
            'statut' => $request->statut,
            'equipe1_id' => $request->equipe1_id,
            'equipe2_id' => $request->equipe2_id,
            'stade_id' => $request->stade_id,
            'admin_equipe_id' => Auth::id(),
            'admin_fed_id' => Auth::id(),
        ];

        // Vérifier si un event existe avec les mêmes valeurs de state, date_debut
        $existingEvent = events::where('stade_id', $request->stade_id)
            ->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
            ->first();

        // Vérifier si une maintenance existe avec les mêmes valeurs de state, date_debut
        $existingMaintenance = maintenances::where('stade_id', $request->stade_id)
            ->where('statut', 'accepté')
            ->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
            ->first();

        if ($existingEvent && $existingMaintenance) {
            return response()->json(['message' => 'Date déjà réserver'], 400);
        }
        $admin_equipe_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté
        $reservationData['admin_equipe_id'] = $admin_equipe_id;
        $reservationData['admin_fed_id'] = $admin_equipe_id;
        $reservation = reservations::create(array_merge($reservationData, ['statut' => $statut]));

        if ($reservation) {
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Ajout reservation',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);

            if ($historique) {
                $array = [
                    'data' => new reservationResource($reservation),
                    'message' => 'La réservation a été enregistrée',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
        }
        return response()->json(['message' => 'La réservation n\'a pas pu être enregistrée'], 400);
    }

    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date_debut' => 'required|date|date_format:Y-m-d|after_or_equal:' . date('Y-m-d'),
            'heure_debut' => 'required|date_format:H:i',
            'date_fin' => 'required|date|date_format:Y-m-d|after_or_equal:date_debut',
            'heure_fin' => 'required|date_format:H:i',
            'type_reservation' => 'required|string',
            'statut' => 'string|max:2023',
            'nom_match' => 'string|max:2023',
            'type_match' => 'string|max:2023',
            'stade_id' => 'required|exists:stades,id',
            'admin_equipe_id' => 'exists:users,id',
            'admin_fed_id' => 'exists:users,id',
            'equipe1_id' => 'exists:equipes,id',
            'equipe2_id' => 'exists:equipes,id',
        ]);

        if ($validator->fails()) {
            $array = [
                'data' => null,
                'message' => $validator->errors(),
                'status' => 400,
            ];
            return $array;
        }

        $reservation = reservations::find($id);
        if (!$reservation) {
            $array = [
                'data' => null,
                'message' => 'The reservation not Found',
                'status' => 404,
            ];
            return $array;
        }

        if ($reservation->statut === 'en attente') {
            $reservation->update($request->all());
            if ($reservation) {
                $todayDate = date('Y-m-d H:i:s');
                $admin_id = Auth::id();
                $historique = historiques::create([
                    'action' => 'Modifier reservation',
                    'date' => $todayDate,
                    'admin_fed_id' => $admin_id,
                ]);

                if ($historique) {
                    $array = [
                        'data' => new reservationResource($reservation),
                        'message' => 'The reservation update',
                        'historique' => new HistoriqueResource($historique),
                        'status' => 201,
                    ];
                    return response()->json($array);
                }
            }}
            else{
            return response()->json(['message' => 'Il n\'est pas possible de modifier la réservation car elle a déjà été acceptée.'], 400);
        }
    }

    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $reservation = reservations::find($id);
        if (!$reservation) {
            $array = [
                'data' => null,
                'message' => 'The reservation not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $reservation->delete($id);
        if ($reservation) {
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Supprimer reservation',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);

            if ($historique) {
                $array = [
                    'data' => new reservationResource($reservation),
                    'message' => 'The reservation delete',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
        }
    }

    //annuler reservation
    public function annulerReservation($id)
    {
        // Trouver la réservation en fonction de l'ID
        $reservation = reservations::find($id);

        // Vérifier si la réservation existe
        if (!$reservation) {
            $array = [
                'data' => null,
                'message' => 'échec operation',
                'status' => 501,
            ];
            return response($array);
        }
        $admin_fed_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté

        $admin_equipe_id = $reservation->admin_equipe_id;
        $admin_equipe = User::find($admin_equipe_id);
        $admin_email = $admin_equipe->email;
        Mail::to($admin_email)->send(new reservationrefuse($reservation));

        // Annuler la réservation (mettre à jour le statut par exemple)
        $reservation->update([
            'statut' => 'refusé',
            'admin_fed_id' => $admin_fed_id
        ]);

        $todayDate = date('Y-m-d H:i:s');
        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'Refuser reservation',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            $array = [
                'data' => new reservationResource($reservation),
                'message' => 'refusé avec success',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
            ];
            return response()->json($array);
        }
    }

    //filter liste de tous les réservation refusés
    public function ReservationFilterstatut()
    {
        $statut = 'refusé';

        // Effectuer la requête pour filtrer les reservations en fonction de la statut
        $reservations = reservations::where('statut', $statut)->get();

        // Créer une collection de ressources pour les reservations filtrées
        $reservationResource = reservationResource::collection($reservations);

        $array = [
            'data' => $reservationResource,
            'message' => 'OK',
            'status' => 200,
        ];

        // Retourner les reservations filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //filter liste de tous les réservation
    public function Reservationstatut(Request $request)
    {
        $statut = 'en attente';

        if ($request->user()->Roles()->get()[0]["name"] == "Admin Federation") {
            // Effectuer la requête pour filtrer les reservations en fonction de la statut
            $reservations = reservations::where('statut', $statut)->get();
        } elseif ($request->user()->Roles()->get()[0]["name"] == 'Admin Equipe') {
            $admin_id = Auth::id();
            // Si l'utilisateur est un admin d'équipe, filtrez les reservations en fonction de l'utilisateur et de la date d'aujourd'hui
            $reservations = reservations::where('statut', $statut)
                ->where('admin_equipe_id', $admin_id)
                ->get();
        } else {
            // Si l'utilisateur a un autre rôle, renvoyez une réponse vide
            $reservations = [];
        }
        // Créer une collection de ressources pour les reservations filtrées
        $reservationResource = reservationResource::collection($reservations);

        $array = [
            'data' => $reservationResource,
            'message' => 'OK',
            'status' => 200,
        ];

        // Retourner les reservations filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //filter les réservations en attentes d'aujourd'hui
    public function ReservationFilter(Request $request)
    {
        // Obtenez la date d'aujourd'hui
        $today = date('Y-m-d');

        // Obtenez l'utilisateur connecté
        $user = auth()->user();
        $statut = 'en attente';
        // Vérifiez le rôle de l'utilisateur
        if ($request->user()->Roles()->get()[0]["name"] == "Admin Federation") {
            // Effectuer la requête pour filtrer les reservations en fonction de la date d'aujourd'hui
            $reservations = reservations::whereDate('created_at', $today)
                ->where('statut', $statut)
                ->get();
        } elseif ($request->user()->Roles()->get()[0]["name"] == 'Admin Equipe') {
            // Si l'utilisateur est un admin d'équipe, filtrez les réservations en fonction de l'utilisateur et de la date d'aujourd'hui
            $reservations = reservations::where('admin_equipe_id', $user->id)
                ->where('statut', $statut)
                ->whereDate('created_at', $today)
                ->get();
        } else {
            // Si l'utilisateur a un autre rôle, renvoyez une réponse vide
            $reservations = [];
        }
        $reservationResource = reservationResource::collection($reservations);

        $array = [
            'data' => $reservationResource,
            'message' => 'OK',
            'statut' => 200,
        ];

        // Retourner les reservations filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //filter les réservations par date
    public function ReservationFilterDate($date)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if (isset($date)) {
            // Convertir la date de filtrage en objet Carbon pour une manipulation facile
            $filterDate = Carbon::parse($date)->toDateString();

            // Effectuer la requête pour filtrer les reservations en fonction de la date
            $reservations = reservations::whereDate('date', $filterDate)->get();
            $reservationsResource = reservationResource::collection($reservations);
            $array = [
                'data' => $reservationsResource,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune date de filtrage n'est spécifiée, récupérer tous les reservations
            $reservations = reservations::all();
            $reservationsResource = reservationResource::collection($reservations);
            $array = [
                'data' => $reservationsResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }
        return response($array);
    }

    //filter les réservations par type de reservation
    public function ReservationFilterType($type_reservation)
    {
        // Vérifier si un type de réservation de filtrage a été spécifié
        if (isset($type_reservation)) {

            // Effectuer la requête pour filtrer les réservations en fonction du type de réservation
            $reservations = reservations::where('type_reservation', $type_reservation)->get();
            $reservationsResource = ReservationResource::collection($reservations);
            $array = [
                'data' => $reservationsResource,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucun type de réservation de filtrage n'est spécifié, récupérer toutes les réservations
            $reservations = reservations::all();
            $reservationsResource = ReservationResource::collection($reservations);
            $array = [
                'data' => $reservationsResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }

        // Retourner les réservations filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

    //acceptReservation
    public function acceptReservation($reservationId)
    {
        $reservation = reservations::findOrFail($reservationId);

        // Vérifier si un event existe avec les mêmes valeurs de state, date_debut
        $existingEvent = events::where('stade_id', $reservation->stade_id)
            ->whereBetween('date_debut', [$reservation->date_debut, $reservation->date_fin])
            ->first();

        $existingMaintenance = maintenances::where('stade_id', $reservation->stade_id)
            ->where('statut', 'accepté')
            ->whereBetween('date_debut', [$reservation->date_debut, $reservation->date_fin])
            ->first();

        if ($existingEvent && $existingMaintenance) {
            return response()->json(['message' => 'Date déjà réserver'], 400);
        }
        // Créez un nouvel événement à partir des informations de la réservation
        $event = new events();
        $event->stade_id = $reservation->stade_id;
        $event->equipe1_id = $reservation->equipe1_id;
        $event->equipe2_id = $reservation->equipe2_id;
        $event->date_debut = $reservation->date_debut;
        $event->heure_debut = $reservation->heure_debut;
        $event->date_fin = $reservation->date_fin;
        $event->heure_fin = $reservation->heure_fin;
        $event->type_event = $reservation->type_reservation;
        $event->nom_event = $reservation->nom_event;
        $event->type_match = $reservation->type_match;
        $event->admin_equipe_id = $reservation->admin_equipe_id;
        $admin_fed_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté
        $event->admin_fed_id = $admin_fed_id;

        // Enregistrez l'événement
        $event->save();


        $admin_equipe_id = $reservation->admin_equipe_id;
        $admin_equipe = User::find($admin_equipe_id);
        $admin_email = $admin_equipe->email;
        Mail::to($admin_email)->send(new reservationaccepter($reservation));

        // Supprimez la réservation
        $reservation->delete();

        $todayDate = date('Y-m-d H:i:s');
        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'Accepter reservation',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            $array = [
                'data' => new reservationResource($reservation),
                'message' => 'Réservation acceptée et ajoutée à l\'événement.',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
            ];
            return response()->json($array);
        }
    }


}