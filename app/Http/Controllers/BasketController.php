<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
