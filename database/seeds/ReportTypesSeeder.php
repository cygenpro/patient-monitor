<?php

use Illuminate\Database\Seeder;

class ReportTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('report_types')->insert([
                ['name' => 'body temperature'],
                ['name' => 'has cough'],
                ['name' => 'has hard breath'],
            ]);

            echo self::class . ' success. ';
        } catch (\Exception  $exception) {
            echo self::class . ' failed. ' . $exception->getMessage();
        }
    }
}
