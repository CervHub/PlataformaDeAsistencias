<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company; // Asegúrate de que este es el namespace correcto para tu modelo Company

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'ruc' => '20559312241',
            'name' => 'CERV',
            'description' => 'Expertos en VR e IA para la minería e industria. Reduciendo riesgos y aumentando la productividad.',
        ]);
    }
}
