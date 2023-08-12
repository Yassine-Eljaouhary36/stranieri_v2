<?php

namespace Database\Seeders;

use App\Models\Hour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $hoursData = [
            ['hour' => '09:00'],
            ['hour' => '10:00'],
            ['hour' => '11:00'],
            ['hour' => '12:00'],
            ['hour' => '13:00'],
            ['hour' => '14:00'],
            ['hour' => '15:00'],
            ['hour' => '16:00'],
            ['hour' => '17:00'],
            ['hour' => '18:00'],
            ['hour' => '19:00'],
            ['hour' => '20:00'],
        ];

        // Insert the data into the "hours" table
        Hour::insert($hoursData);
    }
}
