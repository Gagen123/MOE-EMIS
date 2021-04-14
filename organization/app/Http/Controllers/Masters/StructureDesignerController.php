<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\StructureDesigner;
use Illuminate\Support\Facades\DB;

class StructureDesignerController extends Controller
{
    use ApiResponser;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update disaster type
    */
    public function saveStructureDesigner(Request $request){

        //return($request['disasterName']);
        $id = $request->id;
        if( $id != null){
            $src = [
                'name'          => $request['designerName'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $data = StructureDesigner::find($request['id']);
            $messs_det='designerName:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL system_admin.emis_audit_proc('organization_db','structure_designers','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
            $source = StructureDesigner::where('id', $id)->update($src);
            return $this->successResponse($source, Response::HTTP_CREATED);
        }else{

            $dis = [
                'name'          => $request['designerName'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $disaster = StructureDesigner::create($dis);
            return $this->successResponse($disaster, Response::HTTP_CREATED);
        }
    }

    /**
     * method to list disaster type
    */
    
    public function loadStructureDesigner(){
        $loadStructureDesigner = StructureDesigner::all();
        return $loadStructureDesigner;
    }
}
