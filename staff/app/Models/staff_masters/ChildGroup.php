<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class ChildGroup extends Model{
    use HasFactory, Uuid;
    protected $table="master_child_group";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'sub_group_id',
        'name',
        'code',
        'status',
        'description',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function submajorgroup(){
        return $this->belongsTo(StaffSubMajorGrop::class, 'sub_group_id')->select('id','group_id','name');
    }
}
