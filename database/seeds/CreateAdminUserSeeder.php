<?php

use App\Rating;
use App\User;
use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=>'admin1',
            'email'=>'admin1@test.com',
            'role'=>'admin',
            'password'=>bcrypt('12345678'),
        ]);

        User::create([
            'name'=>'user1test',
            'telepon'=>'92829',
            'username'=>'user1',
            'email'=>'user1@test.com',
            'password'=>bcrypt('12345678'),
        ]);

        Rating::create([
            'layanan_id'=>1,
            'user_id'=>2,
            'rating'=> 4.4,
            'komplain'=>'Agak lama',
        ]);

    }
}
