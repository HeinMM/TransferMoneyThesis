<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $paymentName =  ['KBZ Pay', 'Wave Money', 'CB Pay', 'AYA Pay'];
        $paymentAmount =  [100000, 200000, 300000, 400000];
        $rAmount =  [1000000, 2000000, 3000000, 4000000];
        $name = $this->faker->name();
        $phoneNumber = $this->faker->randomNumber(9);
        $nations = [1];
        $processIdentifier = ["D4BBBC5-B738-4275-85C8-26F03A93DB24"];


        $length = 3;
        $mytime = Carbon::now();
        $mytime->toDateTimeString();



        return [

            "agentCode" => "121Hanpass@gmail.com",
            "processIdentifier" => Arr::random($processIdentifier),
            "control_no" => $mytime->toDateString() . rand(1000, 9999) . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length),

            "nation_id" => Arr::random($nations),

            "senderName" => $name,
            "senderPhone" => "010". $phoneNumber,
            "senderIdType" => "NationId",
            "senderId" => "780609-5434536",

            "relation" => "Family",
            "purpose" => "Family Support",
            "sourceOfFund" => "Salary",

            "recipentName" => $name,
            "recipentPhone" => "09". $phoneNumber,
            "recipentIdType" => "Nation Id",
            "recipentId" => "PaULa(N)" . $phoneNumber,

            "paymentName" => Arr::random($paymentName),
            "paymentNumber" => $phoneNumber,

            // "sendingAmount"=> Arr::random($paymentAmount),
            // "sendingCurrency" => "KRW",
            "sendingCountry" => "KR",

            "receivingAmount" => Arr::random($rAmount),
            "receivingCurrency" => "MMK",
            "receivingCountry" => "MMR",

            "forexSession" => "C80D14E3-0C34-4748-B0FD-3BFB69AAzcvcz",
            "exRate" => "3000",

            "state" => false,
            "isApproved" => false
        ];
    }
}
