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
        'spm_domain_category_id',
        'name',
        'sequence_no',
        'status',
        'created_by'
    ];
}
