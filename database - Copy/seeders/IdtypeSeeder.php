<?php

namespace Database\Seeders;

use App\Models\Idtype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Idtype::factory()->create([
            "code" => "0120",
            "enum" => "Alien Registration Card",
        ]);
        Idtype::factory()->create([
            "code" => "0121",
            "enum" => "National ID",
        ]);
        Idtype::factory()->create([
            "code" => "0122",
            "enum" => "Passport",
        ]);
    }
}
