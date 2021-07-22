<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_domain";
    protected $fillable = [
        'id',
        'name',
        'code',
        'status',
        'created_by'
    ];
}
