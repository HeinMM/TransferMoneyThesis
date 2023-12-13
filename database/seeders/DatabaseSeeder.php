<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            TransactionSeeder::class,
            NationSeeder::class,
            NationImageSeeder::class,
            RateSeeder::class,
            IdtypeSeeder::class,
            RelationSeeder::class,
            PaymentMethodSeeder::class,
            BankSeeder::class,
            PurposeOfRemitSeeder::class,
            SourceOfFundSeeder::class,
            RidtypeSeeder::class
        ]);
    }
}
