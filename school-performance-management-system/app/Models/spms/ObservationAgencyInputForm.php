<?php

namespace App\Models\spms;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservationAgencyInputForm extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_agency_input_observation";
    protected $fillable = [
        'id',
        'agency_input_id',
        'dzon_id',
        'org_id',
        'observation',
        'recommendation',
        'recommendation_date',
        'created_by'
    ];
}
