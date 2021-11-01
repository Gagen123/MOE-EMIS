<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class MgmnDesignation extends Model{
    use HasFactory, Uuid;
    protected $table="master_mgmn_designation";
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
