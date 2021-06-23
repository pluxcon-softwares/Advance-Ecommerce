<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $admins = [
            ['name' => 'Administrator', 'type' => 'admin', 'mobile' => '+233243952080',
            'mobile' => '', 'image' => '', 'email' => 'admin@localhost.test', 
            'password' => '123456', 'status' => 1],

            ['name' => 'Philip Otoo', 'type' => 'admin', 'mobile' => '+23324000000',
            'mobile' => '', 'image' => '', 'email' => 'philipotoo@localhost.test', 
            'password' => '123456', 'status' => 1],

            ['name' => 'Michael Otoo', 'type' => 'subadmin', 'mobile' => '+2332412345678',
            'mobile' => '', 'image' => '', 'email' => 'michealotoo@localhost.test', 
            'password' => '123456', 'status' => 1],

            ['name' => 'Theophilus Quaye', 'type' => 'subadmin', 'mobile' => '+23324000000',
            'mobile' => '', 'image' => '', 'email' => 'theophilusquaye@localhost.test', 
            'password' => '123456', 'status' => 0],
        ];

        foreach($admins as $admin)
        {
            \App\Models\Admin::create($admin);
        }
    }
}
