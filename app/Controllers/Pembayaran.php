<?php

namespace App\Controllers;
use Config\Midtrans as MidtransConfig;
use Midtrans\Snap;
use Midtrans\Config;

use App\Controllers\BaseController;

class Pembayaran extends BaseController
{
    public function __construct()
    {
        $midtrans = new MidtransConfig();
        Config::$serverKey = $midtrans->serverKey;
        Config::$isProduction = $midtrans->isProduction;
        Config::$isSanitized = $midtrans->isSanitized;
        Config::$is3ds = $midtrans->is3ds;
    }

    public function index()
    {
        return view('List_pembayaran');
    }

    public function token()
    {
        $transaction_details = [
            'order_id' => rand(),
            'gross_amount' => 200000, // total pembayaran
        ];

        $item_details = [
            [
                'id' => 'a1',
                'price' => 200000,
                'quantity' => 1,
                'name' => "SPP"
            ],
        ];

        $customer_details = [
            'first_name' => "Andi",
            'last_name' => "Setiawan",
            'email' => "andi@gmail.com",
            'phone' => "08123456789",
        ];

        $transaction = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details
        ];

        $snapToken = Snap::getSnapToken($transaction);
        echo $snapToken;
    }
}
