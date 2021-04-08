<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\ElectricitySource;
use Illuminate\Support\Facades\DB;

class ElectricitySourceController extends Controller
{
    use ApiResponser;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update disaster type
    */
    public function saveElectricitySource(Request $request){

        //return($request['disasterName']);
        $id = $request->id;
        if( $id != null){
            $src = [
                'name'          => $request['sourceName'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $data = ElectricitySource::find($request['id']);
            $messs_det='sourceName:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL system_admin.emis_audit_proc('organization_db','electricity_sources','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
            $source = ElectricitySource::where('id', $id)->update($src);
            return $this->successResponse($source, Response::HTTP_CREATED);
        }else{

            $dis = [
                'name'          => $request['sourceName'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $disaster = ElectricitySource::create($dis);
            return $this->successResponse($disaster, Response::HTTP_CREATED);
        }
    }

     /**
     * method to list disaster type
    */
    
    public function loadElectricitySource(){
        $loadElectricitySource = ElectricitySource::all();
        return $loadElectricitySource;
    }
}
