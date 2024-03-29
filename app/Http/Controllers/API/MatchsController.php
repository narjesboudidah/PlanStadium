<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\matchResource;
use App\Models\equipes;
use App\Models\matchs;
use App\Http\Resources\historiqueResource;
use App\Models\historiques;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MatchsController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {   //En cas de retour plusieurs matchs
        $matchs = matchResource::collection(matchs::get()); 
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
            'nom' => 'nullable|string|max:255',
            'date' => 'required|date|date_format:Y-m-d',
            'heure' => 'required|date_format:H:i',
            'type_match' => 'required|string|max:255',
            'competition_id' => 'required|exists:competitions,id',
            'stade_id' => 'required|exists:stades,id',
            'equipe1_id' => 'required|exists:equipes,id',
            'equipe2_id' => 'required|exists:equipes,id',
        ]);
        //En cas de probléme
        if ($validator->fails()) { 
            return response(null, 400, [$validator->errors()]);
        }


        $match = matchs::create($request->all());
        if ($match) {
            $todayDate = date('Y-m-d H:i:s');
            $admin_id = Auth::id();
            $historique = historiques::create([
                'action' => 'Ajout match',
                'date' => $todayDate,
                'admin_fed_id' => $admin_id,
            ]);

            if ($historique) {
                $array = [
                    'data' => new matchResource($match),
                    'message' => 'The matchs save',
                    'historique' => new HistoriqueResource($historique),
                    'status' => 201,
                ];
                return response()->json($array);
            }
        }
        return response(null, 400, ['The matchs not save']);
    }

    /*Update the specified resource in storage.*/
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'string',
            'date' => 'date|date_format:Y-m-d',
            'heure' => 'date_format:H:i',
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
        $todayDate = date('Y-m-d H:i:s');
        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'Modifier match',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            $array = [
                'data' => new matchResource($match),
                'message' => 'The match updated successfully',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
            ];
            return response()->json($array);
        }
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
            $todayDate = date('Y-m-d H:i:s');
        $admin_id = Auth::id();
        $historique = historiques::create([
            'action' => 'Supprimer match',
            'date' => $todayDate,
            'admin_fed_id' => $admin_id,
        ]);

        if ($historique) {
            $array = [
                'data' => new matchResource($match),
                'message' => 'The matchs delete',
                'historique' => new HistoriqueResource($historique),
                'status' => 201,
            ];
            return response()->json($array);
        }
        }
    }

    public function Matchlogo($id)
{
        $logo = equipes::select('logo')->where('id', $id)->first();

        if ($logo) {
            $logo1 = 'http://127.0.0.1:8000/' . $logo->logo;
            $array = [
                'data' => $logo1,
                'message' => 'OK',
                'statut' => 200,
            ];

            return response($array);
        }
    
    // Si aucun utilisateur ou logo n'est trouvé, retourner une réponse appropriée
    return response([
        'message' => 'Logo introuvable',
        'statut' => 404,
    ], 404);
}

   /* public function matchFilter($date)
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
    }*/

    public function matchFilter($date, $stade_id)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if (isset($date)) {
            // Supprimer les caractères indésirables de la chaîne de date
            $date = str_replace(['{', '}'], '', $date);
    
            // Convertir la date de début de filtrage en objet Carbon pour une manipulation facile
            $filterDate = Carbon::parse($date)->toDateString();
    
            // Effectuer la requête pour filtrer les événements en fonction de l'ID du stade et de la date de début
            $matchs = matchs::where('stade_id', $stade_id)
                ->whereDate('date', '=', $filterDate)
                ->get();
    
            $matchResource = matchResource::collection($matchs);
            $array = [
                'data' => $matchs,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune date de filtrage n'est spécifiée, récupérer tous les événements
            $matchs = matchs::all();
            $matchResource = matchResource::collection($matchs);
            $array = [
                'data' => $matchResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }
    
        // Retourner les événements filtrés à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }    
    public function matchFilterStade($stade_id)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if (isset($stade_id)) {
            $matchs = matchs::where('stade_id', $stade_id)
                ->get();
    
            $matchResource = matchResource::collection($matchs);
            $array = [
                'data' => $matchs,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune date de filtrage n'est spécifiée, récupérer tous les événements
            $matchs = matchs::all();
            $matchResource = matchResource::collection($matchs);
            $array = [
                'data' => $matchResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }
    
        // Retourner les événements filtrés à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }    

    public function matchFilterC($competition_id)
    {
        // Vérifier si une ID de compétition de filtrage a été spécifiée
        if (isset($competition_id)) {

            $matchs = matchs::where('competition_id', $competition_id)
                ->get();

            $matchResource = matchResource::collection($matchs);
            $array = [
                'data' => $matchResource,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            $matchs = matchs::all();
            $matchResource = matchResource::collection($matchs);
            $array = [
                'data' => $matchResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }

        return response()->json($array);
    }
        

}