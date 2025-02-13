<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initialize Faker
        $faker = Faker::create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate both tables to remove existing records
        Patient::truncate();

        // Enable foreign key checks again
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Generate 50 random patient records
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'first_name' => $faker->firstName, // Random first name
                'last_name' => $faker->lastName, // Random last name
                'address' => $faker->address, // Random address
                'phone' => $faker->phoneNumber, // Random phone number
                'gender' => $faker->randomElement(['male', 'female']), // Random gender
                'age' => $faker->numberBetween(18, 90), // Random age between 18 and 90
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the generated random data into the patients table
        Patient::insert($data);
    }
}
