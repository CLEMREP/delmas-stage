<?php

namespace App\Repositories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;

class StatusRepository
{
    public function __construct(private Status $model)
    {
    }

    public function getAllStatuses(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param  array<string>  $data
     */
    public function findStatusById(array $data): Status|null
    {
        return $this->model->all()
            ->where('id', $data['status_id'])
            ->first();
    }
}
