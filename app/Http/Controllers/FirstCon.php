<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class FirstCon extends Controller
{


    /**
     * 配置新的 Web 服务器。
     *
     * @return \Illuminate\Http\Response
     */

    public function __invoke(Request $request,$id)
    {
        Log::info('get');
        Log::info($request->all());
        Log::info($request->ip());
    }

    /**
     * 顯示應用程式中所有使用者的列表。
     *
     * @return Response
     */
    public function index(Request $request,$id)
    {
        Log::info('get');
        Log::info($request->all());
        Log::info($request->ip());
    }
    public function store(Request $request){
        Log::info('post');
        Log::info($request->all());
    }
}