<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationDisasterRisk extends Model
{
    use HasFactory, Uuid;
    protected $table="location_disaster_risks";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','locationId','disasterTypeId','created_by','updated_by'
    ];
}
