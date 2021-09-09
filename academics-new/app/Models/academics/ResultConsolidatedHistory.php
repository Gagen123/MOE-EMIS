<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultConsolidatedHistory extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_result_consolidated";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_id',
        'org_class_id',
        'org_stream_id',
        'org_section_id',
        'aca_assmt_term_id',
        'finalized',
        'finalized_date',
        'published',
        'published_date',
        'std_student_id',
        'result',
        'remarks',
        'recorded_for',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
      
    ];
}
