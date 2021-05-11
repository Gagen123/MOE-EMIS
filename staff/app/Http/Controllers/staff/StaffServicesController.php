<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff_services\StaffAward;
use App\Models\staff_services\StaffResponsiblity;
use App\Models\staff_services\StaffDisaplinary;

class StaffServicesController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function saveStaffAward(Request $request){
        $rules = [
            'staff'             =>  'required',
            'award_category'    =>  'required',
            'award_given_by'    =>  'required',
            'award_type_id'     =>  'required',
            'place'             =>  'required',
            'date'              =>  'required',
        ];
        $customMessages = [
            'staff.required'            => 'This field is required',
            'award_category.required'   => 'This field is required',
            'award_given_by.required'   => 'This field is required',
            'award_type_id.required'    => 'This field is required',
            'date.required'             => 'This field is required',
            'place.required'            => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        // 'action_type'                =>  $request->action_type,
        $data =[
            'staff_id'                   =>  $request->staff,
            'award_given_by'             =>  $request->award_given_by,
            'award_type_id'              =>  $request->award_type_id,
            'date'                       =>  $request->date,
            'place'                      =>  $request->place,
            'remarks'                    =>  $request->remarks,
            'coursetitle'                =>  $request->coursetitle,
        ];
        if($request->action_type=="edit"){
            $additional=[
                'updated_by'                 =>  $request->user_id, 
                'updated_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            StaffAward::where('id', $request->id)->update($data);
            $response_data = StaffAward::where('id', $request->id)->first();
        }
        else{
            $additional=[
                'created_by'                 =>  $request->user_id, 
                'created_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            $response_data = StaffAward::create($data); 
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadStaffAward($user_id=""){
        return $this->successResponse(StaffAward::where('created_by',$user_id)->get());
    }
    
    public function deleteStaffServices($type="",$id=""){
        if($type=="award"){
            return $this->successResponse(StaffAward::where('id',$id)->delete());
        }
        if($type=="responsibility"){
            return $this->successResponse(StaffResponsiblity::where('id',$id)->delete());
        }
    }
    
    public function saveStaffResponsibility(Request $request){
        $rules = [
            'staff'             =>  'required',
            'responsibility'    =>  'required',
        ];
        $customMessages = [
            'staff.required'            => 'This field is required',
            'responsibility.required'   => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'staff_id'                   =>  $request->staff,
            'responsibility'             =>  $request->responsibility,
            'remarks'                    =>  $request->remarks,
        ];
        if($request->action_type=="edit"){
            $additional=[
                'updated_by'                 =>  $request->user_id, 
                'updated_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            StaffResponsiblity::where('id', $request->id)->update($data);
            $response_data = StaffResponsiblity::where('id', $request->id)->first();
        }
        else{
            $additional=[
                'created_by'                 =>  $request->user_id, 
                'created_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            $response_data = StaffResponsiblity::create($data); 
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadStaffResponsibility($user_id=""){
        return $this->successResponse(StaffResponsiblity::where('created_by',$user_id)->get());
    }
    
    public function saveStaffDisaplinary(Request $request){
        $rules = [
            'staff'                 =>  'required',
            'offence_date'          =>  'required',
            'offence_type_id'       =>  'required',
            'offence_severity_id'   =>  'required',
            'offence_action_id'     =>  'required',
        ];
        $customMessages = [
            'staff.required'                => 'This field is required',
            'offence_date.required'         => 'This field is required',
            'offence_type_id.required'      => 'This field is required',
            'offence_severity_id.required'  => 'This field is required',
            'offence_action_id.required'    => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'staff_id'                   =>  $request->staff,
            'offence_date'               =>  $request->offence_date,
            'offence_type_id'            =>  $request->offence_type_id,
            'offence_severity_id'        =>  $request->offence_severity_id,
            'offence_action_id'          =>  $request->offence_action_id,
            'offence_description'        =>  $request->offence_description,
            'description_on_action'      =>  $request->description_on_action,
        ];
        if($request->action_type=="edit"){
            $additional=[
                'updated_by'                 =>  $request->user_id, 
                'updated_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            StaffDisaplinary::where('id', $request->id)->update($data);
            $response_data = StaffDisaplinary::where('id', $request->id)->first();
        }
        else{
            $additional=[
                'created_by'                 =>  $request->user_id, 
                'created_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            $response_data = StaffDisaplinary::create($data); 
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    public function loadStaffdisaplinary($user_id=""){
        $disaplinary=StaffDisaplinary::where('created_by',$user_id)->get();
        return $this->successResponse($disaplinary);
    }
}
