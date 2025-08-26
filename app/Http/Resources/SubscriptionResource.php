<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'plan'      => $this->plan,
            'start'     => $this->start_date,
            'end'       => $this->end_date,
            'active'    => $this->active,
        ];
    }
}
