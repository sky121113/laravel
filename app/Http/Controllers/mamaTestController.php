<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class mamaTestController extends Controller
{
    //
    public function show(){
        Log::info('abc');
    }
    public function store(){
        Log::info('123');
    }
}
