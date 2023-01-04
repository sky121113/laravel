<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\MamaProcess;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    return view('welcome');
});

Route::get('/firstview', function () {
    return view('firstview', ['name' => 'mama']);
});


Route::get('/con_db', function () {
    return '123';
});

Route::get('/queue-test', function () {
    // MamaProcess::dispatch();
    try{
        MamaProcess::dispatch();
        echo "<br>";
    } catch (Exception $e) {
        print_r($e);
    }

    

    return "mama was queue";
});

Route::get('/middleware_test', function () {
    $abc = new EnsureTokenIsValid;
    $abc->redirectTo('1111111');
});


Route::get('/get_test', function (Request $request) {
    // $oooo = new $request->all();
    $oooo = $request->all();
    Log::info($request->all());
    return $request->all();
    // return request()->all();
    // Log::info($request->all());
});

