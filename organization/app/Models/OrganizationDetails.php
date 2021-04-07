<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','code','category','levelId','dzongkhagId','gewogId','chiwogId',
        'locationId','isGeopoliticallyLocated','isSenSchool','parentSchoolId','isColocated',
        'cid', 'fullName','phoneNo','email','status', 'created_by','updated_by'
    ];
}
