<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\EquipmentType;
use Illuminate\Support\Facades\DB;

class EquipmentTypeController extends Controller
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
     * method to list equipment type
    */
    
    public function loadEquipmentType(){
        $strFacility = EquipmentType::all();
        return $strFacility;
    }

    /** 
     * method to save or update level type
    */
    public function saveEquipmentType(Request $request){

        $id = $request->id;
        if( $id != null){
            $equ = [
                'name'          => $request['equipmentTypeName'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];
            $data = EquipmentType::find($request['id']);

            $messs_det='equipmentTypeName:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL system_admin.emis_audit_proc('organization_db','equipment_type','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            $equipment = EquipmentType::where('id', $id)->update($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);
        }else{
            $equ = [
                'name'          => $request['equipmentTypeName'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $equipment= EquipmentType::create($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);
        }
    }

}
