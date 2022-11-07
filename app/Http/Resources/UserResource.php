<?php

namespace App\Http\Resources;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /** @var User */
    public $resource;

    public function toArray($request): array
    {
        if ($this->resource->userable::class == Admin::class)
        {
            return [
                'id' => $this->resource->getKey(),
                'email' => $this->resource->email,
                'name' => $this->resource->name,
                'isSuperAdmin' => $this->resource->userable->isSuperAdmin,
            ];
        }

        if ($this->resource->userable::class == Teacher::class)
        {
            return [
                'id' => $this->resource->getKey(),
                'email' => $this->resource->email,
                'name' => $this->resource->name,
                'phone' => $this->resource->userable->phone,
            ];
        }


        return [
            'id' => $this->resource->getKey(),
            'email' => $this->resource->email,
            'name' => $this->resource->name,
            'address' => $this->resource->userable->address,
            'city' => $this->resource->userable->city,
            'zip' => $this->resource->userable->zip,
        ];
    }
}
