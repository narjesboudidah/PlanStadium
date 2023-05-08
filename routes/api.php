<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\MatchsController;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\historiquesController;
use App\Http\Controllers\API\CompetitionsController;
use App\Http\Controllers\API\MaintenancesController;
use App\Http\Controllers\API\equipesController;
use App\Http\Controllers\API\societeMaintenancesController;
use App\Http\Controllers\API\StadesController;
use App\Http\Controllers\API\permissionsController;
use App\Http\Controllers\API\permission_rolesController;
use App\Http\Controllers\API\RoleUserPivotController;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\ReservationsController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
// return $request->user();
// });

//Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/Competitions', [CompetitionsController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {

    //Event
    Route::get('/events', [EventsController::class, 'index']);//->middleware('superadmin', 'admin_equipe');
    Route::post('/events', [EventsController::class, 'store']);//->middleware('superadmin');
    Route::get('/event/{id}', [EventsController::class, 'show']);//->middleware('superadmin', 'admin_equipe');
    Route::put('/event/{id}', [EventsController::class, 'update']);//->middleware('superadmin');
    Route::delete('/event/{id}', [EventsController::class, 'destroy']);//->middleware('superadmin', 'admin_equipe');
    Route::get('events/filter/{date_debut}', [EventsController::class, 'eventFilter']);//->middleware('superadmin', 'admin_equipe');

    //User
    Route::get('/users', [userController::class, 'index']);//->middleware('superadmin', 'admin_equipe', 'admin_ste');
    Route::post('/users', [userController::class, 'store']);//->middleware('superadmin');
    Route::get('/user/{id}', [userController::class, 'show']);//->middleware('superadmin', 'admin_equipe', 'admin_ste');
    Route::put('/user/{id}', [userController::class, 'update']);//->middleware('superadmin');
    Route::delete('/user/{id}', [userController::class, 'destroy']);//->middleware('superadmin');

    //Maintenances
    Route::get('/maintenances', [MaintenancesController::class, 'index']);//->middleware('superadmin', 'admin_ste');
    Route::post('/maintenances', [MaintenancesController::class, 'store']);//->middleware('superadmin', 'admin_ste');
    Route::get('/maintenance/{id}', [MaintenancesController::class, 'show']);//->middleware('superadmin', 'admin_ste');
    Route::put('/maintenance/{id}', [MaintenancesController::class, 'update']);//->middleware('superadmin', 'admin_ste');
    Route::delete('/maintenance/{id}', [MaintenancesController::class, 'destroy']);//->middleware('superadmin', 'admin_ste');

    //equipes
    Route::get('/equipes', [EquipesController::class, 'index']);//->middleware('superadmin', 'admin_equipe');
    Route::post('/equipes', [EquipesController::class, 'store']);//->middleware('superadmin');
    Route::get('/equipe/{id}', [EquipesController::class, 'show']);//->middleware('superadmin', 'admin_equipe');
    Route::put('/equipe/{id}', [EquipesController::class, 'update']);//->middleware('superadmin');
    Route::delete('/equipe/{id}', [EquipesController::class, 'destroy']);//->middleware('superadmin');

    //Matchs
    Route::get('/matchs', [MatchsController::class, 'index']);//->middleware('superadmin', 'admin_equipe');
    Route::post('/matchs', [MatchsController::class, 'store']);//->middleware('superadmin');
    Route::get('/match/{id}', [MatchsController::class, 'show']);//->middleware('superadmin', 'admin_equipe');
    Route::put('/match/{id}', [MatchsController::class, 'update']);//->middleware('superadmin');
    Route::delete('/match/{id}', [MatchsController::class, 'destroy']);//->middleware('superadmin');
    Route::get('matchs/filter/{date}', [MatchsController::class, 'matchFilter']);//->middleware('superadmin', 'admin_equipe');

    //historiques
    Route::get('/historiques', [HistoriquesController::class, 'index']);//->middleware('superadmin', 'admin_equipe', 'admin_ste');
    Route::post('/historiques', [HistoriquesController::class, 'store']);
    Route::get('/historique/{id}', [HistoriquesController::class, 'show']);//->middleware('superadmin', 'admin_equipe', 'admin_ste');
    Route::get('/historiques/filter/{date}', [historiquesController::class, 'historiqueFilter']);//->middleware('superadmin', 'admin_equipe', 'admin_ste');


    //societe Maintenance
    Route::get('/societeMaintenances', [SocieteMaintenancesController::class, 'index']);//->middleware('superadmin', 'admin_ste');
    Route::post('/societeMaintenances', [SocieteMaintenancesController::class, 'store']);//->middleware('superadmin');
    Route::get('/societeMaintenance/{id}', [SocieteMaintenancesController::class, 'show']);//->middleware('superadmin', 'admin_ste');
    Route::put('/societeMaintenance/{id}', [SocieteMaintenancesController::class, 'update']);//->middleware('superadmin');
    Route::delete('/societeMaintenance/{id}', [SocieteMaintenancesController::class, 'destroy']);//->middleware('superadmin');

    //Stades
    Route::get('/stades', [stadesController::class, 'index']);//->middleware('superadmin', 'admin_equipe', 'admin_ste');
    Route::get('/stade/{id}', [stadesController::class, 'show']);//->middleware('superadmin');
    Route::post('/stades', [stadesController::class, 'store']);//->middleware('superadmin', 'admin_equipe', 'admin_ste');
    Route::put('/stade/{id}', [stadesController::class, 'update']);//->middleware('superadmin');
    Route::delete('/stade/{id}', [stadesController::class, 'destroy']);//->middleware('superadmin');

    //Route::middleware(['superadmin'])->group(function () {
        //Permissions
        Route::get('/permissions', [permissionsController::class, 'index']);
        Route::post('/permissions', [permissionsController::class, 'store']);
        Route::get('/permission/{id}', [permissionsController::class, 'show']);
        Route::put('/permission/{id}', [permissionsController::class, 'update']);
        Route::delete('/permission/{id}', [permissionsController::class, 'destroy']);

        //permission role pivots
        Route::get('/PermissionRolePivots', [permission_rolesController::class, 'index']);
        Route::post('/PermissionRolePivots', [permission_rolesController::class, 'store']);
        // Route::get('/PermissionRolePivot/{id}/{id}', [permission_rolesController::class, 'show']);
        // Route::put('/PermissionRolePivot/{id}/{id}', [permission_rolesController::class, 'update']);
        // Route::delete('/PermissionRolePivot/{id}/{id}', [permission_rolesController::class, 'destroy']);

        //Role User Pivots
        Route::get('/RoleUserPivots', [RoleUserPivotController::class, 'index']);
        Route::post('/RoleUserPivots', [RoleUserPivotController::class, 'store']);
        // Route::get('/RoleUserPivot/{id}/{id}', [RoleUserPivotController::class, 'show']);
        // Route::put('/RoleUserPivot/{id}/{id}', [RoleUserPivotController::class, 'update']);
        // Route::delete('/RoleUserPivot/{id}/{id}', [RoleUserPivotController::class, 'destroy']);

        //Role
        Route::get('/Roles', [RolesController::class, 'index']);
        Route::post('/Roles', [RolesController::class, 'store']);
        Route::get('/Role/{id}', [RolesController::class, 'show']);
        Route::put('/Role/{id}', [RolesController::class, 'update']);
        Route::delete('/Role/{id}', [RolesController::class, 'destroy']);
    //});

    //Competition
        Route::get('/Competitions', [CompetitionsController::class, 'index']);//->middleware('superadmin', 'admin_equipe');
    //Route::post('/Competitions', [CompetitionsController::class, 'store']);//->middleware('superadmin');
    Route::get('/Competition/{id}', [CompetitionsController::class, 'show']);//->middleware('superadmin', 'admin_equipe');
    Route::put('/Competition/{id}', [CompetitionsController::class, 'update']);//->middleware('superadmin');
    Route::delete('/Competition/{id}', [CompetitionsController::class, 'destroy']);//->middleware('superadmin');
    Route::get('/competitions/filter/{annee}', [CompetitionsController::class, 'competitionFilter']);//->middleware('superadmin', 'admin_equipe');

    //Reservation
    Route::get('/reservations', [ReservationsController::class, 'index']);//->middleware('superadmin', 'admin_equipe');
    Route::post('/reservations', [ReservationsController::class, 'store']);//->middleware('admin_equipe');
    Route::get('/reservation/{id}', [ReservationsController::class, 'show']);//->middleware('superadmin', 'admin_equipe');
    Route::put('/reservation/{id}', [ReservationsController::class, 'update']);//->middleware('admin_equipe');
    Route::delete('/reservation/{id}', [ReservationsController::class, 'destroy']);//->middleware('admin_equipe');
});
