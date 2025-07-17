<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseDetail;
use App\Models\CourseHole;

class CourseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseDetail::factory()
            ->has(CourseHole::factory()->count(18), 'holes')
            ->count(10)
            ->create();
    }
}
