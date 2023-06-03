<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\MatchsController;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\historiquesController;
use App\Http\Controllers\API\CompetitionsController;
use App\Http\Controllers\API\MaintenancesController;
use App\Http\Controllers\API\EquipesController;
use App\Http\Controllers\API\societeMaintenancesController;
use App\Http\Controllers\API\StadesController;
use App\Http\Controllers\API\permissionsController;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\ReservationsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\StatsController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [userController::class, 'getUser']);
    Route::get('/stats', [StatsController::class, 'getCountStats']);

    //Event
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste', 'permission:Consulter Events']], function () {
        Route::get('/events', [EventsController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation','permission:Ajout Event']], function () {
        Route::post('/events', [EventsController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe', 'permission:Consulter Event']], function () {
        Route::get('/event/{id}', [EventsController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Modifier Event']], function () {
        Route::put('/event/{id}', [EventsController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Supprimer Event']], function () {
        Route::delete('/event/{id}', [EventsController::class, 'destroy']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/events/filter/{date_debut}/{stade_id}', [EventsController::class, 'eventFilter']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/events/filterStade/{stade_id}', [EventsController::class, 'eventFilterStade']);
    });


    //User
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Consulter Users']], function () {
        Route::get('/users', [userController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Ajout User']], function () {
        Route::post('/users', [userController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation','permission:Consulter User']], function () {
        Route::get('/user/{id}', [userController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Federation']], function () {
        Route::get('/usernom/{id}', [userController::class, 'shownom']);
    });
    Route::put('/user/{id}', [userController::class, 'update']);
    Route::put('/userUpdate', [userController::class, 'updateUser']);
    Route::get('/usershow', [userController::class, 'showuser']);
    Route::group(['middleware' => ['role:Admin Federation','permission:Supprimer User']], function () {
        Route::delete('/user/{id}', [userController::class, 'destroy']);
    });



    //Maintenances
    Route::group(['middleware' => ['role:Admin Federation|Admin Ste', 'permission:Consulter Maintenances']], function () {
        Route::get('/maintenances', [MaintenancesController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Ste', 'permission:Ajout Maintenance']], function () {
        Route::post('/maintenances', [MaintenancesController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Ste','permission:Consulter Maintenance']], function () {
        Route::get('/maintenance/{id}', [MaintenancesController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Ste','permission:Modifier Maintenance']], function () {
        Route::put('/maintenance/{id}', [MaintenancesController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Ste','permission:Supprimer Maintenance']], function () {
        Route::delete('/maintenance/{id}', [MaintenancesController::class, 'destroy']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Confirmer Maintenance']], function () {
        Route::get('/maintenance/accepter/{id}', [MaintenancesController::class, 'confirmerMaintenance']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Ste', 'permission:Annuler Maintenance']], function () {
        Route::get('/maintenance/refuser/{id}', [MaintenancesController::class, 'annulerMaintenance']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/maintenances/filter', [MaintenancesController::class, 'MaintenanceFilter']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/maintenances/filter/{date_debut}/{stade_id}', [MaintenancesController::class, 'MaintenanceFilterStade']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/maintenances/filterStade/{stade_id}', [MaintenancesController::class, 'MaintenanceFilterStades']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/maintenances/filteretat/{etat}', [MaintenancesController::class, 'MaintenanceFilterEtat']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/maintenances/filterstatut', [MaintenancesController::class, 'MaintenanceFilterstatut']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/MaintenancesFS', [MaintenancesController::class, 'Maintenancestatut']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/MaintenancesHistorique', [MaintenancesController::class, 'MaintenancesHistorique']);
    });



    //equipes
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe','permission:Consulter Equipes']], function () {
        Route::get('/equipes', [EquipesController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation','permission:Ajout Equipe']], function () {
        Route::post('/equipes', [EquipesController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe', 'permission:Consulter Equipe']], function () {
        Route::get('/equipe/{id}', [EquipesController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Modifier Equipe']], function () {
        Route::put('/equipe/{id}', [EquipesController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Federation','permission:Supprimer Equipe']], function () {
        Route::delete('/equipe/{id}', [EquipesController::class, 'destroy']);
    });

 
    //Matchs
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe', 'permission:Consulter Matchs']], function () {
        Route::get('/matchs', [MatchsController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Ajout Match']], function () {
        Route::post('/matchs', [MatchsController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe', 'permission:Consulter Match']], function () {
        Route::get('/match/{id}', [MatchsController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Modifier Match']], function () {
        Route::put('/match/{id}', [MatchsController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Supprimer Match']], function () {
        Route::delete('/match/{id}', [MatchsController::class, 'destroy']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/matchs/filter/{date}/{stade_id}', [MatchsController::class, 'matchFilter']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/matchs/filterStade/{stade_id}', [MatchsController::class, 'matchFilterStade']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/matchs/filterCompetition/{competition_id}', [MatchsController::class, 'matchFilterC']);
    });

    //historiques
    Route::group(['middleware' => ['role:Admin Federation','permission:Consulter Historiques']], function () {
        Route::get('/historiques', [HistoriquesController::class, 'index']);
    });
    /*
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste', 'permission:Consulter Equipes']], function () {
        Route::post('/historiques', [HistoriquesController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste', 'permission:Consulter Equipes']], function () {
        Route::get('/historique/{id}', [HistoriquesController::class, 'show']); //->middleware('superadmin', 'admin_equipe', 'admin_ste');
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste', 'permission:Consulter Equipes']], function () {
        Route::get('/historiques/filter/{date}', [historiquesController::class, 'historiqueFilter']); //->middleware('superadmin', 'admin_equipe', 'admin_ste');
    });*/


    //societe Maintenance
    Route::group(['middleware' => ['role:Admin Federation|Admin Ste', 'permission:Consulter Stes']], function () {
        Route::get('/societeMaintenances', [SocieteMaintenancesController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation',  'permission:Ajout Ste']], function () {
        Route::post('/societeMaintenances', [SocieteMaintenancesController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Ste', 'permission:Consulter Ste']], function () {
        Route::get('/societeMaintenance/{id}', [SocieteMaintenancesController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Federation','permission:Modifier Ste']], function () {
        Route::put('/societeMaintenance/{id}', [SocieteMaintenancesController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Supprimer Ste']], function () {
        Route::delete('/societeMaintenance/{id}', [SocieteMaintenancesController::class, 'destroy']);
    });



    //Stades
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste', 'permission:Consulter Stades']], function () {
        Route::get('/stades', [StadesController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste', 'permission:Consulter Stade']], function () {
        Route::get('/stade/nom/{id}', [StadesController::class, 'getnom']);
        Route::get('/stade/{id}', [StadesController::class, 'show']);
        Route::get('/stade/{id}/events', [StadesController::class, 'getEvents']);
        Route::get('/stade/{id}/matchs', [StadesController::class, 'getMatches']);
        Route::get('/stade/{id}/maintenances', [StadesController::class, 'getMaintenances']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Ajout Stade']], function () {
        Route::post('/stades', [StadesController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Modifier Stade']], function () {
        Route::put('/stade/{id}', [StadesController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Supprimer Stade']], function () {
        Route::delete('/stade/{id}', [StadesController::class, 'destroy']);
    });
    Route::group(['middleware' => ['role:Admin Federation']], function () {
        Route::get('/stadenom/{id}', [userController::class, 'shownom']);
    });


    //Permissions
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Consulter Permissions']], function () {
        Route::get('/permissions', [permissionsController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Ajout Permission']], function () {
        Route::post('/permissions', [permissionsController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Consulter Permission']], function () {
        Route::get('/permission/{id}', [permissionsController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Modifier Permission']], function () {
        Route::put('/permission/{id}', [permissionsController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Supprimer Permission']], function () {
        Route::delete('/permission/{id}', [permissionsController::class, 'destroy']);
    });




    //Role
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Consulter Roles']], function () {
        Route::get('/Roles', [RolesController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Ajout Role']], function () {
        Route::post('/Roles', [RolesController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Consulter Role']], function () {
        Route::get('/Role/{id}', [RolesController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Modifier Role']], function () {
        Route::put('/Role/{id}', [RolesController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Supprimer Role']], function () {
        Route::delete('/Role/{id}', [RolesController::class, 'destroy']);
    });
    //});


    //Competition
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe', 'permission:Consulter Competitions']], function () {
        Route::get('/Competitions', [CompetitionsController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Federation','permission:Ajout Competition']], function () {
        Route::post('/Competitions', [CompetitionsController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe', 'permission:Consulter Competition']], function () {
        Route::get('/Competition/{id}', [CompetitionsController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Federation','permission:Modifier Competition']], function () {
        Route::put('/Competition/{id}', [CompetitionsController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Federation','permission:Supprimer Competition']], function () {
        Route::delete('/Competition/{id}', [CompetitionsController::class, 'destroy']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe']], function () {
        Route::get('/competitions/filter/{annee}', [CompetitionsController::class, 'competitionFilter']);
    });

    //Reservation
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe', 'permission:Consulter Reservations']], function () {
        Route::get('/reservations', [ReservationsController::class, 'index']);
    });
    Route::group(['middleware' => ['role:Admin Equipe', 'permission:Ajout Reservation']], function () {
        Route::post('/reservations', [ReservationsController::class, 'store']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe', 'permission:Consulter Reservation']], function () {
        Route::get('/reservation/{id}', [ReservationsController::class, 'show']);
    });
    Route::group(['middleware' => ['role:Admin Equipe', 'permission:Modifier Reservation']], function () {
        Route::put('/reservation/{id}', [ReservationsController::class, 'update']);
    });
    Route::group(['middleware' => ['role:Admin Equipe', 'permission:Supprimer Reservation']], function () {
        Route::delete('/reservation/{id}', [ReservationsController::class, 'destroy']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Confirmer Reservation']], function () {
        Route::post('/reservations/accept/{id}', [ReservationsController::class, 'acceptReservation']);
    });
    Route::group(['middleware' => ['role:Admin Federation', 'permission:Annuler Reservation']], function () {
        Route::get('/reservation/refuser/{id}', [ReservationsController::class, 'annulerReservation']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe']], function () {
        Route::get('/ReservationFilterstatut', [ReservationsController::class, 'ReservationFilterstatut']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe']], function () {
        Route::get('/Reservationstatut', [ReservationsController::class, 'Reservationstatut']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe']], function () {
        Route::get('/reservations/filter', [ReservationsController::class, 'ReservationFilter']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe|Admin Ste']], function () {
        Route::get('/reservations/filter/{date}', [ReservationsController::class, 'ReservationFilterDate']);
    });
    Route::group(['middleware' => ['role:Admin Federation|Admin Equipe']], function () {
        Route::get('/reservations/filterType/{type_reservation}', [ReservationsController::class, 'ReservationFilterType']);
    });
});
