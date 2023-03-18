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
            return response($array);
        }
        return response(null, 401, ['The competitions not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:255',
            'annee' => 'required|digits:4|integer|min:1900|max:2024',
            'date_debut' => 'required|date|date_format:Y-m-d',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            //lazem tben fl vue  
            'type_competition' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response(null, 400, [$validator->errors()]);
        }


        $competition = competitions::create($request->all());
        if ($competition) {
            $array = [
                'data' => new competitionResource($competition),
                'message' => 'The competitions save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The competitions not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:255',
            'annee' => 'required|digits:4|integer|min:1900|max:2024',
            'date_debut' => 'required|date|date_format:Y-m-d',
            'date_fin' => 'required|date|date_format:Y-m-d|after:date_debut',
            //lazem tben fl vue  
            'type_competition' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
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

        $competition = competitions::find($id);
        if (!$competition) {
            $array = [
                'data' => null,
                'message' => 'The competitions not Found',
                'status' => 404,
            ];
            return $array;
        }

        $competition->update($request->all());
        if ($competition) {
            $array = [
                'data' => new competitionResource($competition),
                'message' => 'The competitions update',
                'status' => 201,
            ];
            return response($array);
        }
    }


    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $competition = competitions::find($id);
        if (!$competition) {
            $array = [
                'data' => null,
                'message' => 'The competitions not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $competition->delete($id);
        if ($competition) {
            $array = [
                'data' => null,
                'message' => 'The competitions delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}