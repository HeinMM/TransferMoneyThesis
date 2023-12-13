<?php

namespace Database\Seeders;

use App\Models\Relation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Relation::factory()->create([
            "code" => "0220",
            "enum" => "Family",
        ]);
        Relation::factory()->create([
            "code" => "0221",
            "enum" => "Business Partner",
        ]);
        Relation::factory()->create([
            "code" => "0222",
            "enum" => "Friend",
        ]);
        Relation::factory()->create([
            "code" => "0223",
            "enum" => "Client",
        ]);

        Relation::factory()->create([
            "code" => "0224",
            "enum" => "Others",
        ]);
    }
}
