<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacherHistory extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_sub_teacher_history";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_id',
        'org_class_id',
        'org_stream_id',
        'org_section_id',
        'class_stream_section',
        'aca_sub_id',
        'stf_staff_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'recorded_for'

    ];
}
