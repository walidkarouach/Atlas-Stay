<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'nom' => 'Admin',
        ]);

        Role::create([
            'nom' => 'Client',
        ]);

        Role::create([
            'nom' => 'Propriétaire',
        ]);
    }
}