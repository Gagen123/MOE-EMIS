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
        'OrgId',
        'CeaTrainingId',
        'CeaProgrammeId',
        'TrainingTypeName',
        'Place',
        'CmnCountryId',
        'FromDate',
        'ToDate',
        'DetailsOfTraining',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
