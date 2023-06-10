<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Blogs',
                'slug' => 'blog',
                'description' => 'Blog - Dành cho ae thợ Nội Thất Ô Tô - Gara ô tô có cách nhìn khác hoàn toàn',
                'thumbnail' => '',
                'status' => 1,
                '_lft' => 1,
                '_rgt' => 2,
                'parent_id' => NULL,
                'created_at' => '2021-01-16 10:37:49',
                'updated_at' => '2021-01-16 14:10:08',
            ), 
        ));
    }
}