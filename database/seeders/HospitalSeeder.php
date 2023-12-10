<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hospital;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Hospital::truncate();
        Schema::enableForeignKeyConstraints();
        $data=[
            [
                'user_id'=>3,
                'like'=>0,
                'private_public_hospital'=>1,

            ], [
                'user_id'=>4,
                'like'=>0,
                'private_public_hospital'=>1,  

            ]
        ];
        Hospital::insert($data);
    }
}
