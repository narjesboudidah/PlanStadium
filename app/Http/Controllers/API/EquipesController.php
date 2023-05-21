<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\equipeResource;
use App\Models\equipes;
use App\Http\Resources\historiqueResource;
use App\Models\historiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EquipesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index(Request $request)
    {

        $equipes = equipeResource::collection(equipes::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $equipes,
            'message' => 'ok',
            'status' => 200,
            'user' => $request->user(),
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
            'adresse' => 'required|unique:equipes|string|max:255',
            'pays' => 'required|string',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_web' => 'nullable|unique:equipes|string',
            'type_equipe' => 'required|string',
            'description' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $equipe = new equipes;
        $equipe->nom_equipe = $request->input('nom_equipe');
        $equipe->adresse = $request->input('adresse');
        $equipe->pays = $request->input('pays');
        $equipe->site_web = $request->input('site_web');
        $equipe->type_equipe = $request->input('type_equipe');
        $equipe->description = $request->input('description');
    
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = time() . '_' . $logo->getClientOriginalName();
            $path = $logo->move(public_path('uploads'), $filename);
            $equipe->logo = 'uploads/' . $filename;
        }
    
        if ($equipe->save()) {
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Ajout équipe',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);
    
            if ($historique) {
                $array = [
                    'data' => $equipe,
                    'message' => 'The equipe is saved.',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
        }
    
        return response()->json(['message' => 'Failed to save the equipe.'], 400);
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
    ]);

    $equipe->update($validatedData);

    $todayDate = date('Y-m-d H:i:s');
    $admin_id = Auth::id();
    $historique = historiques::create([
         'action' => 'Modifier équipe',
         'date' => $todayDate,
         'admin_fed_id' => $admin_id,
        ]);
    
     if ($historique) {
        $array = [
        'data' => new equipeResource($equipe),
        'message' => 'equipe updated successfully',
        'historique' => new HistoriqueResource($historique),
        'status' => 201,
        ];
        return response()->json($array);
    }
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
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                 'action' => 'Supprimer équipe',
                 'date' => $todayDate,
                 'admin_fed_id' => $admin_id,
                ]);
            
             if ($historique) {
                $array = [
                'data' => new equipeResource($equipe),
                'message' => 'The equipes delete',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
                ];
                return response()->json($array);
            }
        }
    }
}
