<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\BaseController;
class SenangpayController extends BaseController
{
    protected $merchantid = '183171565848172';
    protected $secretkey = '183171565848172';
    public function checkout()
    {
        return View::make('test.checkout');
    }

    public function toSenangpay()
    {   $data = [
            'detail' => '',
            'amount' => '',
            'order_id' => '',
            'name' => '',
            'email' => '',
            'phone' => '',
            'hash' => '',
        ];
        return View::make('test.checkout');
    }
}