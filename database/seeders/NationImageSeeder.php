<?php

namespace Database\Seeders;

use App\Models\NationImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $nationImage =  ['nationImage/south-korea-flag-icon.svg', 'nationImage/singapore-flag-icon.svg'];

        $count = count($nationImage);
        for ($i = 0; $i < $count; $i++) {
            NationImage::factory()->create([
                "nation_id" => $i+1,
                "name" => $nationImage[$i]
            ]);
        }
    }
}
