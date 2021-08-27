<?php

namespace App\Models\spms;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionAgencyInformForm extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_agency_input_revision";
    protected $fillable = [
        'id',
        'agency_input_id',
        'agency_input_obs_id',
        'action_taken',
        'action_taken_date',
        'created_by'
    ];
}
