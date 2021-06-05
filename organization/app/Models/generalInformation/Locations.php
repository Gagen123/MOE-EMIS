<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locations extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_locations";
    protected $fillable = [
        'id','organizationId','entranceGate','longitude','latitude','altitude',
        'thramNo','googleMapPath','climate_type','distance_from_dzo','fencingtypeId','disasterArea','created_by','updated_by'
    ];
}
