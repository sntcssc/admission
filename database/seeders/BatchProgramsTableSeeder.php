<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('batch_programs')->insert([
            [
                'batch_id' => 1,
                'program_id' => 1,
                'fee' => 1000.00,
                'available_seats' => 200,
                'max_applications' => 2000,
                'status' => 'open',
            ],
            [
                'batch_id' => 1,
                'program_id' => 2,
                'fee' => 1500.00,
                'available_seats' => 500,
                'max_applications' => 1000,
                'status' => 'closed',
            ],
        ]);
    }
}
