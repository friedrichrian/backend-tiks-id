<?php

namespace Database\Seeders;

use App\Models\Theater;
use Illuminate\Database\Seeder;

class TheaterTableSeeder extends Seeder
{
    public function run(): void
    {
        $theaters = [
            [
                'name' => 'Theater 1',
                'section' => 1,
                'col' => 10,
                'row' => 8,
            ],
            [
                'name' => 'Theater 2',
                'section' => 2,
                'col' => 12,
                'row' => 10,
            ],
            [
                'name' => 'Theater 3',
                'section' => 3,
                'col' => 8,
                'row' => 6,
            ],
            [
                'name' => 'Theater 4',
                'section' => 4,
                'col' => 15,
                'row' => 12,
            ],
        ];

        foreach ($theaters as $theater) {
            Theater::create($theater);
        }
    }
}
