<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\actionResource;
use App\Models\action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ActionController extends Controller
{
    public function index()
    {
        $actions = actionResource::collection(action::get()); //ki tabda bech trajaa akther min 7aja
        $array = [
            'data' => $actions,
            'message' => 'ok',
            'status' => 200,
        ];
        return response($array);
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'titre' => 'required|max:255',
            'historique_id' => 'required|exists:historiques,id',
        ]);

        if ($validator->fails()) { //ken fama mochkil
            return response(null, 400, [$validator->errors()]);
        }


        $action = action::create($request->all());
        if ($action) {
            $array = [
                'data' => new actionResource($action),
                'message' => 'The actions save',
                'status' => 201,
            ];
            return response($array);
        }
        return response(null, 400, ['The actions not save']);
    }


    /*Display the specified resource.*/
    public function show($id)
    {
        $action = action::find($id);
        if ($action) {
            $array = [
                'data' => new actionResource($action),
                'message' => 'ok',
                'status' => 200,
            ];
            return response($array);
        }
        return response(null, 401, ['The actions not found']);
    }

}
