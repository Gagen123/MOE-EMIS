<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDEO extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_school_deo";
    protected $fillable = [
        'id',
        'org_id',
        'staff_id',
        'dzon_id',
        'created_by'
    ];
}
