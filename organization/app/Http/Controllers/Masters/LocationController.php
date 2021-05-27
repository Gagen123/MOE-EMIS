<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\Location;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    use ApiResponser;
    public $audit_database;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
    }

    /**
     * method to list location type
    */
    
    public function loadLocation(){
        $location = Location::all();
        return $location;
        // return $this->successResponse($location);
    }

    /** 
     * method to save or update disaster type
    */
    public function saveLocation(Request $request){

        $id = $request->id;

        if( $id != null){
            $loc = [
                'name'          => $request['locationName'],
                'description'   => $request['description'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $data = Location::find($request['id']);

            $messs_det='locationName:'.$data->name.'; description:'.$data->description.';status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','location','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            
            $location = Location::where('id', $id)->update($loc);
            return $this->successResponse($location, Response::HTTP_CREATED);
        }else{

            $loc = [
                'name'          => $request['locationName'],
                'description'   => $request['description'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $location = Location::create($loc);
            return $this->successResponse($location, Response::HTTP_CREATED);
        }
    }
}
