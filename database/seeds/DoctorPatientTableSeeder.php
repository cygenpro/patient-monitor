<?php

use Illuminate\Database\Seeder;

class DoctorPatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $handle = fopen(__DIR__.'/csv/doctor_patient.csv', 'r');

            $counter = 0;

            while ($data = fgetcsv($handle))
            {
                if($counter > 0)
                {
                    \App\DoctorPatient::create([
                        'doctor_id' => $data[0],
                        'patient_id' => $data[1],
                        'accepted_at' => $data[2]
                    ]);
                }

                $counter++;
            }

            echo "Doctor-Patient associations seeded.\n";
        } catch (\Exception $exception) {
            echo "{$exception->getMessage()}\n";
        }
    }
}
