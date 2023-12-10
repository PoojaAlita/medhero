<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Doctor::truncate();
        Schema::enableForeignKeyConstraints();
        $data =[
            [
                'user_id' =>1,
                'medical_registration_no'=>'52415',
                'profile_image'=>'1670581489_626338.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],  [
                'user_id' =>2,
                'medical_registration_no'=>'52485',
                'profile_image'=>'1670581489_626338.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];

            Doctor::insert($data);

    }
}
