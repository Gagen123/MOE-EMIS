<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\ContactType;
use Illuminate\Support\Facades\DB;

class ContactTypeController extends Controller
{
    use ApiResponser;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update disaster type
    */
    public function saveContactType(Request $request){

        //return($request['disasterName']);
        $id = $request->id;
        if( $id != null){
            $src = [
                'name'          => $request['contactName'],
                'status'        => $request['status'],
                'updated_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $data = ContactType::find($request['id']);
            $messs_det='contactName:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL system_admin.emis_audit_proc('organization_db','contact_types','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
            $source = ContactType::where('id', $id)->update($src);
            return $this->successResponse($source, Response::HTTP_CREATED);
        }else{

            $dis = [
                'name'          => $request['contactName'],
                'status'        => $request['status'],
                'created_by'    =>$request['user_id'],
                'created_at'    =>date('Y-m-d h:i:s'),
            ];

            $disaster = ContactType::create($dis);
            return $this->successResponse($disaster, Response::HTTP_CREATED);
        }
    }

    /**
     * method to list disaster type
    */
    
    public function loadContactType(){
        $loadContactType = ContactType::all();
        return $loadContactType;
    }

}
