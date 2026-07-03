<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MaintenanceLogController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin,technician')->group(function () {
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('spare-parts', SparePartController::class)->except('show');

        Route::patch('/tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
        Route::patch('/tickets/{ticket}/resolve', [TicketController::class, 'resolve'])->name('tickets.resolve');
        Route::patch('/tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
            Route::get('/devices', [ReportController::class, 'devices'])->name('devices');
            Route::get('/maintenance', [ReportController::class, 'maintenance'])->name('maintenance');
            Route::get('/tickets', [ReportController::class, 'tickets'])->name('tickets');
            Route::get('/export/devices', [ReportController::class, 'exportDevices'])->name('export.devices');
            Route::get('/export/maintenance', [ReportController::class, 'exportMaintenance'])->name('export.maintenance');
            Route::get('/export/tickets', [ReportController::class, 'exportTickets'])->name('export.tickets');
        });
    });

    Route::resource('devices', DeviceController::class);
    Route::get('/devices/{device}/qr', [DeviceController::class, 'qrCode'])->name('devices.qr');
    Route::resource('tickets', TicketController::class);
    Route::resource('maintenance-logs', MaintenanceLogController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
