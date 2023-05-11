<?php

namespace App\Http\Controllers;

use App\Models\equipes;
use App\Models\societe_maintenances;
use App\Models\stades;
use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function getCountStats()
    {
        return response([
            'users' => User::all()->count(),
            'stades' => stades::all()->count(),
            'equipes' => equipes::all()->count(),
            'ste_maintenance' => societe_maintenances::all()->count(),
        ],200);       
    }
}
