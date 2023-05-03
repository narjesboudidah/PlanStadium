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
            'date_debut' => 'required|date|date_format:Y-m-d|after_or_equal:'.$todayDate,
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'type_reservation' => 'required',
            'statut' => 'required|max:2023',
            'user_id' => 'required|exists:users,id',
            'equipe_id' => 'required|exists:equipes,id',
            'stade_id' => 'required|exists:stades,id',
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
        $todayDate = date('m/d/Y');
        $validator = Validator::make($request->all(), [
            'date_debut' => 'required|date|date_format:Y-m-d|after_or_equal:'.$todayDate,
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'type_reservation' => 'required',
            'statut' => 'required|max:2023',
            'user_id' => 'required|exists:users,id',
            'equipe_id' => 'required|exists:equipes,id',
            'stade_id' => 'required|exists:stades,id',
        ]);

        if ($validator->fails()) {
            $array = [
                'data' => null,
                'message' => $validator->errors(),
                'status' => 400,
            ];
            //return response(null,400,[$validator->errors()]);
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
                'message' => 'The user update',
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
}
