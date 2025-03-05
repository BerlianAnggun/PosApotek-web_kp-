<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'SuperAdmin',

            ],
            [
                'id' => 2,
                'name' => 'Manager',
            ],
            [
                'id' => 3,
                'name' => 'Apoteker',
            ],
            [
                'id' => 4,
                'name' => 'Marketing',
            ],
            [
                'id' => 5,
                'name' => 'Kasir',
            ],
        ];

        foreach ($roles as $key => $role) {
            Roles::create($role);
        }
    }
}