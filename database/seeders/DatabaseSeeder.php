<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SerieSeeder::class,
            SuperAdminSeeder::class,
            PromotionSeeder::class,
            FormatSeeder::class,
            StatusSeeder::class,
            JobSeeder::class,
            AdminSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
