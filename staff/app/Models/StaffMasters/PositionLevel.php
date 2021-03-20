<?php

namespace App\Models\StaffMasters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class PositionLevel extends Model
{
    use HasFactory, Uuid;
    protected $table="stf_position_level";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
