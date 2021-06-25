<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->truncate();
        $sections = [
            ['name' => 'Men', 'status' => 1],
            ['name' => 'Women', 'status' => 1],
            ['name' => 'Kids', 'status' => 0],
        ];

        foreach($sections as $section)
        {
            \App\Models\Section::create($section);
        }
    }
}
