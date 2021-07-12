<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;
use App\Models\Section;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'Categories');
        $categories = Category::get();
        $sections = Section::get();
        return view('admin.category.categories')->with(['allcategories'=>$categories, 'sections'=>$sections]);
    }

    public function changeSectionStatus(Request $request)
    {
        if($request['category_status'] == 1)
        {
            $status = 0;
        }else{
            $status = 1;
        }
        Category::find($request['category_id'])->update(['status' => $status]);

        return response()->json(['status' => $status]);
    }

    public function addCategory(Request $request)
    {
        Session::put('page', 'Categories');

        //Proecess submit form data
        if($request->isMethod('post'))
        {
            $rules = [
                'category_name' => 'required', //regex:/^[\pL\s\-]+$/u //AlphaNumeric regex:/^[\w-]*$/'
                'category_image' =>  'image|mimes:jpg,jpeg,png,gif|max:2048|sometimes',
                'url'           =>  'required',
                'section_id'    =>  'required|numeric',
                'category_discount' => 'required|numeric'
            ];
            $messages = [
                'category_name.required' => 'Category name cannot be empty, enter category name',
                'category_image.mimes' => 'Uploaded image file format is not supported',
                'category_image.max' => 'Uploaded image cannot be more than 2MB',
                'url.required' => 'URL is required',
                'section_id.required' => 'Section required, select section',
                'category_discount.required' => 'Category discount required, defualt is zero(0)'
            ];
            $request->validate($rules, $messages);

            $filename = '';
            if($request->hasFile('category_image'))
            {
                $filename = time() . '_' . $request->file('category_image')->getClientOriginalName();
                $filepath = storage_path('app/public/category_images/'.$filename);
                Image::make($request->file('category_image'))->resize(80, 100)
                ->save($filepath);
            }

            $category = new Category;
            $category->category_name = $request['category_name'];
            $category->parent_id = $request['parent_id'];
            $category->section_id = $request['section_id'];
            $category->category_image = $filename;
            $category->category_discount = $request['category_discount'];
            $category->description = $request['description'];
            $category->url = $request['url'];
            $category->meta_title = $request['meta_title'];
            $category->meta_description = $request['meta_description'];
            $category->meta_keywords = $request['meta_keywords'];
            $category->status = 1;
            $category->save();

            Session::flash('flash_success', 'Category created successfully!');

            return redirect()->back();
        }

        $sections = Section::get();
        return view('admin.category.add-category', compact('sections'));
    }

    public function fetchSectionCategories(Request $request)
    {
        $categories = Category::with('subcategories')->where('section_id', $request['section_id'])
                                                    ->where('status', 1)
                                                    ->where('parent_id', 0)
                                                    ->get();
        //return response()->json(['data' => $categories]);
        return view('admin.category._category-lavel', compact('categories'));
    }

    public function editCategory($id)
    {}

    public function updateCategory(Request $request, $id=null)
    {
        if($request->isMethod('get'))
        {
            $sections = Section::all();
            $editcategory = Category::find($id);
            $categories = Category::with('subcategories')
                        ->where('section_id', $editcategory->section_id)
                        ->where('parent_id', 0)
                        ->get();
            return view('admin.category.edit-category')->with(['sections'=>$sections, 'editcategory' => $editcategory, 'categories' => $categories]);
        }

        if($request->isMethod('post'))
        {
            //return $request->all();
            $rules = [
                'category_name' => 'required', //regex:/^[\pL\s\-]+$/u
                'category_image' =>  'image|mimes:jpg,jpeg,png,gif|max:2048|sometimes',
                'url'           =>  'required',
                'section_id'    =>  'required|numeric',
                'category_discount' => 'required|numeric'
            ];
            $messages = [
                'category_name.required' => 'Category name cannot be empty, enter category name',
                'category_image.mimes' => 'Uploaded image file format is not supported',
                'category_image.max' => 'Uploaded image cannot be more than 2MB',
                'url.required' => 'URL is required',
                'section_id.required' => 'Section required, select section',
                'category_discount.required' => 'Category discount required, defualt is zero(0)'
            ];
            $request->validate($rules, $messages);

            $filename = null;
            if($request->hasFile('category_image'))
            {
                $currentfile = Category::find($request->category_id);
                if(Storage::exists('public/category_images/'.$currentfile->category_image))
                {
                    Storage::delete('public/category_images/'.$currentfile->category_image);
                }
                $filename = time() . '_' . $request->file('category_image')->getClientOriginalName();
                $filepath = storage_path('app/public/category_images/'.$filename);
                Image::make($request->file('category_image'))->resize(80, 100)
                ->save($filepath);
            }

            $category = Category::find($request->category_id);
            $category->category_name = $request['category_name'];
            $category->parent_id = $request['parent_id'];
            $category->section_id = $request['section_id'];
            $category->category_image = $filename ? $filename : $category->category_image;
            $category->category_discount = $request['category_discount'];
            $category->description = $request['description'];
            $category->url = $request['url'];
            $category->meta_title = $request['meta_title'];
            $category->meta_description = $request['meta_description'];
            $category->meta_keywords = $request['meta_keywords'];
            $category->status = $category->status;
            $category->save();

            Session::flash('flash_success', 'Category created successfully!');

            return redirect()->back();
        }
    }

    public function deleteCategory(Request $request)
    {
        Category::find($request['category_id'])->delete();
        return response()->json(['success' => 'Category has been deleted!']);
    }
}
