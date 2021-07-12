<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class FrontProductController extends Controller
{
    public function listing($url)
    {
        $countCategories = Category::where(['status' => 1,'url' => $url])->count();
        if($countCategories > 0)
        {
            $categoryDetails = Category::categoryDetails($url);
            $products = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])
                                ->where('status', 1);//->paginate(3);
            //echo "<pre>"; print_r($categoryDetails); die;
            if(isset($_GET['sort']) && !empty($_GET['sort']))
            {
                if($_GET['sort'] == 'latest_products')
                {
                    $products->orderBy('id', 'DESC');
                }
            }

            if(isset($_GET['sort']) && !empty($_GET['sort']))
            {
                if($_GET['sort'] == 'product_name_a_z')
                {
                    $products->orderBy('product_name', 'ASC');
                }
            }

            if(isset($_GET['sort']) && !empty($_GET['sort']))
            {
                if($_GET['sort'] == 'product_name_z_a')
                {
                    $products->orderBy('product_name', 'DESC');
                }
            }

            if(isset($_GET['sort']) && !empty($_GET['sort']))
            {
                if($_GET['sort'] == 'lowest_price_first')
                {
                    $products->orderBy('product_price', 'ASC');
                }
            }

            if(isset($_GET['sort']) && !empty($_GET['sort']))
            {
                if($_GET['sort'] == 'highest_price_first')
                {
                    $products->orderBy('product_price', 'DESC');
                }
            }

            $products = $products->paginate(3);

            return view('front.product.listing', compact('countCategories', 'categoryDetails', 'products'));
        }else{
            abort(404);
        }
    }
}
