<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\stadeResource;
use App\Models\stades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class stadesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $stades = stadeResource::collection(stades::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $stades,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $stade = stades::find($id);
        if ($stade) {
            $array = [
                'data' => new stadeResource($stade),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The stade not found']);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        $todayDate = date('m/d/Y');
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'capacite' => 'nullable|numeric',
            'surface' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'altitude' => 'nullable|numeric',
            'proprietaire' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
            'date_dernier_traveaux' => 'nullable|date|date_format:Y-m-d|before_or_equal:' . $todayDate,
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $stade = stades::create($request->all());
        if ($stade) {
            $array = [
                'data' => new stadeResource($stade),
                'message' => 'The stade save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The stade not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $todayDate = date('m/d/Y');
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'capacite' => 'nullable|numeric',
            'surface' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'altitude' => 'nullable|numeric',
            'proprietaire' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
            'date_dernier_traveaux' => 'nullable|date|date_format:Y-m-d|before_or_equal:' . $todayDate,
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

        $stade = stades::find($id);
        if (!$stade) {
            $array = [
                'data' => null,
                'message' => 'The stade not Found',
                'status' => 404,
            ];
            return $array;
        }

        $stade->update($request->all());
        if ($stade) {
            $array = [
                'data' => new stadeResource($stade),
                'message' => 'The stade update',
                'status' => 201,
            ];
            return response($array);
        }
    }


    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $stade = stades::find($id);
        if (!$stade) {
            $array = [
                'data' => null,
                'message' => 'The stade not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $stade->delete($id);
        if ($stade) {
            $array = [
                'data' => null,
                'message' => 'The stade delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}