<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DzongkhagEMO extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_dzo_emo";
    protected $fillable = [
        'id',
        'dzon_id',
        'staff_id',
        'created_by'
    ];
}
