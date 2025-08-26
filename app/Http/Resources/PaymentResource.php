<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'payment_method'=> $this->payment_method,
            'status'        => $this->status,
            'amount'        => $this->amount,
        ];
    }
}
