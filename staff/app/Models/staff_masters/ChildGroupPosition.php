<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class ChildGroupPosition extends Model{
    use HasFactory, Uuid;
    protected $table="master_child_group_position";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'child_group_id',
        'position_title_id',
        'superstructure_id',
        'code',
        'status',
        'description',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
