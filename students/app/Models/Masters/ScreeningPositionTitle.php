<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScreeningPositionTitle extends Model
{
    use HasFactory, Uuid;
    protected $table="std_screening_position_title";

    protected $fillable = [
        'id',
        'name',
        'description',
        'status'
    ];
}
