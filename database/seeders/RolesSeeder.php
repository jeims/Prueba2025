<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            ['nombre' => 'Admin'],
            ['nombre' => 'Usuario normal'],
            ['nombre' => 'Usuario estandar'],
        ];

        DB::table('roles')->insert($roles);

    }
}
