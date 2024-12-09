<?php

use App\Http\Controllers\admin\auth\AuthController;
use App\Http\Controllers\admin\BureauAddressController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\dashboard\DashboardController;
use App\Http\Controllers\admin\DisputeLetterController;
use App\Http\Controllers\admin\DocumentController;
use App\Http\Controllers\admin\InstructionController;
use App\Http\Controllers\admin\ItemController;
use App\Http\Controllers\admin\ReportSourceController;
use Illuminate\Support\Facades\Route;

Route::get('admin/login', [AuthController::class, 'showLogin'])->name('admin.showlogin');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/clients', ClientController::class);
    Route::resource('/dispute-letters', DisputeLetterController::class);
    Route::resource('/report-sources', ReportSourceController::class);
    Route::resource('/bureau-address', BureauAddressController::class);
    Route::resource('/instructions', InstructionController::class);
    Route::get('/client-documents/{client_slug}', [DocumentController::class, 'index'])->name('client-documents.index');
    Route::post('/client-documents/{client_slug}', [DocumentController::class, 'store'])->name('client-documents.store');

    Route::get('/client-items/{client_id}', [ItemController::class, 'index'])->name('client-items.index');
    
    Route::get('log-out', [AuthController::class, 'adminLogout'])->name('admin.logout');
});
//these routes is common for both employee and admin
// Route::get('/check-patient-privious-bookings', [RegisterBookingController::class, 'checkPatientPriviousBooking'])->name('admin.checkPatientPriviousBooking');
// Route::get('/check-bookingtype-operation', [RegisterBookingController::class, 'checkIfBookingTypeOperation'])->name('admin.checkIfBookingTypeOperation');
// Route::get('/get-print/{slug}',[RegisterBookingController::class, 'getPrint'])->name("get-print");
// Route::get('/get-pescription-print/{slug}',[RegisterBookingController::class, 'getPescriptionPrint'])->name("get-pescription-print");

// Route::post('/save-pescription/{slug}', [RegisterBookingController::class, 'savePescription'])->name('admin.savePescription');

// Route::get('/expenditure-export', [ExpenditureController::class, 'export'])->name('expenditure.download');


