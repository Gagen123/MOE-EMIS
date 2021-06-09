<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VariousConnectivity extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="various_connectivity";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizationId',
        'connectedtoroad',
        'road_typeyes',
        'road_typeno',
        'hqdistance',
        'connectedtointernet',
        'connectiontype',
        'serviceprovider',
        'speedbandwidth',
        'DrukREN',
        'GovNET',
        'independent',
        'sharedconnection',
        'connectionsharedtype',
        // 'sharedspeed',
        'internetAccessible',
        'electricity',
        'electricitysubstation',
        'electricitysource',           
        'created_by',
        'created_at',
 
    ];

}
