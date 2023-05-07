<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\reservationResource;
use App\Models\reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class reservationsController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $reservations = reservationResource::collection(reservations::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $reservations,
            'message' => 'ok',
            'status' => 200,
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
        $todayDate = date('m/d/Y');
        $validator = Validator::make($request->all(), [
            'note' => 'required|string|max:2023',
            'date_debut' => 'required|date|date_format:Y-m-d',
            'heure_debut' => 'required|date_format:H:i',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'heure_fin' => 'required|date_format:H:i',
            'type_reservation' => 'required|string',
            'statut' => 'required|string|max:2023',
            'admin_equipe_id' => 'required|exists:users,id',
            'admin_fed_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $reservation = reservations::create($request->all());
        if ($reservation) {
            $array = [
                'data' => new reservationResource($reservation),
                'message' => 'The user save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The reservation not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'string|max:2023',
            'date_debut' => 'date|date_format:Y-m-d',
            'heure_debut' => 'date_format:H:i',
            'date_fin' => 'date|date_format:Y-m-d|after:date_debut',
            'heure_fin' => 'date_format:H:i',
            'type_reservation' => 'string',
            'statut' => 'string|max:2023',
            'admin_equipe_id' => 'exists:users,id',
            'admin_fed_id' => 'exists:users,id',
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

    public function confirmerReservation($id)
    {
        // Trouver la réservation en fonction de l'ID
        $reservation = reservations::find($id);

        // Vérifier si la réservation existe
        if (!$reservation) {
            return redirect()->back()->with('error', 'La réservation n\'existe pas.');
        }

        // Confirmer la réservation (mettre à jour le statut par exemple)
        $reservation->update([
            'statut' => 'confirmée'
        ]);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Réservation confirmée avec succès.');
    }

    public function annulerReservation($id)
    {
        // Trouver la réservation en fonction de l'ID
        $reservation = reservations::find($id);

        // Vérifier si la réservation existe
        if (!$reservation) {
            return redirect()->back()->with('error', 'La réservation n\'existe pas.');
        }

        // Annuler la réservation (mettre à jour le statut par exemple)
        $reservation->update([
            'statut' => 'annulée'
        ]);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Réservation annulée avec succès.');
    }


}