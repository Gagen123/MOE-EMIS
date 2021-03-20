<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Locations;


class LocationsController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function saveLocation(Request $request){
        $location = [
            'organizationId'        =>  $request['organizationId'],
            'landOwnership'         =>  $request['landOwnership'],
            'compoundFencing'       =>  $request['compoundFencing'],
            'entranceGate'          =>  $request['entranceGate'],
            'longitude'             =>  $request['longitude'],
            'latitude'              =>  $request['latitude'],
            'altitude'              =>  $request['altitude'],
            'thramNo'               =>  $request['thramNo'],
            'cid'                   =>  $request['cid'],
            'name'                  =>  $request['name'],
            'compoundArea'          =>  $request['compoundArea'],
        ];
        $loc = Locations::create($location);
        return $this->successResponse($loc, Response::HTTP_CREATED);
    }
}
