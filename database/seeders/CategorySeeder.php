<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $categories = [
            '山',
            '川',
            '公園',
            '植物',
            '都市',
            '動物',
            '空',
            '夜',
            '星',
            '建築物',
         ];
         
         foreach ($categories as $category) {
            Category::create(['name' => $category]);
         }
    }
}
