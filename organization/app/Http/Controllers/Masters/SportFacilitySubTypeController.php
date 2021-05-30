<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\SportFacilitySubtype;
use Illuminate\Support\Facades\DB;

class SportFacilitySubTypeController extends Controller
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
     * method to save or update sport facility sub type
    */
    public function saveSportFacilitySubtype(Request $request){
        $id = $request->id;

        if( $id != null){
            $spo = [
                'sportFacilityId'        => $request['sportFacility'],
                'name'                   => $request['subtypeName'],
                'status'                 => $request['status'],
                'updated_by'             => $request['user_id'],
                'created_at'             => date('Y-m-d h:i:s'),
            ];

            $data = SportFacilitySubtype::find($request['id']);

            $messs_det='sportFacility:'.$data->sportFacility.'; name:'.$data->subtypeName.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','sport_facility_subtypes','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            
            $sportSubtype = SportFacilitySubtype::where('id', $id)->update($spo);
            return $this->successResponse($sportSubtype, Response::HTTP_CREATED);
        }else{

            $spo = [
                'sportFacilityId'        => $request['sportFacility'],
                'name'                   => $request['subtypeName'],
                'status'                 => $request['status'],
                'updated_by'             => $request['user_id'],
                'created_at'             => date('Y-m-d h:i:s'),
            ];
            $sportSubtype = SportFacilitySubtype::create($spo);
            return $this->successResponse($sportSubtype, Response::HTTP_CREATED);
        }
    }

    /**
     * method to list sport subtype
    */
    
    public function loadSportFacilitySubtype(){
        $subCategory = DB::table('sport_facility_subtypes as a')
            ->join('sport_facility_type as b', 'b.id', '=', 'a.sportFacilityId')
            ->select('a.id as id', 'a.name','a.status',
            'b.name as sportFacility','a.sportFacilityId')->get();
        return $subCategory;
    }

}
