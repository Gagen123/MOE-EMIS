<?php

namespace App\Models\staff_masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class StaffSubMajorGrop extends Model{
    use HasFactory, Uuid;
    protected $table="master_stf_sub_group";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'group_id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function majorgroup() {
        return $this->belongsTo(StaffMajorGrop::class, 'group_id')->select('id','name');
    }
}
