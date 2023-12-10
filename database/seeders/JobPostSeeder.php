<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;


class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        JobPost::truncate();
        Schema::enableForeignKeyConstraints();

        $data =[
            [
                'user_id' =>3,
                'title'=>'Medical Officer',
                'work_period'=>'2 week',
                'experience'=>'Entery',
                'hourly_rate'=>'2000',
                'description'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
                'attach_file'=>'1669893632_626311.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'user_id' =>3,
                'title'=>'Operations',
                'work_period'=>'3 week',
                'experience'=>'Intermediate',
                'hourly_rate'=>'30000',
                'description'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
                'attach_file'=>'1669893632_626311.jpg',
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_id' =>4,
                'title'=>'Hospital Operations',
                'work_period'=>'3 week',
                'experience'=>'Intermediate',
                'hourly_rate'=>'30000',
                'description'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
                'attach_file'=>'1669893632_626311.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' =>4,
                'title'=>'Hospital Pharmacist',
                'work_period'=>'3 week',
                'experience'=>'Expert',
                'hourly_rate'=>'80000',
                'description'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
                'attach_file'=>'1669893632_626311.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_id' =>4,
                'title'=>'Patient Care Associate',
                'work_period'=>'1 week',
                'experience'=>'Expert',
                'hourly_rate'=>'90000',
                'description'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
                'attach_file'=>'1669893632_626311.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]; 

        JobPost::insert($data);
    }
}
