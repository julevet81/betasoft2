<?php

namespace Database\Seeders;

use App\Models\ContractType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contractTypes = [
            ['name' => 'Full-time'],
            ['name' => 'Part-time'],
            ['name' => 'Contract'],
            ['name' => 'Internship'],
            ['name' => 'Monthly'],
            ['name' => 'Hourly'],
            ['name' => 'Freelance'],
        ];

        foreach ($contractTypes as $type) {
            ContractType::create($type);
        }
    }
}