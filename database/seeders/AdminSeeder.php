<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Schema};


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Admin::truncate();
        Schema::enableForeignKeyConstraints();
        $admin = new Admin();
        $admin->name = "Admin";
        $admin->email = "pooja.alitainfotech@gmail.com";
        $admin->password = bcrypt('password');
        $admin->save();
    }
}
