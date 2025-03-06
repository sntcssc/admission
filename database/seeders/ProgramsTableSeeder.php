<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programs')->insert([
            [
                'name' => 'Composite Course',
                'code' => 'COMP',
                'description' => 'An introduction to Composite Course.',
                'base_duration' => '10 months',
                'min_qualification' => 'Graduation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Prelims Crash Course',
                'code' => 'PCC',
                'description' => 'A program focused on UPSC CSE Prelims Examination',
                'base_duration' => '3 months',
                'min_qualification' => 'Graduation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mains Guidance Programme',
                'code' => 'MGP',
                'description' => 'For UPSC CSE Mains',
                'base_duration' => '6 months',
                'min_qualification' => 'Graduation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
