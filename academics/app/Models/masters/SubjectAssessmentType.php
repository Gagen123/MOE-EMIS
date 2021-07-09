<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectAssessmentType extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_class_subject";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_class_id',
        'org_stream_id',
        'aca_sub_id',
        'show_in_result',
        'aca_rating_type_id',
        'class_stream',
        'pass_score',
        'is_elective',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
