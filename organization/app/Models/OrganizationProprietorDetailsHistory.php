<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationProprietorDetailsHistory extends Model
{
    use HasFactory;
    protected $table="organization_proprietor_details_history";
    protected $fillable = [
        'record_id',
        'id',
        'organizationId',
        'cid',
        'fullName',
        'phoneNo',
        'mobileNo',
        'email',
        'created_by',
        'updated_by',
        'recorded_on',
        'recorded_by'
    ];
}
