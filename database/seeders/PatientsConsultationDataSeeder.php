<?php

namespace Database\Seeders;

use App\Models\PatientsConsultationData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PatientsConsultationDataSeeder extends Seeder
{
    public function run()
    {

        $faker = Faker::create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PatientsConsultationData::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $patientIds = DB::table('patients')->pluck('id')->toArray(); // assuming you have patients in your 'patients' table

        for ($i = 0; $i < 10; $i++) {  // Adjust 10 to the number of records you want
            DB::table('patients_consultation_data')->insert([
                'patient_id' => $faker->randomElement($patientIds),
                'doctor_name' => $faker->name,
                'data' => json_encode([          
                    'consultationDate' => $faker->date(),
                    'diagnosis' => $faker->sentence,
                    'treatmentPlan' => $faker->paragraph,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
