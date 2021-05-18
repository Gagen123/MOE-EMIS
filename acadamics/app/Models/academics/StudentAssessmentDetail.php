<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAssessmentDetail extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_student_assessment_detail";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'aca_student_assmt_id',
        'std_student_id',
        'aca_assmt_area_id',
        'aca_rating_type_id',
        'score',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
