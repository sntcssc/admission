<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertisementProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('advertisement_programs')->insert([
            
            [
                'advertisement_id' => 1,
                'batch_program_id' => 1,
                'available_seats' => 200,
            ],
            // [
            //     'advertisement_id' => 1,
            //     'batch_program_id' => 2,
            //     'available_seats' => 30,
            // ],
        ]);
    }
}
