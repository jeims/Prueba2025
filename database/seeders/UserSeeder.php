<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nombre' => 'Admin',
            'primer_apellido' => 'Admin',
            'segundo_apellido' => 'User',
            'email' => 'admin@ejemplo.com',
            'password' => Hash::make('admin123'),
            'id_rol' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('users')->insert([
            'nombre' => 'Usuario',
            'primer_apellido' => 'Normal',
            'segundo_apellido' => 'Test',
            'email' => 'usuario@ejemplo.com',
            'password' => Hash::make('usuario123'),
            'id_rol' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
