<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\historiqueResource;
use App\Models\historiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class historiquesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $historiques = historiqueResource::collection(historiques::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $historiques,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }


    /*Display the specified resource.*/
    public function show($id)
    {
        $historique = historiques::find($id);
        if ($historique) {
            $array = [
                'data' => new historiqueResource($historique),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The historique not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        $todayDate = date('m/d/Y');
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|date_format:Y-m-d|before_or_equal:'.$todayDate,
            'action' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $historique = historiques::create($request->all());
        if ($historique) {
            $array = [
                'data' => new historiqueResource($historique),
                'message' => 'The historique save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The historique not save']);
    }

}