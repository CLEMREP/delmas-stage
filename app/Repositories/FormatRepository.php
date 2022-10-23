<?php

namespace App\Repositories;

use App\Models\Format;
use Illuminate\Database\Eloquent\Collection;

class FormatRepository
{
    public function __construct(private Format $model)
    {
    }

    public function getAllFormats(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param  array<string>  $data
     */
    public function findFormatById(array $data): Format|null
    {
        return $this->model->all()
            ->where('id', $data['format_id'])
            ->first();
    }
}
