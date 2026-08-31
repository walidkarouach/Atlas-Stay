<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('nom', 'Admin')->first();
        $clientRole = Role::where('nom', 'Client')->first();
        $proprietaireRole = Role::where('nom', 'Propriétaire')->first();

        User::create([
            'nom' => 'Admin Atlas Stay',
            'email' => 'admin@atlasstay.com',
            'password' => Hash::make('password'),
            'telephone' => '0600000000',
            'photo' => null,
            'role_id' => $adminRole->id_role,
            'created_at' => now(),
        ]);

        User::create([
            'nom' => 'Client Atlas Stay',
            'email' => 'client@atlasstay.com',
            'password' => Hash::make('password'),
            'telephone' => '0611111111',
            'photo' => null,
            'role_id' => $clientRole->id_role,
            'created_at' => now(),
        ]);

        User::create([
            'nom' => 'Proprietaire Atlas Stay',
            'email' => 'proprietaire@atlasstay.com',
            'password' => Hash::make('password'),
            'telephone' => '0622222222',
            'photo' => null,
            'role_id' => $proprietaireRole->id_role,
            'created_at' => now(),
        ]);
    }
}