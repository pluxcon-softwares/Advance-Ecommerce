<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

use App\Models\Brand;
use Illuminate\Validation\Rules\Unique;

class BrandController extends Controller
{
    public function brands()
    {
        Session::put('page', 'Catalogues');
        $brands = Brand::get();
        return view('admin.brand.brands')->with(['brands' => $brands]);
    }

    public function addBrand(Request $request)
    {
        Session::put('page', 'Catalogues');

        if($request->isMethod('get'))
        {
            return view('admin.brand.add-brand');
        }

        if($request->isMethod('post'))
        {
            $rules = [
                'name'  =>  'required|unique:brands,name',
                'image' =>  'image|mimes:jpeg,jpg,png,svg|max:2048'
            ];
            $messages = [
                'name.required' => 'Enter brand name',
                'name.unique'   => 'Brand name already exist, enter new brand name',
                'image.mimes'   =>  'Acceptable file type, jpeg, jpg, png, svg'
            ];
            $request->validate($rules, $messages);

            if($request->hasFile('image'))
            {
                $filename = $request['name'].'_'.time() . '.' . $request->file('image')->getClientOriginalExtension();
                $savepath = storage_path('app/public/brand_images/'.$filename);
                Image::make($request->file('image'))->resize(100, 100)->save($savepath);
            }

            $brand = new Brand;
            $brand->name = $request->name;
            $brand->image = (isset($filename)) ? $filename : '';
            $brand->save();

            Session::flash('flash_success', 'Product brand created successfully!');
            return redirect()->back();
        }
    }

    public function updateBrand(Request $request, $id = null)
    {
        Session::put('page', 'Catalogues');
        if($request->isMethod('get'))
        {
            $brand = Brand::find($id);
            return view('admin.brand.edit-brand')->with(['brand' => $brand]);
        }

        if($request->isMethod('post'))
        {
            if($request->hasFile('image'))
            {
                $current_image = Brand::find($id);
                if(Storage::exists('public/brand_images/'.$current_image->image))
                {
                    Storage::delete('public/brand_images/'.$current_image->image);
                }
                $filename = $request['name'].'_'.time() . '.' . $request->file('image')->getClientOriginalExtension();
                $savepath = storage_path('app/public/brand_images/'.$filename);
                Image::make($request->file('image'))->resize(100, 100)->save($savepath);
            }
            $brand = Brand::find($id);
            $brand->name = $request['name'];
            $brand->image = (isset($filename)) ? $filename : $brand->image;
            $brand->save();

            Session::flash('flash_success', 'Product brand has been updated successfully!');
            return redirect()->back();
        }
    }

    public function deleteBrand(Request $request)
    {
        $brand = Brand::find($request->brand_id);
        if(!empty($brand->image))
        {
            if(Storage::exists('public/brand_images/'.$brand->image))
            {
                Storage::delete('public/brand_images/'.$brand->image);
            }
        }
        $brand->delete();
        return response()->json(['success' => 'Product brand has been deleted!']);
    }
}
