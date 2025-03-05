<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = [
            [
                'name'      => 'SuperAdmin',
                'email'     => 'superadmin@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 1
            ],
            [
                'name'      => 'Manager',
                'email'     => 'manager@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 2
            ],
            [
                'name'      => 'Apoteker',
                'email'     => 'apoteker@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 3
            ],
            [
                'name'      => 'Marketing',
                'email'     => 'marketing@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 4
            ],
            [
                'name'      => 'Kasir',
                'email'     => 'kasir@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 5
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}