<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SportFacilitySubtype extends Model
{
    use HasFactory, Uuid;
    protected $table="sport_facility_subtypes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','sportFacilityId','name','description','status','created_by','updated_by'
    ];
}
