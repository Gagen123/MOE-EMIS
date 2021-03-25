<?php

namespace App\Models\staff_masters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class WorkingAgency extends Model{
    use HasFactory, Uuid;
    protected $table="master_working_agency";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
