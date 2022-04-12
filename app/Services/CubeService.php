<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class CubeService
{
    public function storeFacesAndCells($cube)
    {
        $cells = Config::get('constants.cells');
        $faces = Config::get('constants.faces');
        $cube->faces()->createMany($faces);

        foreach ($cube->faces as $face) {
            $random_cells =  array_slice($cells, 0, 9);

            $face->cells()->createMany($random_cells);

            $results = array_diff(array_map('serialize',$cells), array_map('serialize',$random_cells));
            $cells = array_map('unserialize', $results);
        }
    }
}
