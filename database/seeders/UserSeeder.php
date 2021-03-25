<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->id = 1;
        $user->email = "myemail@mail.com";
        $user->name = "Debasish Dhara";
        $user->phone = "0123456789";
        $user->password = Hash::make('password');
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
        $user->roles()->sync([1]);

        $user = new User();
        $user->id = 2;
        $user->email = "demo@mail.com";
        $user->name = "User User";
        $user->phone = "0123456789";
        $user->password = Hash::make('password');
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
        $user->roles()->sync([2]);
    }
}
