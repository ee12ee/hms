<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Auth\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::query()->create([
            'name'=>'ahmad',
            'phone'=>'0935210625',
            'email'=>'ahmad@gmail.com',
            'password'=>'DerapDog@12345',
            'address'=>'tartous,safita',
        ]);
        $admin->assignRole('superAdmin');
    }

}
