<?php

namespace App\Http\Controllers\staff;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\PersonalDetails;
use App\Models\staff_masters\ChildGroup;
use App\Models\staff_masters\ChildGroupPosition;
use App\Models\staff_masters\PositionLevel;
use App\Models\staff_masters\PositionTitle;
use App\Models\staff_masters\StaffSubMajorGrop;
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
                $personal=PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->get();
                if($personal!=null && $personal!="" && sizeof($personal)>0){
                    foreach($personal as $per){
                        $positions=ChildGroupPosition::where('id', $per->position_title_id)->first();
                        if($positions!=null && $positions!=""){
                            //get position title from mapping
                            $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                            if($posi!=null && $posi!=""){
                                $per->position_title_name=$posi->name;
                            }
                        }
                    }
                }
                return $this->successResponse($personal);
            }
        }
        if($type=="allPrivateStaff"){
            $personal=PersonalDetails::where('emp_type_id','Private')->where('status','Created')->get();
            if($personal!=null && $personal!="" && sizeof($personal)>0){
                foreach($personal as $per){
                    $positions=ChildGroupPosition::where('id', $per->position_title_id)->first();
                    if($positions!=null && $positions!=""){
                        //get position title from mapping
                        $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                        if($posi!=null && $posi!=""){
                            $per->position_title_name=$posi->name;
                        }
                    }
                }
            }
            return $this->successResponse($personal);
        }

        if($type=="staffOrgwise" || $type=="staffSchoolwise"){
            return $this->successResponse(PersonalDetails::where('status','Created')->where('working_agency_id',$parent_id)->get());
        }
        if($type=="staffDzongkhagwise"){
            return $this->successResponse(PersonalDetails::where('status','Created')->where('dzo_id',$parent_id)->get());
        }
    }

    public function loadtaffByOrg($type="",$parent_id=""){
        if($type=="Principle"){
            return $this->successResponse(PersonalDetails::where('isPrincipal',1)->where('working_agency_id',$parent_id)->first());
        }
        if($type=="DEO"){
            $query="SELECT s.email,s.alternative_email,s.name,m.name AS positions FROM stf_staff s JOIN master_stf_position_title m ON s.position_title_id=m.id WHERE s.dzo_id=".$parent_id." AND (LOWER(REPLACE(m.name,' ','')) LIKE '%dzongkhageducationofficer%' OR LOWER(m.name) LIKE '%deo%') ";
            return $this->successResponse(DB::select($query));
        }
    }
    public function loadFewDetailsStaffList($type="",$parent_id=""){
        if($type=="allstaff"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->get());
        }
        if($type=="userdzongkhagwise" || $type=="dzongkhagwise"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->where('dzo_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="orgwise" || $type=="userworkingagency"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','dzo_id','village_id','comp_sub_id','elective_sub_id1','elective_sub_id2')->where('working_agency_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="emptype"){
            return $this->successResponse(PersonalDetails::select('id','emp_id','name','cid_work_permit','position_title_id','sex_id','village_id')->where('emp_type_id',$parent_id)->where('status','Created')->get());
        }
    }
    public function viewStaffDetails($type="",$id=""){
        if($type=="by_id"){
            $staff_det=PersonalDetails::where('id',$id)->first();
            if($staff_det!=null && $staff_det!=""){
                //mapping of the position tile, superstructure and childgroup
                $positions=ChildGroupPosition::where('id', $staff_det->position_title_id)->first();
                if($positions!=null && $positions!=""){
                    //get position title from mapping
                    $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                    if($posi!=null && $posi!=""){
                        $staff_det->position_title_name=$posi->name;
                        //get position level from position title
                        $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                        if($posiLev!=null && $posiLev!=""){
                            $staff_det->positionlevel=$posiLev->name;
                        }
                    }

                    //to get MOG, used for eding staff details
                    $child=ChildGroup::where('id',$positions->child_group_id)->first();
                    if($child!=null && $child!=""){
                        $staff_det->childgroup=$child->name;
                        //to get subMOG, used for eding staff details to identify teacher in school
                        $submajorgrp=StaffSubMajorGrop::where('id', $child->sub_group_id)->first();
                        if($submajorgrp!=null && $submajorgrp!=""){
                            $staff_det->subgroup=$submajorgrp->name;
                        }
                    }
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
    public function loadStaffCountDetail($type="", $id=""){
        $response_data="";
        $response_data=PersonalDetails::where('working_agency_id',$id)->first();
         // if($response_data!=null && $response_data!=""){
            if($type=="staffCount"){
                $response_data->total_Staff = DB::select("SELECT working_agency_id,
                    COUNT(CASE WHEN sex_id = '353db3f5-1b97-406b-88ba-a68dbe53b2aa' THEN 1 END)AS Totalmale,
                    COUNT(CASE WHEN sex_id = '86164859-5be8-4ac8-8b40-7616d222229e' THEN 1 END) AS TotalFemale,
                    COUNT(id) AS TOTAL
                FROM `stf_staff`
                WHERE `working_agency_id`= '".$id."'");
                $response_data->counselor=DB::select("SELECT working_agency_id,
                    COUNT(CASE WHEN sex_id = '353db3f5-1b97-406b-88ba-a68dbe53b2aa' THEN 1 END)AS Malecounselor,
                    COUNT(CASE WHEN sex_id = '86164859-5be8-4ac8-8b40-7616d222229e' THEN 1 END) AS Femalecounselor,
                    COUNT(id) AS TOTALCouunselor
                FROM `stf_staff`
                WHERE `working_agency_id`= '".$id."'
                AND `position_title_id` ='0fbfd08a-489d-4755-8bd7-a8665a2dd947'");
                $response_data->isSen=DB::select("SELECT working_agency_id,
                    COUNT(CASE WHEN sex_id = '353db3f5-1b97-406b-88ba-a68dbe53b2aa' THEN 1 END)AS maleSen,
                    COUNT(CASE WHEN sex_id = '86164859-5be8-4ac8-8b40-7616d222229e' THEN 1 END) AS femaleSen,
                    COUNT(id) AS totalSen
                FROM `stf_staff`
                WHERE `working_agency_id`= '".$id."'
                AND `is_sen` ='1'");
                $response_data->SportInstructor=DB::select("SELECT working_agency_id,
                    COUNT(CASE WHEN sex_id = '353db3f5-1b97-406b-88ba-a68dbe53b2aa' THEN 1 END)AS MaleSportInst,
                    COUNT(CASE WHEN sex_id = '86164859-5be8-4ac8-8b40-7616d222229e' THEN 1 END) AS FemaleSportInst,
                    COUNT(id) AS TotalSportsInst
                FROM `stf_staff`
                WHERE `position_title_id` ='315b2020-fd17-4f0c-a643-15b603ff1f08'
                AND `working_agency_id`= '".$id."'");
            }
            if($type=="staffCountMinistry"){
                // $response_data=PersonalDetails::where('working_agency_id',$id)->first();
                // dd($response_data);
                $response_data->StaffMinistry= DB::select("SELECT working_agency_id,
                    COUNT(CASE WHEN sex_id = '353db3f5-1b97-406b-88ba-a68dbe53b2aa' THEN 1 END)AS Totalmale,
                    COUNT(CASE WHEN sex_id = '86164859-5be8-4ac8-8b40-7616d222229e' THEN 1 END) AS TotalFemale,
                    COUNT(id) AS TOTAL
                FROM `stf_staff`
                WHERE `working_agency_id`= '".$id."'");


            }

        return $this->successResponse($response_data);
    }


}
