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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Event
Route::get('/events', [\App\Http\Controllers\API\eventsController::class, 'index']);
Route::post('/events', [\App\Http\Controllers\API\eventsController::class, 'store']);
Route::get('/event/{id}', [\App\Http\Controllers\API\eventsController::class, 'show']);
Route::put('/event/{id}', [\App\Http\Controllers\API\eventsController::class, 'update']);
Route::delete('/event/{id}', [\App\Http\Controllers\API\eventsController::class, 'destroy']);

//User
Route::get('/users', [\App\Http\Controllers\API\userControler::class, 'index']);
Route::post('/users', [\App\Http\Controllers\API\userControler::class, 'store']);
Route::get('/user/{id}', [\App\Http\Controllers\API\userControler::class, 'show']);
Route::put('/user/{id}', [\App\Http\Controllers\API\userControler::class, 'update']);
Route::delete('/user/{id}', [\App\Http\Controllers\API\userControler::class, 'destroy']);

//Maintenances 
Route::get('/maintenances', [\App\Http\Controllers\API\MaintenancesController::class, 'index']);
Route::post('/maintenances', [\App\Http\Controllers\API\MaintenancesController::class, 'store']);
Route::get('/maintenance/{id}', [\App\Http\Controllers\API\MaintenancesController::class, 'show']);
Route::put('/maintenance/{id}', [\App\Http\Controllers\API\MaintenancesController::class, 'update']);
Route::delete('/maintenance/{id}', [\App\Http\Controllers\API\MaintenancesController::class, 'destroy']);

//equipes
Route::get('/equipes', [\App\Http\Controllers\API\equipesController::class, 'index']);
Route::post('/equipes', [\App\Http\Controllers\API\equipesController::class, 'store']);
Route::get('/equipe/{id}', [\App\Http\Controllers\API\equipesController::class, 'show']);
Route::put('/equipe/{id}', [\App\Http\Controllers\API\equipesController::class, 'update']);
Route::delete('/equipe/{id}', [\App\Http\Controllers\API\equipesController::class, 'destroy']);

//Matchs
Route::get('/matchs', [\App\Http\Controllers\API\matchsController::class, 'index']);
Route::post('/matchs', [\App\Http\Controllers\API\matchsController::class, 'store']);
Route::get('/match/{id}', [\App\Http\Controllers\API\matchsController::class, 'show']);
Route::put('/match/{id}', [\App\Http\Controllers\API\matchsController::class, 'update']);
Route::delete('/match/{id}', [\App\Http\Controllers\API\matchsController::class, 'destroy']);

//historiques
Route::get('/historiques', [\App\Http\Controllers\API\historiquesController::class, 'index']);
Route::post('/historiques', [\App\Http\Controllers\API\historiquesController::class, 'store']);
Route::get('/historique/{id}', [\App\Http\Controllers\API\historiquesController::class, 'show']);

//societe Maintenance
Route::get('/societeMaintenances', [\App\Http\Controllers\API\societeMaintenancesController::class, 'index']);
Route::post('/societeMaintenances', [\App\Http\Controllers\API\societeMaintenancesController::class, 'store']);
Route::get('/societeMaintenance/{id}', [\App\Http\Controllers\API\societeMaintenancesController::class, 'show']);
Route::put('/societeMaintenance/{id}', [\App\Http\Controllers\API\societeMaintenancesController::class, 'update']);
Route::delete('/societeMaintenance/{id}', [\App\Http\Controllers\API\societeMaintenancesController::class, 'destroy']);

//Stades
Route::get('/stades', [\App\Http\Controllers\API\stadesController::class, 'index']);
Route::post('/stades', [\App\Http\Controllers\API\stadesController::class, 'store']);
Route::get('/stade/{id}', [\App\Http\Controllers\API\stadesController::class, 'show']);
Route::put('/stade/{id}', [\App\Http\Controllers\API\stadesController::class, 'update']);
Route::delete('/stade/{id}', [\App\Http\Controllers\API\stadesController::class, 'destroy']);

//Permissions
Route::get('/permissions', [\App\Http\Controllers\API\permessionsController::class, 'index']);
Route::post('/permissions', [\App\Http\Controllers\API\permessionsController::class, 'store']);
Route::get('/permission/{id}', [\App\Http\Controllers\API\permessionsController::class, 'show']);
Route::put('/permission/{id}', [\App\Http\Controllers\API\permessionsController::class, 'update']);
Route::delete('/permission/{id}', [\App\Http\Controllers\API\permessionsController::class, 'destroy']);

//permission role pivots 
Route::get('/PermissionRolePivots', [\App\Http\Controllers\API\PermissionRolePivotController::class, 'index']);
Route::post('/PermissionRolePivots', [\App\Http\Controllers\API\PermissionRolePivotController::class, 'store']);
Route::get('/PermissionRolePivot/{id}', [\App\Http\Controllers\API\PermissionRolePivotController::class, 'show']);
Route::put('/PermissionRolePivot/{id}', [\App\Http\Controllers\API\PermissionRolePivotController::class, 'update']);
Route::delete('/PermissionRolePivot/{id}', [\App\Http\Controllers\API\PermissionRolePivotController::class, 'destroy']);

//Role User Pivots
Route::get('/RoleUserPivots', [\App\Http\Controllers\API\RoleUserPivotController::class, 'index']);
Route::post('/RoleUserPivots', [\App\Http\Controllers\API\RoleUserPivotController::class, 'store']);
Route::get('/RoleUserPivot/{id}', [\App\Http\Controllers\API\RoleUserPivotController::class, 'show']);
Route::put('/RoleUserPivot/{id}', [\App\Http\Controllers\API\RoleUserPivotController::class, 'update']);
Route::delete('/RoleUserPivot/{id}', [\App\Http\Controllers\API\RoleUserPivotController::class, 'destroy']);

//Role
Route::get('/Roles', [\App\Http\Controllers\API\RoleController::class, 'index']);
Route::post('/Roles', [\App\Http\Controllers\API\RoleController::class, 'store']);
Route::get('/Role/{id}', [\App\Http\Controllers\API\RoleController::class, 'show']);
Route::put('/Role/{id}', [\App\Http\Controllers\API\RoleController::class, 'update']);
Route::delete('/Role/{id}', [\App\Http\Controllers\API\RoleController::class, 'destroy']);

//Competition
Route::get('/Competitions', [\App\Http\Controllers\API\CompetitionsController::class, 'index']);
Route::post('/Competitions', [\App\Http\Controllers\API\CompetitionsController::class, 'store']);
Route::get('/Competition/{id}', [\App\Http\Controllers\API\CompetitionsController::class, 'show']);
Route::put('/Competition/{id}', [\App\Http\Controllers\API\CompetitionsController::class, 'update']);
Route::delete('/Competition/{id}', [\App\Http\Controllers\API\CompetitionsController::class, 'destroy']);

//Reservation
Route::get('/reservations', [\App\Http\Controllers\API\ReservationsController::class, 'index']);
Route::post('/reservations', [\App\Http\Controllers\API\ReservationsController::class, 'store']);
Route::get('/reservation/{id}', [\App\Http\Controllers\API\ReservationsController::class, 'show']);
Route::put('/reservation/{id}', [\App\Http\Controllers\API\ReservationsController::class, 'update']);
Route::delete('/reservation/{id}', [\App\Http\Controllers\API\ReservationsController::class, 'destroy']);
