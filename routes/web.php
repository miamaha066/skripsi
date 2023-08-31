<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SVMController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/main', function () {
    return view('welcome');
});

// Route::get('/riwayat_monitoring', function () {
//     return view('riwayat_monitoring');
// });
Route::get('/dataUser',[UserController::class,'DataUser']);

Route::get('/home',[HomeController::class,'Home']);

Route::get('/riwayat_monitoring',[SensorController::class,'Riwayat']);
Route::get('/dataSensor',[SensorController::class,'Sensor']);
Auth::routes();
Route::get('cekSuhu', [SensorController::class, 'CekSuhu'])->name('cekSuhu');
Route::get('cekKelembaban', [SensorController::class, 'CekKelembaban'])->name('cekKelembaban');

Route::post('confirm_login',[LoginController::class,'ConfirmLogin']);
Route::get('logout',[LoginController::class, 'logout']);

Route::get('metode_svm',[SVMController::class, 'metodeSvm'])->name('metode_svm');