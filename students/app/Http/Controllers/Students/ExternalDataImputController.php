<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Models\Students\RubCollegeDetails;
use App\Models\Students\RubStaffDetails;
use App\Models\Students\RubStudentDetails;


class ExternalDataImputController extends Controller
{
    use ApiResponser;
    public $database="student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveImported(Request $request){
        if($request->action_type=="add"){
            if($request->type == "institutes"){
                $rules = [
                    'collegeName'               => 'required',
                    'dzongkhag'                 => 'required',
                    'remarks'                   => 'required',
                    'institutes_type'           => 'required',
                    
                ];
                $customMessages = [
                    'collegeName.required'     => 'This field is required',
                    'dzongkhag.required'       => 'This field is required',
                    'remarks.required'         => 'This field is required',
                    'institutes_type.required' => 'This field is required',
                ];
                $this->validate($request, $rules, $customMessages);
                    $collegeDetails =[
                        'collegeName'           => $request->collegeName,
                        'institutes_type'       => $request->institutes_type,
                        'dzongkhag'             => $request->dzongkhag,
                        'created_by'            => $request->user_id,
                        'org_id'                => $request->working_agency_id,
                        'created_at'            =>  date('Y-m-d h:i:s')
                    ];
                    $response_data=RubCollegeDetails::create($collegeDetails);
                    return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            if($request->type == "staff"){
                foreach ($request->staff_form as $i=> $item){
                    $staffDetails = array(
                            'institute_id'             => $request->institutes_id,
                            'staffName'                =>  $item['staffName'],
                            'staffEmail'               =>  $item['staffEmail'],
                            'staff_contactNo'          =>  $item['staff_contactNo'],
                            'remarks'                  =>  $request->remarks,
                            'created_by'               =>  $request->user_id,
                            'created_at'               =>  date('Y-m-d h:i:s')
                    );
                    $response_data = RubStaffDetails::create($staffDetails);
                }
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            if($request->type == "student"){
                $institutes_id  = $request['institutes_id'];
                $remarks  = $request['remarks'];
                $user_id  = $request['user_id'];
                foreach ($request->student_form as $i=> $item){
                        $studentDetails = array(
                            'institute_id'              =>  $institutes_id,
                            'studentName'               =>  $item['studentName'],
                            'studentEmail'              =>  $item['studentEmail'],
                            'student_contactNo'         =>  $item['student_contactNo'],
                            'remarks'                   =>  $remarks,
                            'created_by'                =>  $user_id,
                            'created_at'                =>  date('Y-m-d h:i:s')
                        );
                        $response_data = RubStudentDetails::create($studentDetails);
                }
                return $this->successResponse($response_data, Response::HTTP_CREATED);
                }
        }
            // if($request->action_type=="edit"){} 

        } 
        public function loadInstitues($param=""){
            if($param=="all_institutes"){
                return $this->successResponse(RubCollegeDetails::all());
            }
            if($param=="staff"){
                return $this->successResponse(RubStaffDetails::all());
            }
            if($param=="student"){
                return $this->successResponse(RubStudentDetails::all());
            }
            
        }
}