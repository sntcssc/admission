<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('batches')->insert([
        //     [
        //         'name' => 'Batch A',
        //         'academic_year' => 2022,
        //         'code' => 'BA2022',
        //         'start_date' => Carbon::createFromDate(2022, 9, 1),
        //         'end_date' => Carbon::createFromDate(2023, 6, 30),
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Batch B',
        //         'academic_year' => 2023,
        //         'code' => 'BB2023',
        //         'start_date' => Carbon::createFromDate(2023, 9, 1),
        //         'end_date' => Carbon::createFromDate(2024, 6, 30),
        //         'status' => 'planned',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Batch C',
        //         'academic_year' => 2021,
        //         'code' => 'BC2021',
        //         'start_date' => Carbon::createFromDate(2021, 9, 1),
        //         'end_date' => Carbon::createFromDate(2022, 6, 30),
        //         'status' => 'archived',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
        
        $batches = [
            [
                'name' => 'Batch 2026',
                'academic_year' => 2026,
                'code' => 'BATCH-2026',
                'start_date' => '2025-07-01',
                'end_date' => '2026-06-30',
                'status' => 'planned',
            ],
        ];

        // Insert the batches into the batches table
        DB::table('batches')->insert($batches);
    }
}
