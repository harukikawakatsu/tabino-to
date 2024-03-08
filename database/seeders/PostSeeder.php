<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('posts')->insert([
                'user_id' => 1,
                'location_id' => 1,
                'category_id' => 1,
                'image_url' => 'example.jpg',
                'comment' => 'これは初めての景色投稿です。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'count_goods' => 0,
                
         ]);
    }
}
