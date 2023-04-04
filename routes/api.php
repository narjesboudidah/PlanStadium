<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
//Route::get('/users', [\App\Http\Controllers\API\usersController::class, 'index']);
Route::get('/users', [\App\Http\Controllers\API\usersController::class, 'index']);
Route::middleware(['auth'])->group(function () {
    Route::middleware(['superadmin'])->group(function () {

        //Event
        Route::get('/events', [\App\Http\Controllers\API\eventsController::class, 'index'])->middleware('admin_equipe');
        Route::post('/events', [\App\Http\Controllers\API\eventsController::class, 'store']);
        Route::get('/event/{id}', [\App\Http\Controllers\API\eventsController::class, 'show'])->middleware('admin_equipe');
        Route::put('/event/{id}', [\App\Http\Controllers\API\eventsController::class, 'update']);
        Route::delete('/event/{id}', [\App\Http\Controllers\API\eventsController::class, 'destroy'])->middleware('admin_equipe');

        //User
       // Route::get('/users', [\App\Http\Controllers\API\usersController::class, 'index']);
        Route::post('/users', [\App\Http\Controllers\API\usersController::class, 'store']);
        Route::get('/user/{id}', [\App\Http\Controllers\API\usersController::class, 'show']);
        Route::put('/user/{id}', [\App\Http\Controllers\API\usersController::class, 'update']);
        Route::delete('/user/{id}', [\App\Http\Controllers\API\usersController::class, 'destroy']);

        Route::middleware(['admin_ste'])->group(function () {
            //Maintenances
            Route::get('/maintenances', [\App\Http\Controllers\API\MaintenancesController::class, 'index']);
            Route::post('/maintenances', [\App\Http\Controllers\API\MaintenancesController::class, 'store']);
            Route::get('/maintenance/{id}', [\App\Http\Controllers\API\MaintenancesController::class, 'show']);
            Route::put('/maintenance/{id}', [\App\Http\Controllers\API\MaintenancesController::class, 'update']);
            Route::delete('/maintenance/{id}', [\App\Http\Controllers\API\MaintenancesController::class, 'destroy']);
        });

        //equipes
        Route::get('/equipes', [\App\Http\Controllers\API\equipesController::class, 'index'])->middleware('admin_equipe');
        Route::post('/equipes', [\App\Http\Controllers\API\equipesController::class, 'store']);
        Route::get('/equipe/{id}', [\App\Http\Controllers\API\equipesController::class, 'show'])->middleware('admin_equipe');
        Route::put('/equipe/{id}', [\App\Http\Controllers\API\equipesController::class, 'update']);
        Route::delete('/equipe/{id}', [\App\Http\Controllers\API\equipesController::class, 'destroy']);

        //Matchs
        Route::get('/matchs', [\App\Http\Controllers\API\matchsController::class, 'index'])->middleware('admin_equipe');
        Route::post('/matchs', [\App\Http\Controllers\API\matchsController::class, 'store']);
        Route::get('/match/{id}', [\App\Http\Controllers\API\matchsController::class, 'show'])->middleware('admin_equipe');
        Route::put('/match/{id}', [\App\Http\Controllers\API\matchsController::class, 'update']);
        Route::delete('/match/{id}', [\App\Http\Controllers\API\matchsController::class, 'destroy']);

        Route::middleware(['admin_equipe', 'admin_ste'])->group(function () {
            //historiques
            Route::get('/historiques', [\App\Http\Controllers\API\historiquesController::class, 'index']);
            //Route::post('/historiques', [\App\Http\Controllers\API\historiquesController::class, 'store']);
            Route::get('/historique/{id}', [\App\Http\Controllers\API\historiquesController::class, 'show']);
        });

        //societe Maintenance
        Route::get('/societeMaintenances', [\App\Http\Controllers\API\societeMaintenancesController::class, 'index'])->middleware('admin_ste');
        Route::post('/societeMaintenances', [\App\Http\Controllers\API\societeMaintenancesController::class, 'store']);
        Route::get('/societeMaintenance/{id}', [\App\Http\Controllers\API\societeMaintenancesController::class, 'show'])->middleware('admin_ste');
        Route::put('/societeMaintenance/{id}', [\App\Http\Controllers\API\societeMaintenancesController::class, 'update']);
        Route::delete('/societeMaintenance/{id}', [\App\Http\Controllers\API\societeMaintenancesController::class, 'destroy']);

        //Stades
        Route::middleware(['admin_equipe', 'admin_ste'])->group(function () {
            Route::get('/stades', [\App\Http\Controllers\API\stadesController::class, 'index']);
            Route::get('/stade/{id}', [\App\Http\Controllers\API\stadesController::class, 'show']);
        });
        Route::post('/stades', [\App\Http\Controllers\API\stadesController::class, 'store']);
        Route::put('/stade/{id}', [\App\Http\Controllers\API\stadesController::class, 'update']);
        Route::delete('/stade/{id}', [\App\Http\Controllers\API\stadesController::class, 'destroy']);


        //Permissions
        Route::get('/permissions', [\App\Http\Controllers\API\permissionsController::class, 'index']);
        Route::post('/permissions', [\App\Http\Controllers\API\permissionsController::class, 'store']);
        Route::get('/permission/{id}', [\App\Http\Controllers\API\permissionsController::class, 'show']);
        Route::put('/permission/{id}', [\App\Http\Controllers\API\permissionsController::class, 'update']);
        Route::delete('/permission/{id}', [\App\Http\Controllers\API\permissionsController::class, 'destroy']);

        //permission role pivots 
        Route::get('/PermissionRolePivots', [\App\Http\Controllers\API\permission_rolesController::class, 'index']);
        Route::post('/PermissionRolePivots', [\App\Http\Controllers\API\permission_rolesController::class, 'store']);
        Route::get('/PermissionRolePivot/{id}', [\App\Http\Controllers\API\permission_rolesController::class, 'show']);
        Route::put('/PermissionRolePivot/{id}', [\App\Http\Controllers\API\permission_rolesController::class, 'update']);
        Route::delete('/PermissionRolePivot/{id}', [\App\Http\Controllers\API\permission_rolesController::class, 'destroy']);

        //Role User Pivots
        Route::get('/RoleUserPivots', [\App\Http\Controllers\API\RoleUserPivotController::class, 'index']);
        Route::post('/RoleUserPivots', [\App\Http\Controllers\API\RoleUserPivotController::class, 'store']);
        Route::get('/RoleUserPivot/{id}', [\App\Http\Controllers\API\RoleUserPivotController::class, 'show']);
        Route::put('/RoleUserPivot/{id}', [\App\Http\Controllers\API\RoleUserPivotController::class, 'update']);
        Route::delete('/RoleUserPivot/{id}', [\App\Http\Controllers\API\RoleUserPivotController::class, 'destroy']);

        //Role
        Route::get('/Roles', [\App\Http\Controllers\API\rolesController::class, 'index']);
        Route::post('/Roles', [\App\Http\Controllers\API\rolesController::class, 'store']);
        Route::get('/Role/{id}', [\App\Http\Controllers\API\rolesController::class, 'show']);
        Route::put('/Role/{id}', [\App\Http\Controllers\API\rolesController::class, 'update']);
        Route::delete('/Role/{id}', [\App\Http\Controllers\API\rolesController::class, 'destroy']);

        //Competition
        Route::get('/Competitions', [\App\Http\Controllers\API\CompetitionsController::class, 'index'])->middleware('admin_equipe');
        Route::post('/Competitions', [\App\Http\Controllers\API\CompetitionsController::class, 'store']);
        Route::get('/Competition/{id}', [\App\Http\Controllers\API\CompetitionsController::class, 'show'])->middleware('admin_equipe');
        Route::put('/Competition/{id}', [\App\Http\Controllers\API\CompetitionsController::class, 'update']);
        Route::delete('/Competition/{id}', [\App\Http\Controllers\API\CompetitionsController::class, 'destroy']);
    });
    Route::middleware(['admin_equipe'])->group(function () {
        //Reservation
        Route::get('/reservations', [\App\Http\Controllers\API\ReservationsController::class, 'index'])->middleware('superadmin');
        Route::post('/reservations', [\App\Http\Controllers\API\ReservationsController::class, 'store']);
        Route::get('/reservation/{id}', [\App\Http\Controllers\API\ReservationsController::class, 'show'])->middleware('superadmin');
        Route::put('/reservation/{id}', [\App\Http\Controllers\API\ReservationsController::class, 'update']);
        Route::delete('/reservation/{id}', [\App\Http\Controllers\API\ReservationsController::class, 'destroy']);
    });
});