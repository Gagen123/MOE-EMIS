<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_parameter";
    protected $fillable = [
        'id',
        'name',
        'spm_area_id',
        'code',
        'status',
        'created_by'
    ];
}
