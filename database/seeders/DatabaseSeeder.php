<?php

namespace Database\Seeders;

use App\Models\Cell;
use App\Models\Face;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        $front = Face::create([
            'name' => 'front',
        ]);

        for ($i = 1; $i < 4; $i++) {
            for ($j = 1; $j < 4; $j++) {
                Cell::create([
                    'face_id' => $front->id,
                    'x_coordinate' => $i,
                    'y_coordinate' => $j,
                    'color' => 'red'
                ]);
            }
        }

        $back = Face::create([
            'name' => 'back',
        ]);


        for ($i = 4; $i < 7; $i++) {
            for ($j = 1; $j < 4; $j++) {
                Cell::create([
                    'face_id' => $back->id,
                    'x_coordinate' => $i,
                    'y_coordinate' => $j,
                    'color' => 'orange'
                ]);
            }
        }

        $top = Face::create([
            'name' => 'top',
        ]);

        for ($i = 7; $i < 10; $i++) {
            for ($j = 1; $j < 4; $j++) {
                Cell::create([
                    'face_id' => $top->id,
                    'x_coordinate' => $i,
                    'y_coordinate' => $j,
                    'color' => 'white'
                ]);
            }
        }

        $bottom = Face::create([
            'name' => 'bottom',
        ]);

        for ($i = 10; $i < 13; $i++) {
            for ($j = 1; $j < 4; $j++) {
                Cell::create([
                    'face_id' => $bottom->id,
                    'x_coordinate' => $i,
                    'y_coordinate' => $j,
                    'color' => 'yellow'
                ]);
            }
        }

        $left = Face::create([
            'name' => 'left'
        ]);

        for ($i = 13; $i < 16; $i++) {
            for ($j = 1; $j < 4; $j++) {
                Cell::create([
                    'face_id' => $left->id,
                    'x_coordinate' => $i,
                    'y_coordinate' => $j,
                    'color' => 'green'
                ]);
            }
        }

        $right = Face::create([
            'name' => 'right'
        ]);

        for ($i = 16; $i < 19; $i++) {
            for ($j = 1; $j < 4; $j++) {
                Cell::create([
                    'face_id' => $right->id,
                    'x_coordinate' => $i,
                    'y_coordinate' => $j,
                    'color' => 'blue'
                ]);
            }
        }
    }
}
