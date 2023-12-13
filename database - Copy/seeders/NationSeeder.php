<?php

namespace Database\Seeders;

use App\Models\Nation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nationNames =  ['Korea', 'Singapore'];

        $count = count($nationNames);
        for ($i=0; $i < $count; $i++) {
            Nation::factory()->create([
                "name" => $nationNames[$i],
                "nationImage_id" => $i+1
            ]);
        }
    }
}
