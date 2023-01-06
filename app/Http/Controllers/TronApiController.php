<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use IEXBase\TronAPI\Tron;
use IEXBase\TronAPI\Provider\HttpProvider;
use PhpParser\Node\Expr\Cast\String_;

class TronApiController extends Controller
{
    public $_tron;
    public $_trc20;

    public function __construct($net){
        $fullNode = new HttpProvider($net);
        $solidityNode = new HttpProvider($net);
        $eventServer = new HttpProvider($net);
        try {
            $this->_tron = new Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            exit($e->getMessage());
        }
    }

    public function setInit(String $address,String $privateKey)
    {
        $this->_tron->setAddress($address);
        $this->_tron->setPrivateKey($privateKey);
    }

    public function setContract($contract)
    {
        $this->_trc20 = $this->_tron->contract($contract);
    }
}
