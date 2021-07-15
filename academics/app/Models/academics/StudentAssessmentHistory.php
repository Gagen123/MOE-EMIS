<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssessmentHistory extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_std_assmnt_history";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_id',
        'org_class_id',
        'org_stream_id',
        'org_section_id',
        'aca_sub_id',
        'aca_assmt_term_id',
        'class_stream_section',
        'finalized_date',
        'finalized',
        'std_student_id',
        'aca_assmt_area_id',
        'aca_rating_type_id',
        'score',
        'descriptive_score',
        'remarks',
        'recorded_for',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
