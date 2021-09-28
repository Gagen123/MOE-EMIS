<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemedialClass extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_remedial_classes";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_id',
        'org_class_id',
        'org_stream_id',
        'org_section_id',
        'aca_sub_id',
        'stf_staff_id',
        'class_stream_section',
        'from_date',
        'to_date',
        'total_no_of_hours',
        'time',
        'std_student_id',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
