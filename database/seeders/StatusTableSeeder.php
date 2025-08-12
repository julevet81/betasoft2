<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Pending',
                'description' => 'The status is pending approval.',
            ],
            [
                'name' => 'in_progress',
                'description' => 'The status is currently being worked on.',
            ],
            [
                'name' => 'completed',
                'description' => 'The status has been completed.',
            ],
            [
                'name' => 'on_hold',
                'description' => 'The status is currently on hold.',
            ],
            [
                'name' => 'cancelled',
                'description' => 'The status has been cancelled.',
            ],
            
        ];

        foreach ($statuses as $status) {
            \App\Models\Status::create($status);
        }
    }
}
