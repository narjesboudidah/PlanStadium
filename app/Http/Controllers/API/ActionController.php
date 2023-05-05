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
