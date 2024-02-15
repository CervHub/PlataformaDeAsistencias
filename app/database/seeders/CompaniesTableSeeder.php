<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company; // Asegúrate de que este es el namespace correcto para tu modelo Company
use App\Http\Controllers\Repository\CompanyModel; // Importa el controlador
class CompaniesTableSeeder extends Seeder
{
    protected $companyModel;

    public function __construct(CompanyModel $companyModel)
    {
        $this->companyModel = $companyModel;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Root',
                'description' => 'Description 1',
                'ruc' => '123456789',
                'role' => '',
            ],
            [
                'name' => 'Certus S.A.C.',
                'description' => 'Description 1',
                'ruc' => '20559312240',
                'role' => 'Gerente',
            ],
            [
                'name' => 'CERV',
                'description' => 'Description 2',
                'ruc' => '2070602356',
                'role' => 'Gerente',
            ]
        ];

        foreach ($companies as $company) {
            list($success, $result) = $this->companyModel->create($company);

            if ($success) {
                error_log('Company created: ' . $result->id);
            } else {
                error_log('Error creating company: ' . $result->getMessage());
            }
        }
    }
}
