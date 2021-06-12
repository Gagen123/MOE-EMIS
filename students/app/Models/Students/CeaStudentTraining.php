<?php

namespace App\Models\Students;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeaStudentTraining extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_student_training";

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
