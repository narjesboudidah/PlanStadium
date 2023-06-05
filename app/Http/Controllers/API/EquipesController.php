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
    public function index()
    {
        $equipes = equipes::all();
    
        $equipesData = [];
        foreach ($equipes as $equipe) {
            $logoUrl = url($equipe->logo);
            $equipesData[] = [
                'id' => $equipe->id,
                'nom_equipe' => $equipe->nom_equipe,
                'adresse' => $equipe->adresse,
                'pays' => $equipe->pays,
                'logo' => $logoUrl,
                'site_web' => $equipe->site_web,
                'type_equipe' => $equipe->type_equipe,
                'description' => $equipe->description,
            ];
        }
    
        $array = [
            'data' => $equipesData,
            'message' => 'ok',
            'status' => 200,
        ];
    
        return response()->json($array);
    }

    /*Display the specified resource.*/
    public function show($id)
    {
        $equipe = equipes::find($id);
        if ($equipe) {
            $logoUrl = url($equipe->logo);
            $equipesData[] = [
                'id' => $equipe->id,
                'nom_equipe' => $equipe->nom_equipe,
                'adresse' => $equipe->adresse,
                'pays' => $equipe->pays,
                'logo' => $logoUrl,
                'site_web' => $equipe->site_web,
                'type_equipe' => $equipe->type_equipe,
                'description' => $equipe->description,
            ];
        $array = [
            'data' => $equipesData,
            'message' => 'ok',
            'status' => 200,
        ];
    
        return response()->json($array);
    }
    return response()->json(null, 401, ['The equipe not found']);
    }

    public function showimage($nom)
{
    $equipe = equipes::where('nom_equipe', $nom)->first();
    if ($equipe) {
        $logoUrl = url($equipe->logo);
        $equipesData = [
            'logo' => $logoUrl
        ];
        $array = [
            'data' => $equipesData,
            'message' => 'ok',
            'status' => 200,
        ];
    
        return response()->json($array);
    }
    return response()->json(null, 401, ['The equipe not found']);
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
            return response(null, 400, [$validator->errors()]);
        }
    
        $equipes = equipes::create($request->all());
    if ($request->hasFile('logo')) {
        $imagePath = $request->file('logo')->store('public/images');
        $equipes->logo = str_replace('public/', 'storage/', $imagePath);
        $equipes->save();
    }
    $imageUrl = asset($equipes->logo);

    if ($equipes) {
        $todayDate = date('Y-m-d H:i:s');
        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'ajout Ste',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            // Récupérer l'URL complète de l'image
            $imageUrl = url($equipes->logo);

            $array = [
                'data' => new equipeResource($equipes),
                'message' => 'The equipes saved',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
                'image_url' => $imageUrl,
            ];
            return response()->json($array);
        }
    }

    return response(null, 400, ['The equipes not saved']);
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
