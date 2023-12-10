<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Schema,DB,Hash};

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('languages')->truncate();
        Schema::enableForeignKeyConstraints();
        $date = date('Y-m-d H:i:s');
        DB::table('languages')->insert([
            ['name' => 'English', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Chinese', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Spanish', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'German', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'French', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Russian', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Portuguese', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Indonesian', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Arabic', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bengali', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Hindi', 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
