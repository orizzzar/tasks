<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\URL;

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
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('tasks/read', [TaskController::class, 'read']);
    Route::post('tasks/save', [TaskController::class, 'save']);
    Route::post('tasks/create', [TaskController::class, 'create']);
    Route::post('tasks/delete', [TaskController::class, 'delete']);
});

require __DIR__.'/auth.php';

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
