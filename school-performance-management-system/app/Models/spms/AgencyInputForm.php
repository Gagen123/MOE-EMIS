<?php

namespace App\Models\spms;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyInputForm extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_agency_input";
    protected $fillable = [
        'id',
        'org_division_id',
        'input',
        'input_year',
        'activity',
        'output',
        'created_by'
    ];
}
