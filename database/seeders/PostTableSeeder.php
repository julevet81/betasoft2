<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            ['title' => 'Manager'],
            ['title' => 'Flutter Developer'],
            ['title' => 'Frontend Developer'],
            ['title' => 'Backend Developer'],
            ['title' => 'Fullstack Developer'],
            ['title' => 'DevOps Engineer'],
            ['title' => 'Data Scientist'],
            ['title' => 'UX/UI Designer'],
            ['title' => 'Product Manager'],
            ['title' => 'Business Analyst'],
            
        ];

        foreach ($posts as $post) {
            \App\Models\Post::create($post);
        }
    }
}
