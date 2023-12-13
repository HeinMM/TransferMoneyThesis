<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => "121 Admin",
            'agentCode' => '121Admin',
            'role' => 'admin',
            'password' => Hash::make('32rMX2LBWrbbKu3LXEFr'),
            'authKey' =>  Hash::make('JnX4Iw0lDMe44m5sw%egtvd&CrwjgK7^G2#haeZop!yW7@KCpm'),
            'processIdentifier' => "AdminprocessIdentifier"
        ]);
        \App\Models\User::factory()->create([
            'name' => "121Hanpass",
            'agentCode' => '121Hanpass',
            'role' => 'hanpass',
            'password' => Hash::make('e2k1QfUbwRkC44vy90HW'),
            'authKey' => Hash::make('JnX4Iw0lDMe44m5sw%egtvd&CrwjgK7^G2#haeZop!yW7@KCpm'),
            'processIdentifier' => "D4BBBC5-B738-4275-85C8-26F03A93DB24"
        ]);
    }
}
