<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menu')->insert([
            [
                'title' => '文章',
                'icon' => 'fa-book',
                'uri' => 'posts',
                'parent_id' => 0,
                'order' => 9,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => '标签',
                'icon' => 'fa-book',
                'uri' => 'tags',
                'parent_id' => 0,
                'order' => 10,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
