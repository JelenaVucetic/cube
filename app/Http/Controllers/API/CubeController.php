<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Cell;
use App\Models\Face;
use Illuminate\Http\Request;

class CubeController extends BaseController
{
    public function index()
    {
        $cube = json_decode(file_get_contents(public_path() . "/newcube.json"), true);

        $cell_id = 1;
        $rotate = 'down';
        $direction = 'clockwise';

        $cell = Cell::find($cell_id);

        // change cells coordinates on left face
        $left_face = Face::where('name', 'left')->first();
        $left_face_cells = $left_face->cells->pluck('id')->toArray();

        $matrix = array_chunk($left_face_cells, 3);

        $rotated = $this->rotateSideCells($matrix);

        return $rotated;
    }

    public function rotateSideCells($matrix)
    {
        $initial_matrix = $matrix;
        for ($i = 0; $i < 3; $i++) {
            for ($j = $i; $j < 3; $j++) {
                $temp = $matrix[$i][$j];
                $matrix[$i][$j] = $matrix[$j][$i];
                $matrix[$j][$i] = $temp;

                if($temp != $matrix[$i][$j]) {
                    $this->swapCoordinates($temp, $matrix[$i][$j]);
                }

            }
        }

        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3 / 2; $j++) {
                $temp = $initial_matrix[$i][$j];
                $initial_matrix[$i][$j] = $initial_matrix[$i][2 - $j]; // N-1-$j
                $initial_matrix[$i][2 - $j] = $temp;

                if($temp != $initial_matrix[$i][$j]) {
                    $this->swapCoordinates($temp, $initial_matrix[$i][$j]);
                }
            }

        }

        return $matrix;
    }

    public function swapCoordinates($old_cell_id, $new_cell_id)
    {
        $old_cell = Cell::find($old_cell_id);
        $old_x = $old_cell->x_coordinate;
        $old_y = $old_cell->y_coordinate;

        $new_cell = Cell::find($new_cell_id);
        $new_x = $new_cell->x_coordinate;
        $new_y = $new_cell->y_coordinate;

        $old_cell->update([
            'x_coordinate' => $new_x,
            'y_coordinate' => $new_y
        ]);

        $new_cell->update([
            'x_coordinate' => $old_x,
            'y_coordinate' => $old_y
        ]);

    }

}
