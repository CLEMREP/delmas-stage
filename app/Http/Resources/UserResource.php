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

    public function toArray($request): JsonResource
    {
        return match ($this->resource->userable::class) { // @phpstan-ignore-line
            Admin::class => AdminResource::make($this->resource),
            Teacher::class => TeacherResource::make($this->resource),
            Student::class => StudentResource::make($this->resource),
        };
    }
}
