<?php

namespace App\Http\Controllers\staff;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\PersonalDetails;
use App\Models\staff_masters\PositionTitle;
use Exception;
use Illuminate\Support\Facades\DB;

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
            if(strpos($parent_id,'SEN')!==false){
                return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->where('is_sen',1)->where('working_agency_id',$parent_id)->get());
            }else{
                return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->where('working_agency_id',$parent_id)->get());
            }
        }
        if($type=="orgWisePrivateStaff"){
            return $this->successResponse(PersonalDetails::where('emp_type_id','Private')->where('status','Created')->where('working_agency_id',$parent_id)->get());
        }

        if($type=="dzoWiseCivilServent"){
            $emp_type=[1,2,3];//regualr,contract and volunteer
            if(strpos($parent_id,'SEN')!==false){
                return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->where('is_sen',1)->where('dzo_id',$parent_id)->get());
            }else{
                return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('dzo_id',$parent_id)->where('status','Created')->get());
            }
        }
        if($type=="dzoWisePrivateStaff"){
            return $this->successResponse(PersonalDetails::where('emp_type_id','Private')->where('dzo_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="allCivilServent"){
            $emp_type=[1,2,3];//regualr,contract and volunteer
            if(strpos($parent_id,'SEN')!==false){
                return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->where('is_sen',1)->get());
            }else{
                return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->get());
            }
        }
        if($type=="allPrivateStaff"){
            return $this->successResponse(PersonalDetails::where('emp_type_id','Private')->where('status','Created')->get());
        }

        if($type=="staffOrgwise" || $type=="staffSchoolwise"){
            return $this->successResponse(PersonalDetails::where('status','Created')->where('working_agency_id',$parent_id)->get());
        }
        if($type=="staffDzongkhagwise"){
            return $this->successResponse(PersonalDetails::where('status','Created')->where('dzo_id',$parent_id)->get());
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
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->get());
        }
        if($type=="userdzongkhagwise" || $type=="dzongkhagwise"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->where('dzo_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="orgwise" || $type=="userworkingagency"){
            try{
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','dzo_id','village_id','comp_sub_id','elective_sub_id1','elective_sub_id2')->where('working_agency_id',$parent_id)->where('status','Created')->get());

            }catch(Exception $e){
                dd($e);
            }
        }
        if($type=="emptype"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->where('emp_type_id',$parent_id)->where('status','Created')->get());
        }
    }
    public function viewStaffDetails($type="",$id=""){
        if($type=="by_id"){
            $staff_det=PersonalDetails::where('id',$id)->first();
            if($staff_det!=null && $staff_det!=""){
                $position=PositionTitle::where('id',$staff_det->position_title_id)->first();
                if($position!=null && $position!=""){
                    $staff_det->position_title_name=$position->name;
                }
            }
            return $this->successResponse($staff_det);
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
    // method by Chimi Thinley to get Staff by array of aca_teacher_sub_ids
    public function loadFewDetailsStaffListBySubject(Request $request){
        try{

        $staffs_by_subject = DB::table('stf_staff')
            ->join('master_stf_position_title', 'stf_staff.position_title_id', '=', 'master_stf_position_title.id')
            ->selectRaw('stf_staff.id,stf_staff.emp_id,stf_staff.comp_sub_id,stf_staff.elective_sub_id1,stf_staff.elective_sub_id2,stf_staff.name,master_stf_position_title.name AS position')
            ->where('stf_staff.working_agency_id',$request['orgId'])
            ->whereIn('stf_staff.comp_sub_id',explode(",",$request['aca_teacher_sub_ids']))
            ->orWhereIn('stf_staff.elective_sub_id1',explode(",",$request['aca_teacher_sub_ids']))
            ->orWhereIn('stf_staff.elective_sub_id2',explode(",",$request['aca_teacher_sub_ids']))
            ->get();
        return $this->successResponse($staffs_by_subject);
        }catch(Exception $e){
            dd($e);
        }
    }

}
