<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'phone'   => $this->phone,
            'address' => $this->address,
            'subscriptions' => SubscriptionResource::collection($this->whenLoaded('subscriptions')),
            'orders'        => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
