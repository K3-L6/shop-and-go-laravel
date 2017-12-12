<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//models
use App\Product;
use App\Showcase;
use App\Showcasitem;
use App\Province;
use App\Sale;

use DB;
//packges

class WelcomeController extends Controller
{
    public function index()
    {
    	$provinces = Province::all();

    	$showcases = Showcase::all();
    	$newheadphones = Product::with('productimage')->where('category_id', 1)->orderBy('created_at', 'desc')->take(8)->get();
    	$newspeakers = Product::with('productimage')->where('category_id', 2)->orderBy('created_at', 'desc')->take(8)->get();
    	$newdap = Product::with('productimage')->where('category_id', 3)->orderBy('created_at', 'desc')->take(8)->get();
    	$newaccessories = Product::with('productimage')->where('category_id', 4)->orderBy('created_at', 'desc')->take(8)->get();

        $topseller = DB::table('v_top_ten')->take(3)->get();

        $products = Product::with('productimage')->get();

    	return view('welcome')->withShowcases($showcases)->withNewheadphones($newheadphones)->withNewspeakers($newspeakers)->withNewdap($newdap)->withNewaccessories($newaccessories)->withProvinces($provinces)->withTopseller($topseller)->withProducts($products);
    }

    public function location()
    {
        return view('location');
    }

    public function aboutus()
    {
        return view('aboutus');
    }
}
