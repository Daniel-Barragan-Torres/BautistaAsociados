<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarioController;
use App\Models\Cita;



/*
Route::get('/api/citas', [CalendarioController::class, 'getCitas']);

//Acceso al calendario
Route::view('/calendario', 'calendario')->name('calendario');
*/

/* Calendario parte 2 */ 

/* */



/* Fin Calendario parte 2 */

/* calendario part 3 */
Route::get('/eventos', [CalendarioController::class, 'eventos']);

Route::get('/eventosdet', [CalendarioController::class, 'eventosdet']);

Route::middleware(['auth'])->get('/eventos', [CalendarioController::class, 'eventos'])->name('eventos');


Route::get('/', function () {
    return view('welcome');
});
