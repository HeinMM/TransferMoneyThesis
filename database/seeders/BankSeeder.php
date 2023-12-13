<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::factory()->create([
            "code" => "0220",
            "enum" => "KBZ",
        ]);
        Bank::factory()->create([
            "code" => "0221",
            "enum" => "AYA",
        ]);
        Bank::factory()->create([
            "code" => "0222",
            "enum" => "CB",
        ]);
        Bank::factory()->create([
            "code" => "0223",
            "enum" => "YOMA",
        ]);
        Bank::factory()->create([
            "code" => "0224",
            "enum" => "KPAY",
        ]);
        Bank::factory()->create([
            "code" => "0225",
            "enum" => "WAVE MONEY",
        ]);
        Bank::factory()->create([
            "code" => "0226",
            "enum" => "CB PAY",
        ]);
        Bank::factory()->create([
            "code" => "0227",
            "enum" => "AYA PAY",
        ]);
    }
}
