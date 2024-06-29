<?php

namespace App\Services\Midtrans;

use Midtrans\Config;

class Midtrans {
    protected $serverKey;
    protected $isProduction;
    protected $isSanitized;
    protected $is3ds;

    public function __construct()
    {
        $this->serverKey = config('services.midtrans.serverKey');
        $this->isProduction = config('services.midtrans.isProduction');
        $this->isSanitized = config('services.midtrans.isSanitized');
        $this->is3ds = config('services.midtrans.is3ds');

        $this->_configureMidtrans();
    }

    public function _configureMidtrans(){
        Config::$serverKey = $this->serverKey;
        Config::$isProduction = $this->isProduction;
        Config::$isSanitized = $this->isSanitized;
        Config::$is3ds = $this->is3ds;
    }
}
