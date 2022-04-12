<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function faces()
    {
        return $this->hasMany(Face::class);
    }

    public function getLeftRotationData()
    {
        $front_face = Face::where('name', 'front')->first();
        $bottom_face = Face::where('name', 'bottom')->first();
        $top_face = Face::where('name', 'top')->first();
        $back_face = Face::where('name', 'back')->first();

        $front_column = Cell::where(['face_id' => $front_face->id, 'y_coordinate' => 1])->get();
        $bottom_column = Cell::where(['face_id' => $bottom_face->id, 'y_coordinate' => 1])->get();
        $top_column = Cell::where(['face_id' => $top_face->id, 'y_coordinate' => 1])->get();
        $back_column = Cell::where(['face_id' => $back_face->id, 'y_coordinate' => 1])->get();

        $front_x = $bottom_x = $back_x = $top_x = [];

        foreach ($front_column as $key => $cell) {
            array_push($front_x, $cell->x_coordinate);
        }

        foreach ($bottom_column as $key => $cell) {
            array_push($bottom_x, $cell->x_coordinate);
        }

        foreach ($back_column as $key => $cell) {
            array_push($back_x, $cell->x_coordinate);
        }
        foreach ($top_column as $key => $cell) {;
            array_push($top_x, $cell->x_coordinate);
        }

        return [
            'front_column' => $front_column,
            'bottom_column' => $bottom_column,
            'top_column' => $top_column,
            'back_column' => $back_column,
            'front_x_coordinates' => $front_x,
            'bottom_x_coordinates' => $bottom_x,
            'back_x_coordinates' => $back_x,
            'top_x_coordinates' => $top_x,
        ];
    }

    public function getRotationData($y)
    {
        $front_face = Face::where('name', 'front')->first();
        $bottom_face = Face::where('name', 'bottom')->first();
        $top_face = Face::where('name', 'top')->first();
        $back_face = Face::where('name', 'back')->first();

        $front_column = Cell::where(['face_id' => $front_face->id, 'y_coordinate' => $y])->get();
        $bottom_column = Cell::where(['face_id' => $bottom_face->id, 'y_coordinate' => $y])->get();
        $top_column = Cell::where(['face_id' => $top_face->id, 'y_coordinate' => $y])->get();
        $back_column = Cell::where(['face_id' => $back_face->id, 'y_coordinate' => $y])->get();

        $front_x = $bottom_x = $back_x = $top_x = [];

        foreach ($front_column as $key => $cell) {
            array_push($front_x, $cell->x_coordinate);
        }

        foreach ($bottom_column as $key => $cell) {
            array_push($bottom_x, $cell->x_coordinate);
        }

        foreach ($back_column as $key => $cell) {
            array_push($back_x, $cell->x_coordinate);
        }
        foreach ($top_column as $key => $cell) {;
            array_push($top_x, $cell->x_coordinate);
        }

        return [
            'front_column' => $front_column,
            'bottom_column' => $bottom_column,
            'top_column' => $top_column,
            'back_column' => $back_column,
            'front_x_coordinates' => $front_x,
            'bottom_x_coordinates' => $bottom_x,
            'back_x_coordinates' => $back_x,
            'top_x_coordinates' => $top_x,
        ];
    }



}
