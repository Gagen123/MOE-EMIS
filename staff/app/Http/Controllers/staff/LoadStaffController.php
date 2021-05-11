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
            return $this->successResponse(PersonalDetails::where('dzo_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="orgwise" || $type=="userworkingagency"){
            return $this->successResponse(PersonalDetails::where('working_agency_id',$parent_id)->where('status','Created')->get());
        }
        if($type=="emptype"){
            return $this->successResponse(PersonalDetails::where('emp_type_id',$parent_id)->where('status','Created')->get());
        }
    }
    
    public function viewStaffDetails($type="",$id=""){
        if($type=="by_id"){
            return $this->successResponse(PersonalDetails::where('id',$id)->where('status',$status)->first());
        }
        if($type=="cid"){
            return $this->successResponse(PersonalDetails::where('cid_work_permit',$id)->first());
        }
        if($type=="emp_id"){
            return $this->successResponse(PersonalDetails::where('emp_id',$id)->first());
        }
    }

}
