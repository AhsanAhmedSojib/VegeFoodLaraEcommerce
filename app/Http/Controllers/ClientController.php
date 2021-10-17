<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Catagory;
use Session;
class ClientController extends Controller
{

    public function home() {
        $products=Product::get();
        $sliders=Slider::get();
        return view('client.home')->with('sliders', $sliders)->with('products', $products);
    }
    
    public function shop() {
        $products=Product::get();
        $catagories=Catagory::get();
        return view('client.shop')->with('products', $products)->with('catagories',$catagories);
    }

    public function cart() {
        return view('client.cart');
    }

    public function checkout() {
        return view('client.checkout');
    }

    public function login() {
        return view('client.login');
    }

    public function signup() {
        return view('client.signup');
    }

}
