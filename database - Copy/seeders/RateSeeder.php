<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates =  [3000];
        $forexSession = ["C80D14E3-0C34-4748-B0FD-3BFB69AA9adfa"];
        $receivingCountry = ["MMR"];
        $sendingCountry = ["KR"];
        $receivingCurrency = ["MMK"];

        for ($i = 0; $i < 10; $i++) {
            Rate::factory()->create([
                "rate" => Arr::random($rates),
                "forexSession" => Arr::random($forexSession),
                "receivingCountry" => Arr::random($receivingCountry),
                "sendingCountry" => Arr::random($sendingCountry),
                "receivingCurrency" => Arr::random($receivingCurrency),
            ]);
        }
    }
}
