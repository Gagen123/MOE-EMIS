<?php

namespace App\Models\Students;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeaTrainingParticipant extends Model
{
    use HasFactory,Uuid;
    protected $table="cea_student_training_participant";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'CeaStudentTrainingId',
        'StdStudentId',
        'Remarks',
    ];
}
