<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Swap\Laravel\Facades\Swap;
use Carbon\Carbon;

class CurrencyController extends Controller
{
    //
    public function show()
    {
            // Get the latest EUR/USD rate
        $rate = Swap::latest('CAD/USD');

        // 1.129
        $value = $rate->getValue();

        // 2016-08-26
        $time = $rate->getDate()->format('Y-m-d');

        // Get the EUR/USD rate yesterday
       $rate = Swap::historical('CAD/USD', Carbon::yesterday());

        print_r($rate);
        exit;

        echo json_encode([
            'value' => $value,
            'time' => $time,
            //'history' =>$rate->get
        ]);
    }
}
