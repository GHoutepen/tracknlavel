<?php

use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
// Api meat n potatoes - index and the works.
Route::get('/track', [LabelController::class, 'index'])->name('track.index');

Route::get('/track/shipmentOverview', [LabelController::class, 'overviewShipment'])->name('track.shipment.overview');
Route::get('/track/shipmentView/{id}/{companyID}', [LabelController::class, 'viewShipment'])->name('track.shipment.view');

//API calls.
Route::post('/track/api/getCompanies', [LabelController::class, 'getCompanies'])->name('track.getCompanies');
Route::post('/track/api/getCompany', [LabelController::class, 'getCompany'])->name('track.getCompany');

Route::post('/track/api/shipment/index', [LabelController::class, 'getOverviewShipments'])->name('track.getCompany.overview');
Route::post('/track/api/shipment/get', [LabelController::class, 'getShipment'])->name('track.getCompany');
Route::post('/track/api/createShipment', [LabelController::class, 'createShipment'])->name('track.createShipment');



//Generations for PDFs
Route::post('/track/downloadPDF', [LabelController::class, 'getPDF'])->name('track.getPDF');

Route::get('/track/test', [LabelController::class, 'test'])->name('track.test');
