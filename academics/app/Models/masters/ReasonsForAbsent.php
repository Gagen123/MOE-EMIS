<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonsForAbsent extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_absence_reason";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'status',
        'created_by',
        'created_at',
        'updated_by',
    ];
        
}
