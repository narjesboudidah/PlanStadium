<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\reservationResource;
use App\Models\events;
use App\Models\reservations;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            'date_debut' => 'required|date|date_format:Y-m-d',
            'heure_debut' => 'required|date_format:H:i',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
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

        $admin_equipe_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté
        $statut = 'en attente';

        $reservation = reservations::create(array_merge($request->all(), ['admin_equipe_id' => $admin_equipe_id, 'admin_fed_id' => $admin_equipe_id, 'statut' => $statut]));

        if ($reservation) {
            $array = [
                'data' => new reservationResource($reservation),
                'message' => 'The reservation save',
                'status' => 201,
            ];
            return response()->json($array);
        }
        return response()->json(['message' => 'The reservation not save'], 400);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date_debut' => 'date|date_format:Y-m-d',
            'heure_debut' => 'date_format:H:i',
            'date_fin' => 'date|date_format:Y-m-d|after:date_debut',
            'heure_fin' => 'date_format:H:i',
            'type_reservation' => 'string',
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

        $reservation->update($request->all());
        if ($reservation) {
            $array = [
                'data' => new reservationResource($reservation),
                'message' => 'The reservation update',
                'status' => 201,
            ];
            return response($array);
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
            $array = [
                'data' => null,
                'message' => 'The reservation delete',
                'status' => 200,
            ];
            return response($array);
        }
    }

    

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

        // Annuler la réservation (mettre à jour le statut par exemple)
        $reservation->update([
            'statut' => 'refusé',
            'admin_fed_id' => $admin_fed_id
        ]);

        // Rediriger avec un message de succès
        $array = [
            'data' => null,
            'message' => 'refusé avec success',
            'status' => 501,
        ];
        return response($array);
    }

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


    public function acceptReservation($reservationId)
    {
        $reservation = reservations::findOrFail($reservationId);

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
        $admin_fed_id = Auth::id(); // Récupérer l'ID de l'administrateur connecté
        $event->admin_fed_id = $admin_fed_id;
        // Enregistrez l'événement
        $event->save();

        // Supprimez la réservation
        $reservation->delete();

        return response()->json(['message' => 'Réservation acceptée et ajoutée à l\'événement.']);
    }


}