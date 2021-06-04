<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssessmentFrequency extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_assessment_frequency";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'display_order',
        'status', 
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
