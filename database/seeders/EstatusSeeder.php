<?php

namespace Database\Seeders;

use App\Models\Estatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estatus = [
            ['nombre' => 'Abierto'],
            ['nombre' => 'En proceso'],
            ['nombre' => 'Concluido'],
        ];

        DB::table('estatus')->insert($estatus);
    }
}
