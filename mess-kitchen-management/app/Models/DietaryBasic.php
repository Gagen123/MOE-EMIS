<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DietaryBasic extends Model{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="dietary_basic_info";
    protected $fillable = [
        'id',
        // 'date',
        // 'score',
        'average_score',
        'prepared_by',
        'endrosed_by',
        'organizationId',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
