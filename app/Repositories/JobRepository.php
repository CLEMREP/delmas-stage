<?php

namespace App\Repositories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

class JobRepository
{
    public function __construct(private Job $model)
    {
    }

    public function getAllJobs(): Collection
    {
        return $this->model->all();
    }

    public function findJobById(array $data): Job|null
    {
        return $this->model->all()
            ->where('id', $data['job_id'])
            ->first();
    }
}
