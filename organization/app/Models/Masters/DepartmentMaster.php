<?php

namespace App\Models\Masters;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartmentMaster extends Model{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="master_department";

    protected $fillable = [
        'id','name','dzo_id','code', 'description', 'status','type','created_by','updated_by','created_at','updated_at'
    ];
}
