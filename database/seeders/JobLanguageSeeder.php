<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobLanguage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class JobLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        JobLanguage::truncate();
        Schema::enableForeignKeyConstraints();
        
        $data = [
            [
                'job_id'=>'1',
                'language_id'=>'1',

            ], [
                'job_id'=>'1',
                'language_id'=>'5',

            ],[
                'job_id'=>'2',
                'language_id'=>'1',

            ],[
                'job_id'=>'3',
                'language_id'=>'2',

            ],[
                'job_id'=>'3',
                'language_id'=>'3',

            ],[
                'job_id'=>'4',
                'language_id'=>'2',

            ],[
                'job_id'=>'5',
                'language_id'=>'1',

            ],[
                'job_id'=>'5',
                'language_id'=>'3',

            ],[
                'job_id'=>'5',
                'language_id'=>'11',
            ]
        ];
        JobLanguage::insert($data);
    }
}
