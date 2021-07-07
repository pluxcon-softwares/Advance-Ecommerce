<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductAttribute;

class ProductController extends Controller
{
    public function products()
    {
        Session::put('page', 'Catalogues');

        $products = Product::with(['section'=>function($query){
            $query->select('id', 'name');
        }, 'category'=>function($query){
            $query->select('id', 'category_name');
        }])->get();

        return view('admin.product.products', compact('products'));
    }

    public function viewProduct(Request $request)
    {
        $product_id = (INT) $request->product_id;
        $product = Product::with(['category'=>function($query){
            $query->with('section');
        }])->where('id', $product_id)->first();
        //echo "<pre>"; $product; die;
        //return $product;
        return view('admin.product._view-product-data', compact('product'));
    }

    public function changeProductStatus(Request $request)
    {
        if($request['product_status'] == 1)
        {
            $status = 0;
        }else{
            $status = 1;
        }
        Product::find($request['product_id'])->update(['status' => $status]);

        return response()->json(['status' => $status]);
    }

    public function addProduct(Request $request)
    {
        Session::put('page', 'Catalogues');

        //Proecess submit form data
        if($request->isMethod('post'))
        {
            //echo "<pre>"; print_r($request->all()); die;
            $rules = [
                'product_name' => 'required',
                'product_code' =>  'required|regex:/^[\w-]*$/', //AlphaNumeric regex:/^[\w-]*$/'
                'category_id'      =>  'required|numeric',
                'brand_id'      =>  'required|numeric',
                'product_price'    =>  'required|numeric',
                'product_discount' => 'numeric',
                'product_weight'    =>  'numeric',
                'product_main_image' => 'mimes:jpg,jpeg,png,gif|max:2048',
                'product_video'      =>   'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040'
            ];
            $messages = [
                'product_name.required' => 'Enter product name',
                'product_code.required' => 'Enter product code',
                'category_id.required' => 'Select product category',
                'brand_id.required' => 'Select product brand',
                'product_price.required' => 'Enter product price',
                'product_price.numeric' => 'Enter price in numeric eg: (0 or 0.00)',
                'product_discount.numeric' => 'Enter discount in numeric eg: (0 or 0.00)',
                'product.weight.numeric' => 'Enter weight in numeric',
            ];
            $request->validate($rules, $messages);

            //$filename = '';
            //Upload image file
            if($request->hasFile('product_main_image'))
            {
                $filename = time() . '.' . $request->file('product_main_image')->getClientOriginalExtension();
                $largeFilePath = storage_path('app/public/product_images/large/'.$filename);
                $mediumFilePath = storage_path('app/public/product_images/medium/'.$filename);
                $smallFilePath = storage_path('app/public/product_images/small/'.$filename);

                //save large image
                Image::make($request->file('product_main_image'))->resize(800, 800)
                ->save($largeFilePath);

                //Save medium image
                Image::make($request->file('product_main_image'))->resize(640, 640)
                ->save($mediumFilePath);

                //Save small image
                Image::make($request->file('product_main_image'))->resize(200, 200)
                ->save($smallFilePath);
            }

            //upload video file
            if($request->hasFile('product_video'))
            {
                $videofilename = time() . '.'. $request->file('product_video')->getClientOriginalExtension();
                $storagePath = storage_path('app/public/product_videos');
                $request->file('product_video')->move($storagePath, $videofilename);
            }

            $section = Category::find($request['category_id']);
            $product = new Product;
            $product->product_name = $request['product_name'];
            $product->product_code = $request['product_code'];
            $product->category_id = $request['category_id'];
            $product->section_id = $section->section_id;
            $product->brand_id = $request->brand_id;
            $product->product_price = $request['product_price'];
            $product->product_weight = $request['product_weight'];
            $product->product_discount = $request['product_discount'];
            $product->product_main_image = (isset($filename)) ? $filename : '';
            $product->product_video = (isset($videofilename)) ? $videofilename : '';
            $product->is_featured = (empty($request['is_featured'])) ? 0 : 1;
            $product->product_description = $request['product_description'];
            $product->meta_title = $request['meta_title'];
            $product->meta_description = $request['meta_description'];
            $product->meta_keywords = $request['meta_keywords'];
            $product->status = 1;
            $product->save();

            Session::flash('flash_success', 'Product created successfully!');

            return redirect()->back();
        }

        if($request->isMethod('get'))
        {
            $categories = Section::with('categories')->get();
            $brands = Brand::all();

            //$categories = json_decode(json_encode($categories), true);
            //echo "<pre>"; print_r($categories); die;
            return view('admin.product.add-product')->with(['categories' => $categories, 'brands' => $brands]);
        }
    }


