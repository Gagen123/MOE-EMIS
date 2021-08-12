<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_area";
    protected $fillable = [
        'id',
        'name',
        'spm_domain_id',
        'sequence_no',
        'status',
        'created_by'
    ];
}
