<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Locations;
use App\Models\generalInformation\LocationDisasterRisk;
use App\Models\Masters\Disaster;
use Illuminate\Support\Facades\DB;

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
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveLocation(Request $request){
        $disasters =$request->disaster;
        $id = $request->id;
        if($id != null){
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
                'updated_by'            =>  $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
            ];
            $loc = Locations::where('id', $id)->update($location);

            $locationId = DB::table('locations')->orderBy('id','desc')->limit(1)->pluck('id');

            if($disasters != null){
            DB::table('location_disaster_risks')->where('id', $locationId[0])->delete();
                foreach ($disasters as $dis){
                    $disasterRisk = [
                        'locationId'        => $locationId[0],
                        'disasterTypeId'    => $dis,
                        'created_by'        => $request->user_id,
                        'created_at'        => date('Y-m-d h:i:s'),
                        
                    ];
                    $loc = LocationDisasterRisk::create($disasterRisk);
                }
            }
            return $this->successResponse($loc, Response::HTTP_CREATED);

        }else{
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
                'created_by'            =>  $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
            ];
            // dd($location);
            $loc = Locations::create($location);
    
            // $locationId = DB::table('locations')->orderBy('id','desc')->limit(1)->pluck('id');
    
            // if($disasters != null){
            //     foreach ($disasters as $dis){
            //         $disasterRisk = [
            //             'locationId'        => $locationId[0],
            //             'disasterTypeId'    => $dis,
            //             'created_by'        => $request->user_id,
            //             'created_at'        => date('Y-m-d h:i:s'),
                        
            //         ];
            //         $loc = LocationDisasterRisk::create($disasterRisk);
            //     }
            // }
            return $this->successResponse($loc, Response::HTTP_CREATED);
        }
        
    }

    /**
     * method to get disaster in checkbox
     */
    public function getDisasterListInCheckbox(){
        return Disaster::get(['id','name']);
    }
}