    public function updateProduct(Request $request, $id = null)
    {
        Session::put('page', 'Catalogues');

        //Proecess submit form data
        if($request->isMethod('post'))
        {
            //echo "<pre>"; print_r($request->all()); die;
            $rules = [
                'product_name' => 'required',
                'product_code' =>  'required|regex:/^[\w-]*$/', //AlphaNumeric regex:/^[\w-]*$/'
                'category_id'      =>  'required|numeric',
                'brand_id'      =>  'required|numeric',
                'product_price'    =>  'required|numeric',
                'product_discount' => 'numeric',
                'product_weight'    =>  'numeric',
                'product_main_image' => 'mimes:jpg,jpeg,png,gif|max:2048',
                'product_video'      =>   'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040'
            ];
            $messages = [
                'product_name.required' => 'Enter product name',
                'product_code.required' => 'Enter product code',
                'category_id.required' => 'Select product category',
                'brand_id.required' => 'Select product brand',
                'product_price.required' => 'Enter product price',
                'product_price.numeric' => 'Enter price in numeric eg: (0 or 0.00)',
                'product_discount.numeric' => 'Enter discount in numeric eg: (0 or 0.00)',
                'product.weight.numeric' => 'Enter weight in numeric',
            ];
            $request->validate($rules, $messages);

            //$filename = '';
            //Upload image file
            if($request->hasFile('product_main_image'))
            {
                $currentImage = Product::find($id);
                if(Storage::exists('public/product_images/large/'.$currentImage->product_main_image))
                {
                    Storage::delete('public/product_images/large/'.$currentImage->product_main_image);
                }

                if(Storage::exists('public/product_images/medium/'.$currentImage->product_main_image))
                {
                    Storage::delete('public/product_images/medium/'.$currentImage->product_main_image);
                }

                if(Storage::exists('public/product_images/small/'.$currentImage->product_main_image))
                {
                    Storage::delete('public/product_images/small/'.$currentImage->product_main_image);
                }

                $filename = time() . '.' . $request->file('product_main_image')->getClientOriginalExtension();
                $largeFilePath = storage_path('app/public/product_images/large/'.$filename);
                $mediumFilePath = storage_path('app/public/product_images/medium/'.$filename);
                $smallFilePath = storage_path('app/public/product_images/small/'.$filename);

                //save large image
                Image::make($request->file('product_main_image'))->resize(800, 800)
                ->save($largeFilePath);

                //Save medium image
                Image::make($request->file('product_main_image'))->resize(640, 640)
                ->save($mediumFilePath);

                //Save small image
                Image::make($request->file('product_main_image'))->resize(200, 200)
                ->save($smallFilePath);
            }

            //upload video file
            if($request->hasFile('product_video'))
            {
                $currentVideo = Product::find($id);
                if(Storage::exists('public/product_videos/'.$currentVideo->product_video))
                {
                    Storage::delete('public/product_videos/'.$currentVideo->product_video);
                }
                $videofilename = time() . '.'. $request->file('product_video')->getClientOriginalExtension();
                $storagePath = storage_path('app/public/product_videos');
                $request->file('product_video')->move($storagePath, $videofilename);
            }

            //echo "<pre>"; print_r($request->all()); die;

            $section = Category::find($request['category_id']);
            $product = Product::find($id);
            $product->product_name = $request['product_name'];
            $product->product_code = $request['product_code'];
            $product->category_id = $request['category_id'];
            $product->section_id = $section->section_id;
            $product->brand_id = $request['brand_id'];
            $product->product_price = $request['product_price'];
            $product->product_weight = $request['product_weight'];
            $product->product_discount = $request['product_discount'];
            $product->product_main_image = (isset($filename)) ? $filename : $product->product_main_image;
            $product->product_video = (isset($videofilename)) ? $videofilename : $product->product_video;
            $product->is_featured = (empty($request['is_featured'])) ? 0 : 1;
            $product->product_description = $request['product_description'];
            $product->meta_title = $request['meta_title'];
            $product->meta_description = $request['meta_description'];
            $product->meta_keywords = $request['meta_keywords'];
            $product->status = 1;
            $product->save();

            Session::flash('flash_success', 'Product updated successfully!');

            return redirect()->back();
        }

        if($request->isMethod('get'))
        {
            $categories = Section::with('categories')->get();
            $product =  Product::find($id);
            $brands = Brand::get();
            //$categories = json_decode(json_encode($categories), true);
            //echo "<pre>"; print_r($product); die;
            return view('admin.product.update-product')->with(['categories' => $categories, 'product' => $product, 'brands'=>$brands]);
        }
    }

