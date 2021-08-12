<?php

namespace App\Models\spms;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_evaluation";
    protected $fillable = [
        'id',
        'org_id',
        'spm_domain_subcat_id',
        'status',
        'deo_remarks',
        'school_remarks',
        'deo_review_remarks',
        'emd_remarks',
        'created_by'
    ];
}
