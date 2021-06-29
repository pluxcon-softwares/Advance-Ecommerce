<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $categories = [
            ['parent_id' => 0, 'section_id' => 1, 'category_name' => 'T-Shirts', 'url' => 't-shirts'],
            ['parent_id' => 1, 'section_id' => 1, 'category_name' => 'Casual T-Shirts', 'url' => 'casual-t-shirts'],
        ];

        foreach($categories as $category)
        {
            Category::create($category);
        }
    }
}
