<?php

namespace App\Models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class AssessmentArea extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_assessment_area";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'aca_sub_id',
        'aca_rating_type_id',
        'name',
        'dzo_name',
        'code',
        'display_order',
        'status', 
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
    
}
