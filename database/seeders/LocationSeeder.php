<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
                'latitude' => 35.6895,
                'longitude' => 139.6917,
                'address' => '群馬県前橋市',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
}
