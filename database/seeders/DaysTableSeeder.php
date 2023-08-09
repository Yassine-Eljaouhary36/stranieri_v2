<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daysData = [
            ['weekday' => 'Monday', 'active' => true],
            ['weekday' => 'Tuesday', 'active' => true],
            ['weekday' => 'Wednesday', 'active' => true],
            ['weekday' => 'Thursday', 'active' => true],
            ['weekday' => 'Friday', 'active' => true],
            ['weekday' => 'Saturday', 'active' => true],
            ['weekday' => 'Sunday', 'active' => false],

            // Add more data as needed
        ];

        // Insert the data into the "days" table
        Day::insert($daysData);
    }
}
