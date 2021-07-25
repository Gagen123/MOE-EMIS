<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructionalDaysForSpecialCase extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_instructional_days_special_case";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_id',
        'org_class_id',
        'org_stream_id',
        'org_section_id',
        'org_class_stream_id',
        'class_stream_section',
        'std_student_id',
        'aca_assmt_term_id',
        'instructional_days',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'recorded_for'
    ];
}
