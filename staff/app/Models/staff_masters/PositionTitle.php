<?php

namespace App\Models\staff_masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class PositionTitle extends Model{
    use HasFactory, Uuid;
    protected $table="master_stf_position_title";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'sub_group_id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function submajorgroup() {
        return $this->belongsTo(StaffSubMajorGrop::class, 'sub_group_id');
    }
}
