<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusNames = ['En Attente', 'Refusé', 'Accepté'];

        foreach ($statusNames as $status) {
            Status::insert([
                'name' => $status,
            ]);
        }
    }
}
