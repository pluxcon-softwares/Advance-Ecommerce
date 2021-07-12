<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Product;

class FrontController extends Controller
{
    public function index()
    {
        Session::put('page', 'Index');
        $countFeaturedProducts = Product::where(['status' => 1, 'is_featured' => 1])->count();

        $featuredProducts = Product::where(['status' => 1, 'is_featured' => 1])
        ->get()
        ->toArray();

        $latestProducts = Product::where(['status' => 1])->orderBy('id', 'DESC')->limit(6)->get();

        $featuredProducts = array_chunk($featuredProducts, 4);

        //echo "<pre>"; print_r(array_chunk($featuredProducts, 1)); die;
        return view('front.index', compact('countFeaturedProducts', 'featuredProducts', 'latestProducts'));
    }
}
