<?php

namespace App\Http\Controllers;

use App\Models\Calender;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\global_masters\Country;
use App\Models\global_masters\Dzongkhag;
use App\Models\global_masters\Gewog;
use App\Models\global_masters\Village;
use App\Models\global_masters\Gender;
use App\Models\global_masters\MotherTongue;
use App\Models\Guidelines;

class AdministrationController extends Controller{
    use ApiResponser;
    public $database="emis_system_admin";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveGlobalMasters(Request $request){
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
                    'nationality'   =>  $request['nationality'],
                    'code'          =>  $request['code'],
                    'status'        =>  $request['status'],
                    'created_by'    =>  $request['user_id'],
                    'created_at'    =>  date('Y-m-d h:i:s'),
                ];
                $country = Country::create($data);
                return $this->successResponse($country, Response::HTTP_CREATED);
            }
            if($request->actiontype=="edit"){
                $data = Country::find($request['id']);
                $messs_det='country name:'.$data->country_name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                $procid=DB::select("CALL emis_audit_proc('".$this->database."','country_master','".$request['id']."','".$messs_det."','".$request->user_id."','Edit')");
                $data->country_name = $request['name'];
                $data->nationality = $request['nationality'];
                $data->status = $request['status'];
                $data->updated_by = $request['user_id'];
                $data->updated_at = date('Y-m-d h:i:s');
                $data->update();
                return $this->successResponse($data);
            }

        }
        if($request->record_type=="dzongkhag" || $request->record_type=="gewog" || $request['record_type']=="village"
        || $request['record_type']=="gender" || $request['record_type']=="mothertongue" || $request['record_type']=="calender"){
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
                if($request->record_type=="gender"){
                    $table="gender_master";
                }
                if($request->record_type=="mothertongue"){
                    $table="mother_tongue_master";
                }
                if($request->record_type!="calender"){
                    $rule =[
                        'name'      => 'required|string|unique:'.$table,
                        'code'      =>  'required|unique:'.$table,
                        'status'    =>  'required',
                    ];
                    $validate=$this->validate($request, $rule);
                }
                $data =[
                    'name'          =>  $request['name'],
                    'dzongkhag_id'  =>  $request['parent_field'],
                    'gewog_id'      =>  $request['parent_field'],
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
                if($request->record_type=="gender"){
                    $response_data = Gender::create($data);
                }
                if($request->record_type=="mothertongue"){
                    $response_data = MotherTongue::create($data);
                }
                if($request->record_type=="calender"){
                    $data =[
                        'year'          =>  $request['year'],
                        'from_date'     =>  $request['from_date'],
                        'to_date'       =>  $request['to_date'],
                        'type'          =>  $request['type'],
                        'remarks'       =>  $request['remarks'],
                        'user_type'     =>  $request['user_type'],
                        'status'        =>  $request['status'],
                        'user_type'     =>  $request['user_type'],
                        'created_by'    =>  $request['user_id'],
                        'created_at'    =>  date('Y-m-d h:i:s'),
                    ];
                    $response_data = Calender::create($data);
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
                if($request->record_type=="gender"){
                    $data = Gender::find($request['id']);
                    $table="gender_master";
                }
                if($request->record_type=="mothertongue"){
                    $data = MotherTongue::find($request['id']);
                    $table="mother_tongue_master";
                }
                if($request->record_type=="calender"){
                    $data = Calender::find($request['id']);
                    $table="master_calender";
                    $messs_det='from_date:'.$data->from_date.'; to_date:'.$data->to_date.'; type:'.$data->type.'; remarks:'.$data->remarks.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                    $procid=DB::select("CALL emis_audit_proc('".$this->database."','".$table."','".$request['id']."','".$messs_det."','".$request->user_id."','Edit')");

                    $data->from_date        = $request['from_date'];
                    $data->to_date          = $request['to_date'];
                    $data->status           = $request['status'];
                    $data->remarks          = $request['remarks'];
                    $data->type             = $request['type'];
                    $data->updated_at       = date('Y-m-d h:i:s');
                    $data->update();
                    return $this->successResponse($data);
                }
                else{
                    //storing audit trials
                    $messs_det='name:'.$data->name.$aditionla_param.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                    $procid=DB::select("CALL emis_audit_proc('".$this->database."','".$table."','".$request['id']."','".$messs_det."','".$request->user_id."','Edit')");
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
        if($request->record_type=="guidelines"){
            if($request->actiontype=="add"){
                $rule =[
                    'guideline_for'      => 'required',
                ];
                $this->validate($request, $rule);
                $guidefor=$request['guideline_for'];
                $response_data="";
                foreach($request['guidelines'] as $guide){
                    $data =[
                        'guideline_for'     =>  $guidefor,
                        'guideline'         =>  $guide['guideline'],
                        'status'            =>  $guide['status'],
                        'display_order'     =>  $guide['display_order'],
                        'created_by'        =>  $request['user_id'],
                        'created_at'        =>  date('Y-m-d h:i:s'),
                    ];
                    try{
                        $response_data = Guidelines::create($data);
                    }catch(\Illuminate\Database\QueryException $ex){
                        dd($ex);

                    }

                }
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }

            if($request->actiontype=="edit"){
                // dd( $request['guideline_for'], $request['name'],$request['id']);
                $data = Guidelines::find($request['id']);
                $messs_det='guideline_for:'.$data->guideline_for.'; guideline:'.$data->guideline.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                DB::select("CALL emis_audit_proc('".$this->database."','master_guidelines','".$request['id']."','".$messs_det."','".$request->user_id."','Edit')");
                $data->guideline_for = $request['guideline_for'];
                $data->guideline = $request['name'];
                $data->display_order = $request['display_order'];
                $data->status = $request['status'];
                $data->updated_by = $request['user_id'];
                $data->updated_at = date('Y-m-d h:i:s');
                $data->update();
                return $this->successResponse($data);
            }
        }
    }
    public function loadGlobalMasters($param=""){
        // dd("inside system admin serices");
        
        if($param=="transfer_appeal"){
            return $this->successResponse(Calender::where('type','Transfer Appeal')->get());
        }
        if($param=="intra_transfer"){
            return $this->successResponse(Calender::where('type','Intra Transfer')->get());
        }

        if($param=="inter_transfer"){
            return $this->successResponse(Calender::where('type','Inter Transfer')->get());
        }
        if($param=="inter"){
            return $this->successResponse(Calender::where('type','Inter Transfer')->first());
        }
        if($param=="intra"){
            return $this->successResponse(Calender::where('type','Intra Transfer')->first());
        }
        if($param=="all_transfer_type_list"){
            return $this->successResponse(Calender::all());
        }
        if($param=="all_country"){
            return $this->successResponse(Country::all());
        }
        if($param=="all_active_country"){
            return $this->successResponse(Country::where('status','1')->get());
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
        if($param=="all_active_gewog"){
            return $this->successResponse(Gewog::where('status','1')->get());
        }
        if($param=="all_village_List"){
            return $this->successResponse(Village::with('dzothroughgewog','gewog')->get());
        }
        if($param=="all_active_village"){
            return $this->successResponse(Village::where('status','1')->get());
        }
        if($param=="all_gender"){
            return $this->successResponse(Gender::all());
        }
        if($param=="all_active_gender"){
            return $this->successResponse(Gender::where('status','1')->get());
        }
        if($param=="all_mother_tongue"){
            return $this->successResponse(MotherTongue::all());
        }
        if($param=="active_mother_tongue"){
            return $this->successResponse(MotherTongue::where('status','1')->get());
        }
        if($param=="all_guidelines"){
            return $this->successResponse(Guidelines::all());
        }
        if($param=="active_guidelines"){
            return $this->successResponse(Guidelines::where('status','1')->get());
        }
        if($param=="all_calender"){

            return $this->successResponse(Calender::all());
        }
        if($param=="active_calender"){
            return $this->successResponse(Calender::where('status','1')->get());
        }

    }
    public function load_dropdown($model="",$parent_id=""){
        if($model=="dzongkhag"){
            return $this->successResponse(Gewog::where('dzongkhag_id',$parent_id)->get());
        }
        if($model=="gewog"){
            return $this->successResponse(Village::where('gewog_id',$parent_id)->get());
        }
        if($model=="guidelines"){
            return $this->successResponse(Guidelines::where('guideline_for',str_replace('_',' ',$parent_id))->where('status',1)->orderby('display_order','ASC')->get());
        }

    }
    public function loadDzoGeoVilByVilId($id=""){
        $response_data = DB::table('dzongkhag_master as d')
            ->join('gewog_master as g', 'g.dzongkhag_id', '=', 'd.id')
            ->join('village_master as v', 'v.gewog_id', '=', 'g.id')
            ->select('d.id as dzo_id','d.name as dzo_name', 'g.id as gewog_id', 'g.name gewog_name', 'v.id as village_id', 'v.name village_name')
            ->where('v.id', '=', $id)->first();
        return $this->successResponse($response_data);
    }
    public function load_village_details_by_gewog_id($gewog_id){
        $response_data = DB::table('gewog_master as g')
                    ->join('village_master as v', 'g.id', '=','v.gewog_id')
                    ->select('v.*')
                    ->where('v.gewog_id', '=', $gewog_id)
                    ->get();
            return $this->successResponse($response_data);
    }
    public function load_gewog_dzongkhag_id($dzoId=""){
        return $this->successResponse(Gewog::where('dzongkhag_id',$dzoId)->get());
    }
    public function load_village_details_by_village_id($id=""){
        return $this->successResponse(Village::where('id',$id)->first());
    }
    public function load_gewog_details_by_village_id($id=""){
        $gewog_id=Village::where('id',$id)->first()->gewog_id;
        return $this->successResponse(Gewog::where('id',$gewog_id)->first());
    }
    public function load_gewog_details_by_id($id=""){
        return $this->successResponse(Gewog::where('id',$id)->first());
    }
    public function load_dzongkhag_details_by_id($id=""){
        return $this->successResponse(Dzongkhag::where('id',$id)->first());
    }
    public function load_country_details_by_id($id=""){
        return $this->successResponse(Country::where('id',$id)->first());
    }
    public function load_Gender_details_by_id($id=""){
        return $this->successResponse(Gender::where('id',$id)->first());
    }

}
