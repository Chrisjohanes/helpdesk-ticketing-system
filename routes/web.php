<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TicketController::class,'dashboard'])
->middleware(['auth'])
->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/tickets', [TicketController::class,'index'])->name('tickets.index');

    Route::get('/tickets/create', [TicketController::class,'create'])->name('tickets.create');

    Route::post('/tickets', [TicketController::class,'store'])->name('tickets.store');

    Route::get('/tickets/{id}', [TicketController::class,'show'])->name('tickets.show');

   Route::put('/tickets/{id}/update-status', [TicketController::class, 'update'])
->name('tickets.updateStatus');

});

require __DIR__.'/auth.php';