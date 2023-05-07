<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\equipeResource;
use App\Models\equipes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EquipesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {
        $equipes = equipeResource::collection(equipes::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $equipes,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $equipe = equipes::find($id);
        if ($equipe) {
            $array = [
                'data' => new equipeResource($equipe),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The equipe not found']);
    }

    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nom_equipe' => 'required|max:255|unique:equipes',
            'adresse' => 'required|string|max:255',
            'pays' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_web' => 'nullable|string',
            'type_equipe' => 'required|string',
            'description' => 'nullable|string',
            'admin_equipe_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $equipe = equipes::create($request->all());
        if ($equipe) {
            $array = [
                'data' => new equipeResource($equipe),
                'message' => 'The equipes save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The equipes not save']);
    }

    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
{
    $equipe = equipes::find($id);
    if (!$equipe) {
        return response()->json([
            'data' => null,
            'message' => 'equipe not found',
            'status' => 404,
        ], 404);
    }

    $validatedData = $request->validate([
        'nom_equipe' => Rule::unique('equipes')->ignore($id),
            'adresse' => 'max:255',
            'pays' => 'string',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_web' => 'string',
            'type_equipe' => 'string',
            'description' => 'string',
            'admin_equipe_id' => 'exists:users,id',
    ]);

    $equipe->update($validatedData);

    return response()->json([
        'data' => new equipeResource($equipe),
        'message' => 'equipe updated successfully',
        'status' => 201,
    ], 201);
}
    


    /* Remove the specified resource from storage.*/
    public function destroy($id)
    {

        $equipe = equipes::find($id);
        if (!$equipe) {
            $array = [
                'data' => null,
                'message' => 'The equipes not Found',
                'status' => 404,
            ];
            return response($array);
        }
        $equipe->delete($id);
        if ($equipe) {
            $array = [
                'data' => null,
                'message' => 'The equipes delete',
                'status' => 200,
            ];
            return response($array);
        }
    }
}