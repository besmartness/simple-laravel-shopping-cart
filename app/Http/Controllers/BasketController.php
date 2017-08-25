<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Product;
use Session;
use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function index()
    {

    }

    public function addToBasket(Request $request, $id)
    {

        $product = Product::find($id);
        $current_basket = Session::has('profile') ? Session::get('profile') : $current_basket = null;
        $basket = new Basket($current_basket);
        $basket->add($product, $product->id);
        $request->session()->put('profile', $basket);
        return redirect()->back();

    }

    public function getBasket()
    {

       return view('profile.basket');

    }
}
