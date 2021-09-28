<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class PositionSubLevel extends Model{
    use HasFactory, Uuid;
    protected $table="master_stf_position_sub_level";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'description',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
