<?php

namespace App\Http\Controllers;

use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;


class BasketController extends Controller
{

    public function addToBasket(Request $request, $id)
    {

        if(\Session::has('basket')){

            $basket = \Session::get('basket');
            $basket[] =  Product::find($id);
            \Session::put('basket', $basket);

        }else{

            $basket = array();
            $basket[] =  Product::find($id);
            \Session::put('basket', $basket);

        }

        return redirect()->back();

    }

    public function pay(Request $request)
    {
        if(isset($request) && isset($request->stripeToken))
        {
            Stripe::setApiKey('your secret key goes here');
            $charge = Charge::create(array('source' => $request->stripeToken, 'amount' => $request->total, 'currency' => 'usd'));
            echo 'You successfully paid!';
        }
    }
}
