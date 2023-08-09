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
            ['hour' => '09:00', 'period' => "morning"],
            ['hour' => '10:00', 'period' => "morning"],
            ['hour' => '11:00', 'period' => "morning"],
            ['hour' => '12:00', 'period' => "morning"],
            ['hour' => '13:00', 'period' => "evening"],
            ['hour' => '14:00', 'period' => "evening"],
            ['hour' => '15:00', 'period' => "evening"],
            ['hour' => '16:00', 'period' => "evening"],
            ['hour' => '17:00', 'period' => "evening"],
            ['hour' => '18:00', 'period' => "evening"],
            ['hour' => '19:00', 'period' => "evening"],
            ['hour' => '20:00', 'period' => "evening"],
        ];

        // Insert the data into the "hours" table
        Hour::insert($hoursData);
    }
}
