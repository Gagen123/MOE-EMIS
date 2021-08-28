<?php

namespace App\Models\spms;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_evaluation_detail";
    protected $fillable = [
        'id',
        'spm_indicator_id',
        'spm_evaluation_id',
        'score',
        'remarks',
        'created_by'
    ];
  
}
