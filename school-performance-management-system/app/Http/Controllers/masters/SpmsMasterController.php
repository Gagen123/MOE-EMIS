<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use App\Models\masters\Domain;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SpmsMasterController extends Controller
{
    use ApiResponser;

    public $audit_table="system_db";

    public $database="spms_db";
    
    public function saveSpmMasters(Request $request){
        if($request['record_type'] == 'domain') {
            if($request['action_type'] =="add"){
                $rules = [
                    'name' =>'required|unique:spm_domain',
                    'code'   => 'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'code.required'   => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
           
                $this->validate($request, $rules, $customMessages);
                $data = [
                    'name' => $request['name'],
                    'code' => $request['code'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                ];
              $responsedata= Domain::create($data);
            }
            if($request['action_type']=="edit"){
                $rules = [
                    'name' =>'required',
                    'code'   => 'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'code.required'   => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                
                $this->validate($request, $rules,  $customMessages);
                $data = Domain::find($request['id']);
                $messs_det='name:'.$data->name.'; code:'.$data->code.'; status'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_domain','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->name = $request['name'];
                $data->code = $request['code'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        return $this->successResponse($responsedata, Response::HTTP_CREATED);
    }
    public function loadSpmMasters($param=""){
        if($param == "all_domain"){
            $domain = DB::select('SELECT id,name,code,status FROM spm_domain');
            return $this->successResponse($domain);
        }
        if($param == "all_active_domain"){
            $domain = DB::select('SELECT id,name,code,status FROM spm_domain WHERE status = 1');
            return $this->successResponse($domain);
        }
    }
}
