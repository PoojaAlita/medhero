<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Thumb;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class ThumbsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Thumb::truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'user_id'=>'3',
                'thumb_image'=>'1671529439.174270.webp|1671529439.255974.jpg|1671529439.626311.jpg|1671529439.626328.webp|1671529439.1547724.jpg|1671529439.626312.jpg|1671529439.626338.jpg',

            ], [
                'user_id'=>'4',
                'thumb_image'=>'1671529439.174270.webp|1671529439.255974.jpg',

            ]
        ];
        Thumb::insert($data);
    }
}
