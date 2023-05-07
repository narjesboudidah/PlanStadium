<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\matchResource;
use App\Models\matchs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i',
            'type_match' => 'required|string|max:255',
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
            'date' => 'date|date_format:Y-m-d',
            'heure_debut' => 'date_format:H:i',
            'heure_fin' => 'date_format:H:i',
            'type_match' => 'string',
            'competition_id' => 'exists:competitions,id',
            'stade_id' => 'exists:stades,id',
            'equipe1_id' => 'exists:equipes,id',
            'equipe2_id' => [
                'exists:equipes,id',
                Rule::notIn([$request->get('equipe1_id')])
            ],
        ]);
    
        if ($validator->fails()) {
            return response([
                'data' => null,
                'message' => $validator->errors(),
                'status' => 400,
            ]);
        }
    
        $match = matchs::find($id);
        if (!$match) {
            return response([
                'data' => null,
                'message' => 'The match not found',
                'status' => 404,
            ]);
        }
    
        $match->update($request->all());
        return response([
            'data' => new matchResource($match),
            'message' => 'The match updated successfully',
            'status' => 200,
        ]);
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

    public function matchFilter($date)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if (isset($date)) {
            // Convertir la date de filtrage en objet Carbon pour une manipulation facile
            $filterDate = Carbon::parse($date)->toDateString();

            // Effectuer la requête pour filtrer les matchs en fonction de la date
            $matchs = matchs::whereDate('date', $filterDate)->get();
            $matchsResource = matchResource::collection($matchs);
            $array = [
                'data' => $matchsResource,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune date de filtrage n'est spécifiée, récupérer tous les matchs
            $matchs = matchs::all();
            $matchsResource = matchResource::collection($matchs);
            $array = [
                'data' => $matchsResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }

        // Retourner les matchs filtrés à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }
}