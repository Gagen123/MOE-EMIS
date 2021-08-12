<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_indicator";
    protected $fillable = [
        'id',
        'name',
        'spm_parameter_id',
        'sequence_no',
        'status',
        'created_by'
    ];
}
