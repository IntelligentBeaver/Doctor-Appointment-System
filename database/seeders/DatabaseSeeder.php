<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TimeSlot;
use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Database\Seeders\TimeSlotSeeder;
use Database\Seeders\SpecializationSeeder;

class DatabaseSeeder extends Seeder
{
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SpecializationSeeder::class,
            TimeSlotSeeder::class,
        ]);
    }
}