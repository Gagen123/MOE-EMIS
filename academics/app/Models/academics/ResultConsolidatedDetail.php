<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResultConsolidatedDetail extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_result_consolidated_detail";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'aca_result_consolidated_id',
        'std_student_id',
        'result',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
