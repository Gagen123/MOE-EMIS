<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAssessmentFrequencyHistory extends Model
{
    use HasFactory, Uuid;
    protected $table = "aca_class_assmnt_frequency_history";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_class_id',
        'org_stream_id',
        'class_stream',
        'aca_assmt_frequency_id',
        'transcript_format',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'recorded_for'
    ];
}
