<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="application_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','proposedName','category','levelId','dzongkhagId','gewogId','chiwogId','locationId',
        'isGeopoliticallyLocated','isSenSchool','parentSchoolId','isColocated','status',
        'applicationNo', 'service','organizationId','reason','remark','year',
        'created_by','updated_by','updated_remarks','isfeedingschool','feeding'
    ];
}
