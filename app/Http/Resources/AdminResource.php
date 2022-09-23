<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'isSuperAdmin' => $this->resource->userable->isSuperAdmin,
        ];
    }
}
