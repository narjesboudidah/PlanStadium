<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\competitionResource;
use App\Models\competitions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompetitionsController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $competitions = competitionResource::collection(competitions::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $competitions,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }


    /*Display the specified resource.*/
    public function show($id)
    {
        $competition = competitions::find($id);
        if ($competition) {
            $array = [
                'data' => new competitionResource($competition),
                'message' => 'ok',
                'status' => 200,
            ];
            return response()->json($array);
        }
        return response()->json(['The competitions not found'],404);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'annee' => 'required|digits:4|integer|min:1900|max:2024',
            'date_debut' => 'required|date|date_format:Y-m-d',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            'type_competition' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'organisateur' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()],400);
        }


        $competition = competitions::create($request->all());
        if ($competition) {
            $array = [
                'data' => new competitionResource($competition),
                'message' => 'The competition has been saved',
                'status' => 201,
            ];
            return response()->json($array);
        }
        return response()->json(['message' => 'The competition could not be saved'], 400);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $competition = competitions::find($id);
        if (!$competition) {
            return response()->json([
                'data' => null,
                'message' => 'Competition not found',
                'status' => 404,
            ], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'nom' => 'max:255',
            'annee' => 'integer|max:2024',
            'date_debut' => 'date_format:Y-m-d',
            'date_fin' => 'date_format:Y-m-d|after:date_debut',
            'type_competition' => 'max:255',
            'categorie' => 'max:255',
            'organisateur' => 'max:255',
            'description' => 'max:255',
            'user_id' => 'exists:users,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
    
        $competition->update($request->all());
        return response()->json([
            'message' => 'The competition was updated',
            'status' => 201,
        ], 201);
    }    

    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $competition = competitions::find($id);
        // Vérifier si la compétition existe
        if (!$competition) {
            return response()->json(['message' => 'The competition was not found'], 404);
        }
        
        // Supprimer la compétition
        $competition->delete($id);
        if ($competition) {
            return response()->json(['message' => 'The competition was deleted'], 200);
        }
    }

    public function competitionFilter($annee)
    {
        // Vérifier si une année de filtrage a été spécifiée
        if ($annee) {

            // Effectuer la requête pour filtrer les compétitions en fonction de l'année
            $competitions = competitions::where('annee', $annee)->get();
            $competitionsResource = competitionResource::collection($competitions);
            $array = [
                'data' => $competitionsResource,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune année de filtrage n'est spécifiée, récupérer toutes les compétitions
            $competitions = competitions::all();
            $competitionsResource = competitionResource::collection($competitions);
            $array = [
                'data' => $competitionsResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }

        // Retourner les compétitions filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

}