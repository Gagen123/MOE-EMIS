<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectMappingForTre extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_subject_mapping_for_tre";
    protected $fillable = [
        'id',
        'org_class_id',
        'org_stream_id',
        'aca_sub_id',
        'aca_teacher_sub_id',
        'class_stream',
        'standard_hours',
        'standard_minutes',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
