<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAssessment extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_student_assessment";
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
        'finalized',
        'finalized_date',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
    
}
