<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->save();

        //Admin por defecto
        $user = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'profile_pic' => 'profile.png',
            'friend_count'=> 0,
            'status' => 1,
            'password' => Hash::make('12345678'),
        ]);
            
        $user->roles()->attach(Role::where('name', 'admin')->first());        
        $user->save();
    }
}
