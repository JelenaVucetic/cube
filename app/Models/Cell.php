<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    protected $fillable = [
        'face_id',
        'x_coordinate',
        'y_coordinate',
        'color'
    ];

    public function face()
    {
        return $this->belongsTo(Face::class);
    }
}
