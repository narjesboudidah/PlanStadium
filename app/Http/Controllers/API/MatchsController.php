<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\matchResource;
use App\Models\matchs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchsController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $matchs = matchResource::collection(matchs::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $matchs,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }


    /*Display the specified resource.*/
    public function show($id)
    {
        $match = matchs::find($id);
        if ($match) {
            $array = [
                'data' => new matchResource($match),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The matchs not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date' => 'required|date|date_format:Y-m-d',
            'heure' => 'required|date_format:H:i',
            'type_match' => 'required|string|unique:matchs',
            'user_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competitions,id',
            'stade_id' => 'required|exists:stades,id',
            'equipe1_id' => 'required|exists:equipes,id',
            'equipe2_id' => 'required|exists:equipes,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $match = matchs::create($request->all());
        if ($match) {
            $array = [
                'data' => new matchResource($match),
                'message' => 'The matchs save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The matchs not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'date' => 'required|date|date_format:Y-m-d',
            'heure' => 'required|date_format:H:i',
            'type_match' => 'required|unique:matchs',
            'user_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competitions,id',
            'stade_id' => 'required|exists:stades,id',
            'equipe1_id' => 'required|exists:equipes,id',
            'equipe2_id' => 'required|exists:equipes,id',
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

        $match = matchs::find($id);
        if (!$match) {
            $array = [
                'data' => null,
                'message' => 'The matchs not Found',
                'status' => 404,
            ];
            return $array;
        }

        $match->update($request->all());
        if ($match) {
            $array = [
                'data' => new matchResource($match),
                'message' => 'The matchs update',
                'status' => 201,
            ];
            return response($array);
        }
    }


    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $match = matchs::find($id);
        if (!$match) {
            $array = [
                'data' => null,
                'message' => 'The matchs not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $match->delete($id);
        if ($match) {
            $array = [
                'data' => null,
                'message' => 'The matchs delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}