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
        $todayDate = date('m-d-Y');
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'capacite' => 'nullable|numeric',
            'surface' => 'nullable|numeric',
            'proprietaire' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'etat' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_dernier_travaux' => 'nullable|date|date_format:m--Y|before_or_equal:' . $todayDate,
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
            return response($array, 201);
        }
        return response(null, 400, ['The stade not save']);
    }


    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $todayDate = date('m/d/Y');
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:255',
            'pays' => 'string|max:255',
            'capacite' => 'nullable|numeric',
            'surface' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'proprietaire' => 'string|max:255',
            'telephone' => 'string|max:255',
            'adresse' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'etat' => 'string|max:255',
            'description' => 'nullable|string',
            'date_dernier_travaux' => 'nullable|date|date_format:Y-m-d|before_or_equal:' . $todayDate,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => null,
                'message' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $stade = stades::find($id);
        if (!$stade) {
            return response()->json([
                'data' => null,
                'message' => 'Stade not found',
                'status' => 404,
            ], 404);
        }

        $validatedData = $validator->validated();

        $stade->update($validatedData);

        return response()->json([
            'data' => new StadeResource($stade),
            'message' => 'Stade updated successfully',
            'status' => 201,
        ], 201);
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
