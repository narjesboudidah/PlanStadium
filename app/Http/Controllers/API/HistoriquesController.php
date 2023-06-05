<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\historiqueResource;
use App\Models\historiques;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class historiquesController extends Controller
{
    /*Display a listing of the resource.*/
    public function index()
    {   //En cas de retour plusieurs historiques
        $historiques = historiqueResource::collection(historiques::get()); 
        $array = [
            'data' => $historiques,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }


    /*Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        $todayDate = date('Y/m/d');
        $validator = Validator::make($request->all(), [
            'action' => 'required|max:255',
            'date' => 'required|date|date_format:Y-m-d|before_or_equal:'.$todayDate,
            'admin_fed_id' => 'required|exists:users,id',
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

    public function historiqueFilter($date)
    {
        // Vérifier si une date de filtrage a été spécifiée
        if ($date) {
            // Convertir la date de filtrage en objet Carbon pour une manipulation facile
            $filterDate = Carbon::parse($date)->toDateString();

            // Effectuer la requête pour filtrer les historiques en fonction de la date
            $historiques = historiques::whereDate('date', $filterDate)->get();
            $historiqueResource = historiqueResource::collection($historiques);
            $array = [
                'data' => $historiqueResource,
                'message' => 'OK',
                'status' => 200,
            ];
        } else {
            // Si aucune date de filtrage n'est spécifiée, récupérer tous les historiques
            $historiques = historiques::all();
            $historiqueResource = historiqueResource::collection($historiques);
            $array = [
                'data' => $historiqueResource,
                'message' => 'OK',
                'status' => 200,
            ];
        }

        // Retourner les historiques filtrés à la vue ou effectuer d'autres actions nécessaires
        return response($array);
    }

}