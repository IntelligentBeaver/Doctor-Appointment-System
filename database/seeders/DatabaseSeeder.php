<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Adding Specialization Records.
        // Run: php artisan db:seed
        Specialization::create([
            'SpecializationName' => 'Cardiologist',
            'Description' => 'A medical doctor who studies and treats diseases and conditions of the cardiovascular system.'
        ]);
        Specialization::create([
            'SpecializationName' => 'Dentist',
            'Description' => 'A health care professional who specializes in dentistry, the branch of medicine focused on the teeth, gums, and mouth.'
        ]);
        Specialization::create([
            'SpecializationName' => 'Dermatologist',
            'Description' => 'A medical doctor who specializes in conditions that affect the skin, hair, and nails.'
        ]);
        Specialization::create([
            'SpecializationName' => 'Gastroenterologist',
            'Description' => 'A physician who treats diseases and conditions related to the digestive system and intestines.'
        ]);
        Specialization::create([
            'SpecializationName' => 'Ophthalmologist',
            'Description' => 'A specialist in the branch of medicine concerned with the study and treatment of disorders and diseases of the eye.'
        ]);
        Specialization::create([
            'SpecializationName' => 'Endocrinologist',
            'Description' => 'A medical specialist who treats people with a range of conditions that are caused by problems with hormones.'
        ]);
    }
}