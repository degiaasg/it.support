<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MaintenanceLogController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin only
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);

        Route::prefix('documents')->name('documents.')->group(function () {
            Route::get('/{type}', [DocumentController::class, 'index'])->name('index');
        });

        Route::prefix('forms')->name('forms.')->middleware('role:admin,technician')->group(function () {
            Route::get('/pemeriksaan', [FormController::class, 'pemeriksaan'])->name('pemeriksaan');
            Route::get('/pemeriksaan/create', [FormController::class, 'pemeriksaanCreate'])->name('pemeriksaan.create');
            Route::get('/pemeriksaan/create/{kategori}', [FormController::class, 'pemeriksaanCreateForm'])->name('pemeriksaan.create-form');
            Route::post('/pemeriksaan/store', [FormController::class, 'pemeriksaanStore'])->name('pemeriksaan.store');
            Route::get('/pemeriksaan/{id}', [FormController::class, 'pemeriksaanShow'])->name('pemeriksaan.show');
            Route::get('/pemeriksaan/{id}/edit', [FormController::class, 'pemeriksaanEdit'])->name('pemeriksaan.edit');
            Route::put('/pemeriksaan/{id}', [FormController::class, 'pemeriksaanUpdate'])->name('pemeriksaan.update');
            Route::delete('/pemeriksaan/{id}', [FormController::class, 'pemeriksaanDestroy'])->name('pemeriksaan.destroy');
            Route::get('/perawatan', [FormController::class, 'perawatan'])->name('perawatan');
            Route::get('/peminjaman', [FormController::class, 'peminjaman'])->name('peminjaman');
            Route::get('/perpindahan', [FormController::class, 'perpindahan'])->name('perpindahan');
            Route::get('/pengembalian', [FormController::class, 'pengembalian'])->name('pengembalian');
        });
    });

    // Admin & Technician
    Route::middleware('role:admin,technician')->group(function () {
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('spare-parts', SparePartController::class)->except('show');
        Route::resource('maintenance-logs', MaintenanceLogController::class);

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

    // Devices — admin/tech can CRUD, user can only view
    // Explicit routes must come BEFORE the wildcard {device} route to avoid 404 on /devices/create
    Route::middleware('role:admin,technician')->group(function () {
        Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create');
        Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store');
        Route::get('/devices/{device}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
        Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update');
        Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy');
    });
    Route::resource('devices', DeviceController::class)->only('index', 'show');
    Route::get('/devices/{device}/qr', [DeviceController::class, 'qrCode'])->name('devices.qr');

    // Tickets — all roles can create and view, admin/tech can edit/manage
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::middleware('role:admin,technician')->group(function () {
        Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
        Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
        Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
