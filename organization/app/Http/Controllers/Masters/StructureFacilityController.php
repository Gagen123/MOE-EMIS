<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\StructureFacility;
use Illuminate\Support\Facades\DB;

class StructureFacilityController extends Controller
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

    /**
     * method to list structure facility type
    */
    
    public function loadStructureFacility(){
        $strFacility = StructureFacility::all();
        return $strFacility;
    }

    /** 
     * method to save or update level type
    */
    public function saveStructureFacility(Request $request){

        $id = $request->id;
        if( $id != null){
            $str = [
                'name'          => $request['structureFacilityName'],
                'description'   => $request['description'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $data = StructureFacility::find($request['id']);

            $messs_det='structureFacilityName:'.$data->name.'; description:'.$data->description.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL system_admin.emis_audit_proc('organization_db','structure_facility','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");

            $strFacility = StructureFacility::where('id', $id)->update($str);
            return $this->successResponse($strFacility, Response::HTTP_CREATED);
        }else{
            $strFacility = [
                'name'          => $request['structureFacilityName'],
                'description'   => $request['description'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $str= StructureFacility::create($strFacility);
            return $this->successResponse($str, Response::HTTP_CREATED);
        }
    }
}