    public function deleteProduct(Request $request)
    {
        $product_id = (INT) $request->product_id;
        $product = Product::find($product_id);
        $product->delete();

        if(Storage::exists('public/product_images/large/'.$product->product_main_image))
        {
            Storage::delete('public/product_images/large/'.$product->product_main_image);
        }

        if(Storage::exists('public/product_images/medium/'.$product->product_main_image))
        {
            Storage::delete('public/product_images/medium/'.$product->product_main_image);
        }

        if(Storage::exists('public/product_images/small/'.$product->product_main_image))
        {
            Storage::delete('public/product_images/small/'.$product->product_main_image);
        }

        if(Storage::exists('public/product_videos/'.$product->product_video))
        {
            Storage::delete('public/product_videos/'.$product->product_video);
        }

        return response()->json(['success' =>  'Product has been deleted successfully!']);
    }


    // ============================= PRODUCT ATTRIBUTES FUNCTIONALITIES =========================

    public function productAttributes(Request $request, $id = null)
    {
        Session::put('page', 'Catalogues');
        if($request->isMethod('get'))
        {
            $product = Product::select('id', 'product_name', 'product_code', 'product_main_image')
            ->with('attributes')->find($id);
            return view('admin.product.product-attributes')->with(['product'=>$product]);
        }

        if($request->isMethod('post'))
        {
            // echo "<pre>"; print_r($request->all()); die;
            $data = $request->all();
            foreach($data['size'] as $key => $value)
            {
                $attribute = new ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->size = $data['size'][$key];
                    $attribute->sku = $data['sku'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
            }
            Session::flash('flash_success', 'Product attribute(s) has been added successfully!');
            return redirect()->back();
        }
    }

    public function updateProductAttributes(Request $request, $id = null)
    {
        // echo "<pre>"; print_r($request->all()); die;
        $data = $request->all();
        foreach($data['price'] as $key => $value)
        {
            ProductAttribute::where('id', $data['attribute_id'][$key])
            ->update([
                'price' => $data['price'][$key],
                'stock' => $data['stock'][$key]
            ]);
        }
        Session::flash('flash_success', 'Product attribute has been updated succesfully!');
        return redirect()->back();
    }

    public function changeProductAttributeStatus(Request $request)
    {
        if($request['product_attribute_status'] == 1)
        {
            $status = 0;
        }else{
            $status = 1;
        }
        ProductAttribute::find($request['attribute_id'])->update(['status' => $status]);

        return response()->json(['status' => $status]);
    }

    public function deleteProductAttributes(Request $request)
    {
        $id = (int) $request->product_attribute_id;
        ProductAttribute::find($id)->delete();
        return response()->json(['success' => 'Product attribute has been deleted!']);
    }
}
