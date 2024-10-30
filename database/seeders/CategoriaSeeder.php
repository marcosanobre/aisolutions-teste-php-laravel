<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria')->insert([
            'nome' => 'Remessa Parcial'
        ]);
        DB::table('categoria')->insert([
            'nome' => 'Remessa'
        ]);
    }
}
