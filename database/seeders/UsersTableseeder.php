<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UsersTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new Users();
        $user->name = 'admin';
        $user->phone = '1111111111';
        $user->state = 'Punjab';
        $user->password = 'admin';
        $user->role =1;
        $user->status =1;
        $user->save();
    }
}