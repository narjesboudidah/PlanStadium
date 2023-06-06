<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\stadeResource;
use App\Models\stades;
use App\Http\Resources\historiqueResource;
use App\Models\historiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class stadesController extends Controller
{
    /*Display a listing of the resource.*/

    public function getEvents($id)
    {
        $stade = stades::find($id);
        if ($stade) {
            $array = [
                'data' => $stade->events()->get(),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The stade not found']);
    }
    public function getMaintenances($id)
    {
        $stade = stades::find($id);
        if ($stade) {
            $array = [
                'data' => $stade->maintenances()->get(),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The stade not found']);
    }
    public function getMatches($id)
    {
        $stade = stades::find($id);
        if ($stade) {
            $array = [
                'data' => $stade->matchs()->get(),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The stade not found']);
    }
    public function index()
    {
        $stades = stades::all();
    
        $stadesData = [];
        foreach ($stades as $stade) {
            $imageUrl = url($stade->image);
            $stadesData[] = [
                'id' => $stade->id,
                'nom' => $stade->nom,
                'pays' => $stade->pays,
                'capacite' => $stade->capacite,
                'surface' => $stade->surface,
                'proprietaire' => $stade->proprietaire,
                'telephone' => $stade->telephone,
                'adresse' => $stade->adresse,
                'image' => $imageUrl,
                'etat' => $stade->etat,
                'description' => $stade->description,
                'date_dernier_travaux' => $stade->date_dernier_travaux,
            ];
        }
    
        $array = [
            'data' => $stadesData,
            'message' => 'ok',
            'status' => 200,
        ];
    
        return response()->json($array);
    }

    /*Display the specified resource.*/
        public function show($id)
    {
        $stade = stades::find($id);
        if ($stade) {
            $imageUrl = url($stade->image);
            $stadesData = [
                'nom' => $stade->nom,
                'pays' => $stade->pays,
                'capacite' => $stade->capacite,
                'surface' => $stade->surface,
                'proprietaire' => $stade->proprietaire,
                'telephone' => $stade->telephone,
                'adresse' => $stade->adresse,
                'image' => $imageUrl, // Assurez-vous que l'URL complète de l'image est correcte
                'etat' => $stade->etat,
                'description' => $stade->description,
                'date_dernier_travaux' => $stade->date_dernier_travaux,
            ];
            $array = [
                'data' => $stadesData,
                'message' => 'ok',
                'status' => 200,
            ];
            return response()->json($array);
        }
        return response()->json(null, 401, ['The stade not found']);
    }

    public function showimage($nom)
    {
        $stade = stades::where('nom', $nom)->first();
        if ($stade) {
            $logoUrl = url($stade->image);
            $stadesData = [
                'image' => $logoUrl
            ];
            $array = [
                'data' => $stadesData,
                'message' => 'ok',
                'status' => 200,
            ];
        
            return response()->json($array);
        }
        return response()->json(null, 401, ['The stade not found']);
    }
    public function shownom($id)
    {
        $stade = stades::find($id);
        if ($stade) {
            $array = [
                'data' => $stade->nom, 
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(['message' => 'The stadium not found'], 401);
    }

    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        $todayDate = date('Y-m-d');
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'capacite' => 'nullable|string',
            'surface' => 'nullable|string',
            'proprietaire' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'etat' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_dernier_travaux' => 'required|date|date_format:Y-m-d|before_or_equal:' . $todayDate,
        ]);

        if ($validator->fails()) {
            return response(null, 400, [$validator->errors()]);
        }

        $stade = stades::create($request->all());
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $stade->image = str_replace('public/', 'storage/', $imagePath);
            $stade->save();
        }
        $imageUrl = asset($stade->image);
    
        if ($stade) {
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'ajout Ste',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);
    
            if ($historique) {
                // Récupérer l'URL complète de l'image
                $imageUrl = url($stade->image);
    
                $array = [
                    'data' => new stadeResource($stade),
                    'message' => 'The stade saved',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                    'image_url' => $imageUrl,
                ];
                return response()->json($array);
            }
        }
    
        return response(null, 400, ['The stade not saved']);
    }

    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $todayDate = date('Y-m-d');
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:255',
            'pays' => 'string|max:255',
            'capacite' => 'nullable|string',
            'surface' => 'nullable|string',
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
        $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Modifier stade',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);

            if ($historique) {
                $array = [
                    'data' => new stadeResource($stade),
                    'message' => 'Stade updated successfully',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
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
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Supprimer stade',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);

            if ($historique) {
                $array = [
                    'data' => new stadeResource($stade),
                    'message' => 'The stade delete',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
        }
    }
    public function getnom($id)
    {
        $stade = stades::where('id', '!=', $id)->get();
        
        $stadeResource = stadeResource::collection($stade);

        $array = [
            'data' => $stadeResource,
            'message' => 'OK',
            'status' => 200,
        ];

        // Retourner les maintenances filtrées à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }
}
