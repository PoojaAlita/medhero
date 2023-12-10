<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobSkill;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class JobSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        JobSkill::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'job_id'=>'1',
                'skill_id'=>'3',

            ], [
                'job_id'=>'1',
                'skill_id'=>'5',

            ],[
                'job_id'=>'2',
                'skill_id'=>'2',

            ],[
                'job_id'=>'3',
                'skill_id'=>'2',

            ],[
                'job_id'=>'4',
                'skill_id'=>'3',

            ],[
                'job_id'=>'5',
                'skill_id'=>'4',

            ],[
                'job_id'=>'5',
                'skill_id'=>'5',

            ]
        ];
        JobSkill::insert($data);

    }
}
