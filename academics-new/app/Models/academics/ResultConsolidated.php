<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResultConsolidated extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_result_consolidated";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_id',
        'class_stream_section',
        'org_class_id',
        'org_stream_id',
        'org_section_id',
        'aca_assmt_term_id',
        'finalized',
        'finalized_date',
        'published',
        'published_date',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
