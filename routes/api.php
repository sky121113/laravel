<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstCon;

use App\Models\FirstConhi;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getdata', function () {
    foreach (FirstConhi::all() as $flight) {
        print_r($flight->getAttributes());
        // echo $flight->user_name;
    }
    $firstConhi = new FirstConhi;
    $flight123 = $firstConhi->where('user_name','mama_2')->get();
    // $flight123 = FirstConhi::where('user_name','mama_2')->get();
    var_dump($flight123);
    foreach ($flight123 as $flight) {
        echo $flight->user_name;
    }
    // print_r($flight123);
    // print_r($flight123->user_name);
    
});

Route::get('/insertdata',function(){
    try{
        $firstcon = new FirstConhi;

        $firstcon->user_acc = 'sky337';
        $firstcon->user_name = 'mama_5';
        $firstcon->user_gender = 'woman';
        $firstcon->user_born = '1999-11-01';
    
        $firstcon->save();
        echo "新增成功";
    } catch (Exception $e) {
        echo "新增錯誤";
        print_r($e->getMessage());
    }      
    
});

Route::get('/update',function(){
    $firstcon = new FirstConhi;
    $status = $firstcon->where('id', 10)->update(['user_acc'=>'sky999','user_name'=>'mama999']);
    //$status = FirstConhi::where('id', 1)->update(['user_acc'=>'sky999','user_name'=>'mama999']);
    if($status){
        echo "更新成功";
    } else {
        echo "無更新資料";
    }
});

Route::get('/deldata',function(){

    $deleted = FirstConhi::where('id', 2)->delete();
    if($deleted){
        echo "刪除成功";
    } else {
        echo "無刪除資料";
    }
});

Route::get('/searchdel',function(){

    $deleted = FirstConhi::where('id', 2)->restore();
    // echo $deleted;
    // if($deleted){
    //     echo "有刪除資料";
    // } else {
    //     echo "無刪除資料";
    // }
});

Route::get('/redelete',function(){

    $deleted = FirstConhi::where('id', 2)->restore();
    // echo $deleted;
    // if($deleted){
    //     echo "有刪除資料";
    // } else {
    //     echo "無刪除資料";
    // }
});

Route::get('/first', [FirstCon::class, 'index']);
