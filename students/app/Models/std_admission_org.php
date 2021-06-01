<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class std_admission_org extends Model
{
    //std_admission_orgs

    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="std_admission_orgs";
    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'std_admission_id',
        'date_of_application',
        'std_decission',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'

    ];
}
