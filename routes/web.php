<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\MamaProcess;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use IEXBase\TronAPI\Tron;
use IEXBase\TronAPI\Provider\HttpProvider;
use App\Http\Controllers\TronApiController;
use App\Http\Controllers\mamaTestController;

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
    try {
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

Route::any('/tron_api', function (Request $request) {
    $getData = $request->all();
    if (empty($getData)) {
        Log::info("HIHI");
        return;
    }

    $apiKey = "9650d585-56d2-4a70-b097-6f37084f3823";
    $address = "TKif5wUBNRVnjLzTCgHqtG4DfYUz6KzuTL";
    $actionkey = "";
    $url = "";
    $domainUrl = "https://api.trongrid.io";
    // $domainUrl = "https://apilist.tronscan.org/api";
    $getMethod = "get";
    $body = array();
    switch (isset($getData['action'])) {
        case "account":
            //$url = $domainUrl . "/v1/accounts/" . $address;
            $url = $domainUrl . "/account";
            $body = array("address" => $address);
            break;
        case "history":
            //$url = $domainUrl . "/v1/accounts/" . $address . "/transactions";
            break;
        case "getaccount":
            $getMethod = "post";
            $url = $domainUrl . "/wallet/getaccount";
            $body = array(
                'address' => 'TKif5wUBNRVnjLzTCgHqtG4DfYUz6KzuTL',
                'visible' => true
            );
            break;
        case "transaction":
            $getMethod = "post";
            $url = $domainUrl . "/wallet/createtransaction";
            $body = array(
                'owner_address' => 'TKif5wUBNRVnjLzTCgHqtG4DfYUz6KzuTL',
                'to_address' => 'TEkPVvRTgFkJiu1vewTi2C3fpPJbJ77777',
                'amount' => 1,
                'visible' => true
            );
            break;
        default:

            break;
    }

    $response = Http::withHeaders([
        'accept' => 'application/json',
        'content-type' => 'application/json'
    ])->$getMethod($url, $body);
    // print_r($response);
    Log::info($response->getBody());
    echo $response->getBody();
});


Route::get('/tron_test', function (Request $request) {

    $fullNode = new HttpProvider('https://api.trongrid.io');
    $solidityNode = new HttpProvider('https://api.trongrid.io');
    $eventServer = new HttpProvider('https://api.trongrid.io');
    try {
        $tron = new Tron($fullNode, $solidityNode, $eventServer);
    } catch (\IEXBase\TronAPI\Exception\TronException $e) {
        exit($e->getMessage());
    }
    $address = 'TKif5wUBNRVnjLzTCgHqtG4DfYUz6KzuTL';
    $privateKey = '4c39ed8fea1ac69e120ce8d91dd9736d166604126fb9107fced7a1948c4028e0';
    $tron->setAddress($address);
    $tron->setPrivateKey($privateKey);
    var_dump($tron->send('TEkPVvRTgFkJiu1vewTi2C3fpPJbJ77777', 1));
});

// Route::get('/tronapi/{action}', [TronApiController::class, 'index']);


Route::get('/tronTRX/{action}/{id?}', function ($action, $id = null) {
    $net = 'https://api.trongrid.io';
    $address = 'TKif5wUBNRVnjLzTCgHqtG4DfYUz6KzuTL';
    $privateKey = '4c39ed8fea1ac69e120ce8d91dd9736d166604126fb9107fced7a1948c4028e0';
    $api = new TronApiController($net);
    $api->setinit($address, $privateKey);
    $api->_tron->setAddress($address);
    $api->_tron->setPrivateKey($privateKey);
    if ($action == 'sendTRX') {
        $info = $api->_tron->sendTrx('TEkPVvRTgFkJiu1vewTi2C3fpPJbJ77777', 0.001);
    } else if ($action == 'getBalance') {
        $info = $api->_tron->getBalance($address, true);
    } else if ($action == 'getTransactionById') {
        if ($id == '') {
            return '請輸入id';
        }
        $info = $api->_tron->getTransaction($id);
    } else if ($action == 'getTransactions') {
        $info = $api->_tron->getTransactions($address);
    }
    Log::info($info);
})->where('id','[0-9]+');

Route::get('/tronTRC20/{action}', function ($action) {
    $net = 'https://api.trongrid.io';
    $address = 'TKif5wUBNRVnjLzTCgHqtG4DfYUz6KzuTL';
    $privateKey = '4c39ed8fea1ac69e120ce8d91dd9736d166604126fb9107fced7a1948c4028e0';
    $api = new TronApiController($net);
    $api->setinit($address, $privateKey);
    $api->_tron->setAddress($address);
    $api->_tron->setPrivateKey($privateKey);
    if ($action == 'transferUSDT') {
        $USDTConstract = 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t';
        $api->setContract($USDTConstract);
        $info = $api->_trc20->transfer('TEkPVvRTgFkJiu1vewTi2C3fpPJbJ77777', 0.1);
    } else if ($action == 'getTransactions') {
        $USDTConstract = 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t';
        $api->setContract($USDTConstract);
        $info = $api->_trc20->getTransactions($address);
    }
    Log::info($info);
});


Route::controller(mamaTestController::class)->group(function () {
    Route::get('/order/{id}', function($id){
       return redirect('get_test');
    });
    Route::post('/order123', 'store');
});