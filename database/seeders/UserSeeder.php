<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Dirape\Token\Token;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Schema,DB,Hash};


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        $data =[
            [
                'name' =>'Shams',
                'email'=>'shams@alitainfotech.com',
                'password'=>bcrypt('password'),
                'phone_number'=>'9695874563',
                'address'=>'Vadodara, Gujarat, India',
                'latitude'=>22.3071588,
                'longitude'=>73.1812187,
                'cover_image'=>'1669892474_4533723.webp',
                'about'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'approval'=>'2',
                'user_status'=>'0',
                'flag'=>'1',
                'remember_token' => (new Token())->Unique('users', 'remember_token', 60),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'name' =>'Hitesh',
                'email'=>'hitesh@alitainfotech.com',
                'password'=>bcrypt('password'),
                'phone_number'=>'9695874596',
                'address'=>'Surat, Lal Darwaja Station Road, Suryapur Gate, Varachha, Surat, Gujarat, India',
                'latitude'=>22.3071588,
                'longitude'=>72.8410814,
                'cover_image'=>'1669892474_4533723.webp',
                'about'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'approval'=>'2',
                'user_status'=>'0',
                'flag'=>'1',
                'remember_token' => (new Token())->Unique('users', 'remember_token', 60),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'name' =>'The Venus Healthcare LLP',
                'email'=>'pooja@alitainfotech.com',
                'password'=>bcrypt('password'),
                'phone_number'=>7896857485,
                'address'=>'Surat, Lal Darwaja Station Road, Suryapur Gate, Varachha, Surat, Gujarat, India',
                'latitude'=>22.3071588,
                'longitude'=>72.8410814,
                'cover_image'=>'1669892630_626317.jpg',
                'about'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'approval'=>'1',
                'user_status'=>'1',
                'flag'=>'0',
                'remember_token' => (new Token())->Unique('users', 'remember_token', 60),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'name' =>'Gujarat Superspeciality Hospital',
                'email'=>'rajvi@alitainfotech.com',
                'password'=>bcrypt('password'),
                'phone_number'=>7896857469,
                'address'=>'Palanpur, Gujarat, India',
                'latitude'=>24.1724338,
                'longitude'=>72.434581,
                'cover_image'=>'1669893058_626338.jpg',
                'about'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'approval'=>'1',
                'user_status'=>'1',
                'flag'=>'0',
                'remember_token' => (new Token())->Unique('users', 'remember_token', 60),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]; 

        User::insert($data);
     
    }
}