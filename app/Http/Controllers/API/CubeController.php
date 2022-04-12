<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\RotateCubeRequest;
use App\Http\Requests\StoreCubeRequest;
use App\Http\Resources\CubeResource;
use App\Models\Cell;
use App\Models\Cube;
use App\Models\Face;
use App\Services\CubeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;

class CubeController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCubeRequest $request
     * @return JsonResponse
     */
    public function store(StoreCubeRequest $request, CubeService $store)
    {
        $cube = Cube::create($request->validated());

        $store->storeFacesAndCells($cube);

        return $this->sendResponse(new CubeResource($cube), 'Cube created successfully.');
    }

    public function show(Cube $cube)
    {
        return $this->sendResponse(new CubeResource($cube), 'Cube retrieved successfully.');
    }

    public function rotation(RotateCubeRequest $request)
    {
        $turn = $request->turn;

        // change cells coordinates for specific turn
        $face = Face::where('name', $turn)->first();
        $cube = $face->cube;
        $cells = $face->cells->pluck('id')->toArray();
        $matrix = array_chunk($cells, 3);

        $face->rotateFaceCells($matrix);

        $this->rotateEdge($cube, $turn);

        return $this->sendResponse(new CubeResource($cube), 'Cube rotated successfully.');

    }


    public function rotateEdge($cube, $turn)
    {
        if ($turn == 'left' || $turn == 'right') {
            $y = ($turn == 'left') ?  1 : 3;

            $rotation_data = $cube->getRotationData($y);

            foreach ($rotation_data['front_column'] as $key => $cell) {
                $this->updateCell($cell->id, $rotation_data['bottom_column'][$key]->face_id, $rotation_data['bottom_x_coordinates'][$key]);
            }

            foreach ($rotation_data['bottom_column'] as $key => $cell) {
                $this->updateCell($cell->id, $rotation_data['back_column'][$key]->face_id, $rotation_data['back_x_coordinates'][$key]);
            }

            foreach ($rotation_data['back_column'] as $key => $cell) {
                $this->updateCell($cell->id, $rotation_data['top_column'][$key]->face_id, $rotation_data['top_x_coordinates'][$key]);
            }
            foreach ($rotation_data['back_column'] as $key => $cell) {
                $this->updateCell($cell->id, $rotation_data['front_column'][$key]->face_id, $rotation_data['front_x_coordinates'][$key]);
            }
        }

    }

    public function updateCell($old_cell_id, $face_id, $x)
    {
        $old_cell = Cell::find($old_cell_id);

        $old_cell->update([
            'x_coordinate' => $x,
            //'y_coordinate' => $new_y,
            'face_id' => $face_id
        ]);

    }

}
