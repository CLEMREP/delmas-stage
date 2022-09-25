<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'email' => $this->resource->email,
            'firstname' => $this->resource->firstname,
            'lastname' => $this->resource->lastname,
            'phone' => $this->resource->userable->phone,
        ];
    }
}
