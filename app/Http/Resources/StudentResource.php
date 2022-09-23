<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /** @var User */
    public $resource;

    /**
     * @param $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->getKey(),
            'firstname' => $this->resource->firstname,
            'lastname' => $this->resource->lastname,
            'email' => $this->resource->email,
            'address' => $this->resource->userable->address,
            'city' => $this->resource->userable->city,
            'zip' => $this->resource->userable->zip,
            'mobility' => $this->resource->userable->mobility,
            'desire' => $this->resource->userable->desire,
            'motivation' => $this->resource->userable->motivation,
        ];
    }
}
