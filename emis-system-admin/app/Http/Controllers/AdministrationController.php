<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\global_masters\Country;
use App\Models\global_masters\Dzongkhag;
use App\Models\global_masters\Gewog;
use App\Models\global_masters\Village;
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
        if($request->record_type=="dzongkhag" || $request->record_type=="gewog" || $request['record_type']=="village"){
            if($request->actiontype=="add"){
                $table="";
                if($request->record_type=="dzongkhag"){
                    $table="dzongkhag_master";
                }
                if($request->record_type=="gewog"){
                    $table="gewog_master";
                }
                if($request->record_type=="village"){
                    $table="village_master";
                }
                $rule =[
                    'name'      => 'required|string|unique:'.$table,
                    'code'      =>  'required|unique:'.$table,
                    'status'    =>  'required',
                ];
                $validate=$this->validate($request, $rule);
                $data =[
                    'name'          =>  $request['name'],
                    'dzongkhag_id'  =>  $request['parent_field'],
                    'gewog_id'  =>  $request['parent_field'],
                    'code'          =>  $request['code'],
                    'status'        =>  $request['status'],
                    'created_by'    =>  $request['user_id'],
                    'created_at'    =>  date('Y-m-d h:i:s'),
                ];
                $response_dat="";
                if($request->record_type=="dzongkhag"){
                    $response_data = Dzongkhag::create($data);
                }
                if($request->record_type=="gewog"){
                    $response_data = Gewog::create($data);
                }
                if($request->record_type=="village"){
                    $response_data = Village::create($data);
                }
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            if($request->actiontype=="edit"){
                $data="";
                $table="";
                $aditionla_param="; ";
                if($request->record_type=="dzongkhag"){
                    $data = Dzongkhag::find($request['id']);
                    $table="dzongkhag_master";
                }
                if($request->record_type=="gewog"){
                    $data = Gewog::find($request['id']);
                    $table="gewog_master";
                    $aditionla_param="; dzo_id: ".$data->dzongkhag_id;
                }
                if($request->record_type=="village"){
                    $data = Village::find($request['id']);
                    $table="village_master";
                    $aditionla_param="; gewog_id: ".$data->gewog_id;
                }
                $messs_det='name:'.$data->name.$aditionla_param.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                $procid=DB::select("CALL emis_audit_proc('".$this->database."','".$table."','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                $data->name         = $request['name'];
                if($request->record_type=="gewog"){
                    $data->dzongkhag_id = $request['parent_field'];
                }
                if($request->record_type=="village"){
                    $data->gewog_id = $request['parent_field'];
                }
                $data->code         = $request['code'];
                $data->status       = $request['status'];
                $data->updated_by   = $request['user_id'];
                $data->updated_at   = date('Y-m-d h:i:s');
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
        if($param=="all_active_dzongkhag"){
            return $this->successResponse(Dzongkhag::where('status','1')->get());
        }
        if($param=="all_gewog_List"){
            return $this->successResponse(Gewog::with('dzongkhag')->get());
        }
        
        if($param=="all_village_List"){
            return $this->successResponse(Village::with('dzothroughgewog','gewog')->get());
        }
    }
    public function load_dropdown($model="",$parent_id=""){
        if($model=="dzongkhag"){
            return $this->successResponse(Gewog::where('dzongkhag_id',$parent_id)->get());
        }
    }
    
}
