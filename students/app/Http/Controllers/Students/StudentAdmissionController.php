<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\CeaStudentAward;
use App\Models\Students\Student;


class StudentAdmissionController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveStudentDetails(Request $request){
        $rules = [
            'snationality'              => 'required',
            'cid_passport'              => 'required',
            'first_name'                => 'required',
            'dob'                       => 'required',
            'sex_id'                    => 'required',
            'mother_tongue'             => 'required',
            'attachments'               => 'required',
            
        ];
        $customMessages = [
            'snationality.required'             => 'This field is required',
            'cid_passport.required'             => 'This field is required',
            'first_name.required'               => 'This field is required',
            'dob.required'                      => 'This field is required',
            'sex_id.required'                   => 'This field is required',
            'mother_tongue.required'            => 'This field is required',
            'attachments.required'              => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'snationality'              =>  $request->snationality,
            'cid_passport'              =>  $request->cid_passport,
            'first_name'                =>  $request->first_name,
            'middle_name'               =>  $request->middle_name,
            'last_name'                 =>  $request->last_name,
            'dob'                       =>  $request->dob,
            'sex_id'                    =>  $request->sex_id,
            'village_id'                =>  $request->village_id, 
            'address'               =>  $request->fulladdress,
            'mother_tongue'             =>  $request->mother_tongue, 
            'attachments'               =>  $request->attachments, 
            'created_by'                =>  $request->user_id,
            'created_at'                =>  date('Y-m-d h:i:s'),
            'status'                    =>  1,
        ];
        
        $response_data = StudentPersonalDetails::create($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}
