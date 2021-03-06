<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectAssessmentHistory extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_class_sub_assmnt_history";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'aca_assmt_term_id',
        'aca_sub_id',
        'org_class_id',
        'org_stream_id',
        'aca_assmt_area_id',
        'class_stream',
        'weightage',
        'display_order',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'recorded_for'
    ];
}
