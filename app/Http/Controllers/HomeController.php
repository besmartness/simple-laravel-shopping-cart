<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        return view('home');
    }


    public function addToBasket(Request $request,$id)
    {

        if($request->session()->has('profile')){

            $basket = $request->session()->get('profile');
            $basket = array_push($basket, $id);
            $request->session()->put('profile',$basket);
            dd($request->session()->get('profile'));

        }else{

            $basket = array();
            $basket = array_push($basket, $id);
            $request->session()->put('profile',$basket);
            dd($request->session()->get('profile'));

        }
        return redirect()-back();
    }

    public function profile()
    {

        return view('profile.profile');

    }
}
