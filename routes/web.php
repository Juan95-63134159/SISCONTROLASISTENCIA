<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;
use Illuminate\Support\Facades\Auth;


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

// PROTEGIENDO LA RUTA DE ACCESO
// Route::get('/', function () { return view('index');})->middleware('auth');

//NUEVA RUTA PARA VER EL INDEX
Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('index');
// REPORTES
Route::get('/asistencias/reportes', [AsistenciaController::class, 'reportes'])->name('reportes');
// PARA CERRAR SESION
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
// PDF
Route::get('/asistencias/pdf', [AsistenciaController::class, 'pdf'])->name('pdf');
Route::get('/asistencias/pdf_fechas', [AsistenciaController::class, 'pdf_fechas'])->name('pdf_fechas');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// PARA DESHABILITAR LA VISTA Register poner false
Auth::routes(['register'=>true]);



// PARA HABILITAR TODAS LAS RUTAS PARA MODULO MIEMBROS
Route::resource('/miembros',\App\Http\Controllers\MiembroController::class)->middleware('can:miembros');
// PARA HABILITAR TODAS LAS RUTAS PARA MODULO MINISTERIOS
Route::resource('/ministerios',\App\Http\Controllers\MinisterioController::class)->middleware('can:ministerios');
// PARA HABILITAR TODAS LAS RUTAS PARA MODULO USUARIOS
Route::resource('/usuarios',\App\Http\Controllers\UserController::class)->middleware('can:usuarios');
// PARA HABILITAR TODAS LAS RUTAS PARA MODULO ASISTENCIAS
Route::resource('/asistencias',\App\Http\Controllers\AsistenciaController::class);
