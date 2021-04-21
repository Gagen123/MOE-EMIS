<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory, Uuid;
    protected $table="master_stf_marital_status";
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
