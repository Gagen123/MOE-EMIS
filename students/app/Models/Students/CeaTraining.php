<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaTraining extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_training";

    protected $fillable = [
        'id',
        'CeaTrainingTypeId',
        'name',
        'CeaTrainingId',
        'CeaProgrammeId',
        'place',
        'country_id',
        'FromDate',
        'ToDate',
        'Place',
        'Description',
        'Status'
    ];
}
