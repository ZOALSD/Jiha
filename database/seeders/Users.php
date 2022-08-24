<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Ahmed',
            'last_name' => 'Mohammed',
            'email' => 'Ahmed@me.com',
            'phone' => '0922767322',
            'status' => true
        ]);

        User::create([
            'first_name' => 'Ragda',
            'last_name' => 'Tag Elser',
            'email' => 'Ragda@me.com',
            'phone' => '0922302225',
            'status' => true
        ]);


    }
}
