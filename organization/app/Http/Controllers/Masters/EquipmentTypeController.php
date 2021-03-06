<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\EquipmentType;  
use App\Models\Masters\FurnitureType; 

use Illuminate\Support\Facades\DB;

class EquipmentTypeController extends Controller
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
                'id'            => $request['id'],
                'name'          => $request['equipmentTypeName'],
                'description'   =>  $request['description'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];
           // dd( $equ);
            $data = EquipmentType::find($request['id']);

            $messs_det='equipmentTypeName:'.$data->name.'; description:'.$data->description.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
          //  $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','equipment_type','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            $equipment = EquipmentType::where('id', $id)->update($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);
        }else{
            $equ = [
                'name'          => $request['equipmentTypeName'],
                'description'    =>  $request['description'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $equipment= EquipmentType::create($equ);
            return $this->successResponse($equipment, Response::HTTP_CREATED);
        }
    }

    public function saveFurnitureType(Request $request){

        $id = $request->id;
        if( $id != null){
            $fur = [
                'id'            => $request['id'],
                'name'          => $request['name'],
                'description'   =>  $request['description'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];
           // dd( $equ);
            $data = FurnitureType::find($request['id']);

            $messs_det='name:'.$data->name.'; description:'.$data->description.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
          //  $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('organization_db','equipment_type','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
            $furniture = FurnitureType::where('id', $id)->update($fur);
            return $this->successResponse($furniture, Response::HTTP_CREATED);
        }else{
            $fur = [
                'name'                  => $request['name'],
                'description'           => $request['description'],
                'status'                => $request['status'],
                'created_by'            => $request['user_id'],
                'created_at'            => date('Y-m-d h:i:s'),
            ];
         //   dd( $fur);
            $furniture= FurnitureType::create($fur);
            return $this->successResponse($furniture, Response::HTTP_CREATED);
        }
    }
    public function loadFurnitureType(){
        $strFacility = FurnitureType::all();
        return $strFacility;
    }

}
