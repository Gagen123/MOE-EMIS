<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaProgramMeasurement extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_programme_measurement";

    protected $fillable = [
        'id',
        'Name', 
        'Description', 
        'Code',
        'Status'
    ];
}
