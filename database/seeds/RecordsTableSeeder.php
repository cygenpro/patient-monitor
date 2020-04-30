<?php

use Illuminate\Database\Seeder;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $handle = fopen(__DIR__.'/csv/records.csv', 'r');

            $counter = 0;

            while ($data = fgetcsv($handle))
            {
                if($counter > 0)
                {
                    \App\Record::create([
                        'from_id' => $data[0],
                        'to_id' => $data[1],
                        'temperature' => encrypt(number_format($data[2] * 1.8 + 32, 2)), // Celsius to Fahrenheit
                        'has_cough' => encrypt($data[3]),
                        'has_hard_breath' => encrypt($data[4]),
                        'has_sore_throat' => encrypt($data[5]),
                        'has_diarrhea' => encrypt($data[6]),
                        'has_tiredness' => encrypt($data[7]),
                    ]);
                }

                $counter++;
            }

            echo "Records seeded.\n";
        } catch (\Exception $exception) {
            echo "{$exception->getMessage()}\n";
        }


    }
}
