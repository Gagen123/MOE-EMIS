<?php

namespace App\Models\Students;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeaTrainingParticipant extends Model
{
    use HasFactory,Uuid;
    protected $table="cea_student_training_participant";
    protected $fillable = [
        'id',
        'OrgId',
        'CeaStudentTrainingId',
        'StdStudentId',
        'Remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
