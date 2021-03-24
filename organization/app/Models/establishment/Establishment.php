<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Establishment extends Model
{
    use HasFactory, Uuid;
    protected $table="establishments";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','proposedName','category','levelId','dzongkhagId','gewogId','chiwogId','locationId',
        'isGeopoliticallyLocated','isSenSchool','parentSchoolId','isColocated','cid',
        'fullName','phoneNo','email','statusId','applicationNo','created_by','updated_by'
    ];
}
