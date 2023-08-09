<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\DayHour;
use App\Models\Hour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DayHoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = Day::all();   // Retrieve all days from the "days" table
        $hours = Hour::all(); // Retrieve all hours from the "hours" table

        // Define the data you want to insert into the "day_hours" table
        $dayHoursData = [];
        foreach ($days as $day) {
            foreach ($hours as $hour) {
                $dayHoursData[] = [
                    'day_id' => $day->id,
                    'hour_id' => $hour->id,
                ];
            }
            
        }

        // Insert the data into the "day_hours" table
        DayHour::insert($dayHoursData);

    }
}
