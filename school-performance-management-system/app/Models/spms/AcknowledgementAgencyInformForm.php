<?php

namespace App\Models\spms;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcknowledgementAgencyInformForm extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_agency_input_acknowlegement";
    protected $fillable = [
        'id',
        'agency_input_id',
        'org_id',
        'acknowledgement',
        'created_by'
    ];
}
