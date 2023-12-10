<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactUs;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;


class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        ContactUs::truncate();
        Schema::enableForeignKeyConstraints();

        $data=[
            [
                'name'=>'The Venus Healthcare LLP',
                'email'=>'rajvi@alitainfotech.com',
                'password'=>bcrypt('password'),
                'phone_number'=>78968574856,
                'address'=>'Surat, Lal Darwaja Station Road, Suryapur Gate, Varachha, Surat, Gujarat, India',
                'latitude'=>22.3071588,
                'longitude'=>72.8410814,   
                'private_public_hospital'=>1, 

            ], [
                'name'=>'Gujarat Superspeciality Hospital',
                'email'=>'pooja@alitainfotech.com',
                'password'=>bcrypt('password'),
                'phone_number'=>7896857469,
                'address'=>'Palanpur, Gujarat, India',
                'latitude'=>24.1724338,
                'longitude'=>72.434581,  
                'private_public_hospital'=>0,  

            ]
        ];
        ContactUs::insert($data);
    }
}
