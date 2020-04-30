<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $handle = fopen(__DIR__.'/csv/users.csv', 'r');

            $counter = 0;

            while ($data = fgetcsv($handle))
            {
                if($counter > 0)
                {
                    $user = \App\User::create([
                        'name' => encrypt($data[0]),
                        'phone' => $data[1],
                        'role_id' => $data[2],
                        'phone_verified_at' => $data[3],
                        'password' => bcrypt($data[4])
                    ]);

                    echo "$user->name inserted.\n";
                }

                $counter++;
            }
        } catch (\Exception $exception) {
            echo "{$exception->getMessage()}\n";
        }
    }
}
