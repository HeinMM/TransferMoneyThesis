<?php

namespace Database\Seeders;

use App\Models\PurposeOfRemit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurposeOfRemitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurposeOfRemit::factory()->create([
            "code" => "0320",
            "enum" => "Family Support",
        ]);
        PurposeOfRemit::factory()->create([
            "code" => "0321",
            "enum" => "Tuition fee",
        ]);
        PurposeOfRemit::factory()->create([
            "code" => "0322",
            "enum" => "Medical Expences",
        ]);
        PurposeOfRemit::factory()->create([
            "code" => "0323",
            "enum" => "Payment",
        ]);
        PurposeOfRemit::factory()->create([
            "code" => "0324",
            "enum" => "Others",
        ]);
    }
}
