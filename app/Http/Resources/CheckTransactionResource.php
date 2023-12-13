<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = "";
        $cancelDate = "";
        if ($this->state==0) {
            $status = "Not Transfer Yet!";
        }
        if ($this->state ==1 && $this->isCancel == 0) {
            $status = "Transfered!";
        }
        if ($this->state == 0 && $this->isCancel==1) {
            $cancelDate = $this->updated_at;
        }

        return [
            'controlNo' => $this->control_no,
            'status' => $status,
            'tranDate' => $this->created_at,
            'cancelledDate' => $cancelDate,
        ];
    }
}
