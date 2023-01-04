<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FirstCon extends Controller
{
    /**
     * 顯示應用程式中所有使用者的列表。
     *
     * @return Response
     */
    public function index()
    {
        $users = DB::select('select * from mama_hello where user_name = ?', ['mama']);

        return $users;
    }
}