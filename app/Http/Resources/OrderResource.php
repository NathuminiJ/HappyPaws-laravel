<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'status'      => $this->status,
            'total'       => $this->total_amount,
            'customer'    => new CustomerResource($this->whenLoaded('customer')),
            'products'    => ProductResource::collection($this->whenLoaded('products')),
            'payment'     => new PaymentResource($this->whenLoaded('payment')),
            'shipment'    => new ShipmentResource($this->whenLoaded('shipment')),
        ];
    }
}
