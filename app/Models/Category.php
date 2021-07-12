<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 'section_id', 'category_name', 'category_image', 'category_discount', 'description', 'url',
        'meta_title', 'meta_description', 'meta_keywords', 'status'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function parentcategory()
    {
        //return $this->belongsTo(Category::class, 'parent_id')->select('id', 'category_name');
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'category_name');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function categoryDetails($url)
    {
        $categoryDetails = Category::select('id', 'parent_id', 'category_name', 'url', 'description')
                            ->with(['subcategories' => function($query){
                                $query->select('id', 'category_name', 'section_id', 'parent_id');
                            }])
                            ->where(['url' => $url])
                            ->first()->toArray();
        // breadcrumbs
        if($categoryDetails['parent_id'] == 0)
        {
            //Only show main category in breadcrumb
            $breadcrumbs = '<a href="'.$categoryDetails['url'].'">'.$categoryDetails['category_name'].'</a>';
        }else{
            //Show main category and subcategory in breadcrumb
            $parentCategory = Category::select('category_name', 'url')->where('id', $categoryDetails['parent_id'])
            ->first()->toArray();
            $breadcrumbs = "<a href='".url($parentCategory['url'])."'>".$parentCategory['category_name']."</a> <span class='divider'>/</span>
            <a href='".$categoryDetails['url']."'>".$categoryDetails['category_name']."</a>";
        }

        $catIds = array();
        $catIds[] = $categoryDetails['id'];
        foreach($categoryDetails['subcategories'] as $subcat)
        {
            $catIds[] = $subcat['id'];
        }
        return ['catIds' => $catIds, 'categoryDetails' => $categoryDetails, 'breadcrumbs' => $breadcrumbs];
    }
}
