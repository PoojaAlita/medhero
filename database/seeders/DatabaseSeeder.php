<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            DoctorSeeder::class,
            ContactSeeder::class,
            ThumbsImageSeeder::class,
            HospitalSeeder::class,
            /*
                *Author : kishan 
                *Date : 29/04/22
                *Added skill and language seeder
            */
            SkillSeeder::class,
            LanguageSeeder::class,
            JobPostSeeder::class,
            JobSkillSeeder::class,
            JobLanguageSeeder::class
            /*
                *Author : kishan 
                *Date : 29/04/22
                *end
            */
        ]);
    }
}
