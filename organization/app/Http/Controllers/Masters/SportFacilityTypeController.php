<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\SportFacilityType;
use Illuminate\Support\Facades\DB;


class SportFacilityTypeController extends Controller
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
    
    public function loadSportFacility(){
        $location = SportFacilityType::all();
        return $location;
    }
    /** 
     * method to save or update level type
    */
    public function saveSportFacility(Request $request){

        $id = $request->id;
        if( $id != null){
            $equ = [
                'name'          => $request['sportFacilityName'],
                'description'   => $request['description'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];
            $data = SportFacilityType::find($request['id']);

            $messs_det='sportFacilityName:'.$data->name.';description:'.$data->description.';  status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','sport_facility_type','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");

            $equipment = SportFacilityType::where('id', $id)->update($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);
        }else{
            $equ = [
                'name'          => $request['sportFacilityName'],
                'description'   => $request['description'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $equipment= SportFacilityType::create($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);
        }
    }
}
