<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Masters\Disaster;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class DisasterController extends Controller
{

    use ApiResponser;
    public $audit_database;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
    }
    
    // region public method

    /**
     * method to list disaster type
    */
    
    public function loadDisaster(){
        $disaster = Disaster::all();
        return $disaster;
    }

    /** 
     * method to save or update disaster type
    */
    public function saveDisaster(Request $request){
        //return($request['disasterName']);
        $id = $request->id;
        if( $id != null){
            $dis = [
                'name'          => $request['disasterName'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $data = Disaster::find($request['id']);
            
            $messs_det='disasterName:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','disaster','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
            $disaster = Disaster::where('id', $id)->update($dis);
            return $this->successResponse($disaster, Response::HTTP_CREATED);
        }else{

            $dis = [
                'name'          => $request['disasterName'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $disaster = Disaster::create($dis);
            return $this->successResponse($disaster, Response::HTTP_CREATED);
        }
    }

    //endregion

}
