<?php

namespace App\Models\Masters;

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
        'Name',
        'CeaTrainingId',
        'CeaProgrammeId',
        'Description', 
        'Status'
    ];
}
