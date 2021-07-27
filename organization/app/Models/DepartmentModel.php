<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartmentModel extends Model{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="master_department";
    protected $fillable = [
        'id',
        'dzo_id',
        'name',
        'description',
        'type',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
