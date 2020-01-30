<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'user_id'       => '89892327316371621',
            'email'         => 'alayaadmin@alaya.com',
            'photo'         => 'default.png',
            'fullname'      => 'Alaya Admin',
            'phone'         => '080808080808',
            'pin'           => '555666',
            'password'      => Hash::make('alayaadmin555666'),
            'address'       => 'Komplek Pondok Arum',
            'position_id'   =>  '3',
            'branch_id'     => '1'
        ]);
    }
}
