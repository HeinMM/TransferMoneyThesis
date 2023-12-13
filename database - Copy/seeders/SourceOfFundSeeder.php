<?php

namespace Database\Seeders;

use App\Models\SourceOfFund;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceOfFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SourceOfFund::factory()->create([
            "code" => "0420",
            "enum" => "Salary",
        ]);
        SourceOfFund::factory()->create([
            "code" => "0421",
            "enum" => "Business",
        ]);
        SourceOfFund::factory()->create([
            "code" => "0422",
            "enum" => "Others",
        ]);
    }
}
