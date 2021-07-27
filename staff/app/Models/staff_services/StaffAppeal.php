<?php

namespace App\Models\staff_services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class StaffAppeal extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="staff_appeals";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'transferType',
        'name',
        'application_no',
        'description',
        'user_id',
        'org_id',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

}
