<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'receivingCountry' => $this->receivingCountry,
            'sendingCountry' => $this->sendingCountry,
            'receivingCurrency' => $this->receivingCurrency,
            'UsdToMmkRate' => $this->rate,
            'forexSession' => $this->forexSession,
        ];
    }
}
