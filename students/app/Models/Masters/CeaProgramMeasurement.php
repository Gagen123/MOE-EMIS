<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramMeasurement extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_program_measurement";

    protected $fillable = [
        'id',
        'name', 
        'description', 
        'status'
    ];
}
