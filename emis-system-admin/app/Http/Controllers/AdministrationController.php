<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GlobalMasters\Country;
use App\Models\GlobalMasters\Dzongkhag;

class AdministrationController extends Controller{
    use ApiResponser;
    public $database="emis_system_admin";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function save_global_masters(Request $request){
        if($request->record_type=="country"){
            if($request->actiontype=="add"){
                $rule =[
                    'name'      => 'required|string|unique:country_master,country_name',
                    'nationality'  =>  'required|unique:country_master,nationality',
                    'status'        =>  'required',
                ];
                $validate=$this->validate($request, $rule); 
                $data =[
                    'country_name'  =>  $request['name'],
                    'nationality'  =>  $request['nationality'],
                    'code'  =>  $request['code'],
                    'status'    =>  $request['status'],
                    'created_by'=>  $request['user_id'],
                    'created_at'=>  date('Y-m-d h:i:s'),
                ];
                $country = Country::create($data);
                return $this->successResponse($country, Response::HTTP_CREATED);
            }
            if($request->actiontype=="edit"){
                $data = Country::find($request['id']);
                $messs_det='country name:'.$data->country_name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                $procid=DB::select("CALL emis_audit_proc('".$this->database."','country_master','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                $data->country_name = $request['name'];
                $data->nationality = $request['nationality'];
                $data->status = $request['status'];
                $data->updated_by = $request['user_id'];
                $data->updated_at = date('Y-m-d h:i:s');
                $data->update();
                return $this->successResponse($data);
            }

        }
        if($request->record_type=="dzongkhag"){
            if($request->actiontype=="add"){
                $rule =[
                    'name'      => 'required|string|unique:dzongkhag_master,name',
                    'code'  =>  'required|unique:dzongkhag_master,code',
                    'status'        =>  'required',
                ];
                
                $validate=$this->validate($request, $rule);
                $data =[
                    'name'  =>  $request['name'],
                    'code'  =>  $request['code'],
                    'status'    =>  $request['status'],
                    'created_by'=>  $request['user_id'],
                    'created_at'=>  date('Y-m-d h:i:s'),
                ];
                $country = Dzongkhag::create($data);
                return $this->successResponse($country, Response::HTTP_CREATED);
            }
            if($request->actiontype=="edit"){
                $data = Dzongkhag::find($request['id']);
                $messs_det='country name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                $procid=DB::select("CALL emis_audit_proc('".$this->database."','dzongkhag_master','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                $data->name = $request['name'];
                $data->code = $request['code'];
                $data->status = $request['status'];
                $data->updated_by = $request['user_id'];
                $data->updated_at = date('Y-m-d h:i:s');
                $data->update();
                return $this->successResponse($data);
            }
        }
        
    }
    public function load_global_masters($param=""){
        if($param=="all_country"){
            return $this->successResponse(Country::all());
        }
        if($param=="all_dzongkhag"){
            return $this->successResponse(Dzongkhag::all());
        }
    }
    
}
