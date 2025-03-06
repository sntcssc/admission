<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertisementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $advertisements = [
            [
                'batch_id' => 1,
                'title' => 'SNTCSSC 2026 Admissions',
                'code' => 'ADV-2026-COMPOSITE-COURSE',
                'application_start' => '2025-03-06 09:00:00',
                'application_end' => '2025-04-31 17:00:00',
                'status' => 'published',
                'instructions' => 'Please submit all required documents by the deadline to ensure timely processing.',
            ],
        ];

        DB::table('advertisements')->insert($advertisements);
    }
}
