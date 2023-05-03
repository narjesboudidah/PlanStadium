<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\eventResource;
use App\Models\events;
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
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'type_reservation' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'equipe_id' => 'required|exists:equipes,id',
            'stade_id' => 'required|exists:stades,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response([
                "message" => "invalid data",
                "validation_errors" => $validator->errors()
            ], 422, [$validator->errors()]);
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
            'date_debut' => 'required|date|date_format:Y-m-d',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'type_reservation' => 'required|max:255',
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

        $event = events::find($id);
        if (!$event) {
            $array = [
                'data' => null,
                'message' => 'The event not Found',
                'status' => 404,
            ];
            return $array;
        }

        $event->update($request->all());
        if ($event) {
            $array = [
                'data' => new eventResource($event),
                'message' => 'The event update',
                'status' => 201,
            ];
            return response($array);
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
}
