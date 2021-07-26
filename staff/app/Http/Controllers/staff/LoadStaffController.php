<?php

namespace App\Http\Controllers\staff;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\PersonalDetails;

class LoadStaffController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function loadStaffList($type="",$parent_id=""){
        if($type=="allstaff"){
            return $this->successResponse(PersonalDetails::all());
        }
        if($type=="userdzongkhagwise" || $type=="dzongkhagwise"){
            if(strpos($parent_id,'Private')!==false){
                $dzo_id=explode('__',$parent_id)[1];
                return $this->successResponse(PersonalDetails::where('dzo_id',$dzo_id)->where('emp_type_id','Private')->where('status','Created')->get());
            }else{
                return $this->successResponse(PersonalDetails::where('dzo_id',$parent_id)->where('emp_type_id','!=','Private')->where('status','Created')->get());
            }
        }
        // if($type=="orgwise" || $type=="userworkingagency" || $type=="dzo_hq_departmentwise"){
        //     return $this->successResponse(PersonalDetails::where('working_agency_id',$parent_id)->where('status','Created')->get());
        // }
        if($type=="orgWiseCivilServent"){
            $emp_type=[1,2,3];//regualr,contract and volunteer
            return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->where('working_agency_id',$parent_id)->get());
        }
        if($type=="orgWisePrivateStaff"){
            return $this->successResponse(PersonalDetails::where('emp_type_id','Private')->where('status','Created')->where('working_agency_id',$parent_id)->get());
        }

        if($type=="dzoWiseCivilServent"){
            $emp_type=[1,2,3];//regualr,contract and volunteer
            return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('dzo_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="dzoWisePrivateStaff"){
            return $this->successResponse(PersonalDetails::where('emp_type_id','Private')->where('dzo_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="allCivilServent"){
            $emp_type=[1,2,3];//regualr,contract and volunteer
            return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->get());
        }
        if($type=="allPrivateStaff"){
            return $this->successResponse(PersonalDetails::where('emp_type_id','Private')->where('status','Created')->get());
        }


        // if($type=="allRegContract"){
        //     $emp_type=[];
        //     foreach(explode(',',$parent_id) as $emp){
        //         array_push($emp_type,$emp);
        //     }
        //     return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->get());
        // }
    }
    public function loadFewDetailsStaffList($type="",$parent_id=""){
        if($type=="allstaff"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->where('id', 1)->all());
        }
        if($type=="userdzongkhagwise" || $type=="dzongkhagwise"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->where('dzo_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="orgwise" || $type=="userworkingagency"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->where('working_agency_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="emptype"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->where('emp_type_id',$parent_id)->where('status','Created')->get());
        }
    }

    public function viewStaffDetails($type="",$id=""){
        if($type=="by_id"){
            return $this->successResponse(PersonalDetails::where('id',$id)->first());
        }
        if($type=="cid"){
            return $this->successResponse(PersonalDetails::where('cid_work_permit',$id)->first());
        }
        if($type=="emp_id"){
            return $this->successResponse(PersonalDetails::where('emp_id',$id)->first());
        }
        if($type=="cid_emp_id"){
            $data=$this->successResponse(PersonalDetails::where('emp_id',$id)->first());
            if($data!=null && $data!=""){
                return $data;
            }
            else{
                return $this->successResponse(PersonalDetails::where('cid_work_permit',$id)->first());
            }
        }

    }

}
