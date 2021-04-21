<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Masters\ElectricitySupply;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class ElectricitySupplyController extends Controller
{
    use ApiResponser;
    public $audit_database;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
    }

    /** 
     * method to save or update disaster type
    */
    public function saveElectricitySupply(Request $request){
        //return($request['disasterName']);
        $id = $request->id;
        if( $id != null){
            $src = [
                'name'          => $request['supplyName'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $data = ElectricitySupply::find($request['id']);
            $messs_det='supplyName:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','electricity_supply','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
            $source = ElectricitySupply::where('id', $id)->update($src);
            return $this->successResponse($source, Response::HTTP_CREATED);
        }else{

            $src = [
                'name'          => $request['supplyName'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];
            $source = ElectricitySupply::create($src);
            return $this->successResponse($source, Response::HTTP_CREATED);
        }
    }

     /**
     * method to list disaster type
    */
    
    public function loadElectricitySupply(){
        $loadElectricitySupply = ElectricitySupply::all();
        return $loadElectricitySupply;
    }
}
