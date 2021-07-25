<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassAssessmentFrequency extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_class_assessment_frequency";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_class_id',
        'org_stream_id', 
        'class_stream',
        'aca_assmt_frequency_id',
        'aca_assmnt_type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
