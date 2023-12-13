<?php

namespace Database\Seeders;

use App\Models\Ridtype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RidtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ridtype::factory()->create([
            "enum" => "National ID",
        ]);
        Ridtype::factory()->create([
            "enum" => "Passport",
        ]);
        Ridtype::factory()->create([
            "enum" => "Date Of Birth(yyyy-mm-dd)",
        ]);
    }
}
