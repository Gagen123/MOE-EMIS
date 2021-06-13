<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\StudentRole;
use App\Models\Students\CeaClubMembership;


class StudentValidationController extends Controller
{
    //
    use ApiResponser;
    public $database="student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * Generic Validation for student's data
     * Using switch statement to make it generic
     * 
     * the data_type is defined in the EMIS UI for each type validation
     */

    public function validateStudentData(Request $request){

        $validation_for = $request['data_type'];

        switch($validation_for){
            case "roles_responsibilities" : {
                    $record_exists = $this->validateStudentResponsibility($request);
                    break;
                }

            case "club_members" : {
                    $record_exists = $this->validateStudentClubMembership($request);
                    break;
                }

            case "awards" : {
                    $record_exists = $this->validateStudentAward($request);
                    break;
                }
            
            default : {
                $record_exists ='false';
                break;
            }
        }

        return $this->successResponse($record_exists, Response::HTTP_CREATED);

    }

    /**
     * function to ensure that Student is not assigned the same role
     */

    private function validateStudentResponsibility($request){

        $data =[
            'id'                =>  $request->id,
            'student'           =>  $request->student,
            'role_id'           =>  $request->role_id,
            'remarks'           =>  $request->remarks,
            'action_type'       =>  $request->action_type,
            'data_type'         =>  $request->data_type,
            'user_id'           =>  $request->user_id,
            'working_agency_id' =>  $request->working_agency_id
        ];

        $status =  StudentRole::where ('StdRoleId', $request->role_id)
                                ->where ('StdStudentId', $request->student)
                                ->whereYear('date', date('Y'))
                                ->first();

        if($status!=null && $status!=""){
            $data_exists = "exist" ;
        } else {
            $data_exists = "false";
        }
                                
        return $data_exists;
        
    }

    /**
     * function to ensure that Student does not belong to more than one club
     */

    private function validateStudentClubMembership($request){

        $data =[
            'organizationId'        => $request->working_agency, 
            'id'                    => $request->id,
            'status'                => $request->status,
            'student'               => $request->student,
            'program'               => $request->program,
            'date'                  => $request->date,
            'responsibilities'      => $request->responsibilities,
            'role'                  => $request->role,
            'data_type'             =>  'club_members',
            'user_id'               => $request->user_id,
        ];

        $status =  CeaClubMembership::where ('CeaSchoolProgrammeId', $request->program)
                                ->where ('StdStudentId', $request->student)
                                ->whereYear('date', date('Y'))
                                ->where('status', $status)
                                ->first();

        if($status!=null && $status!=""){
            $data_exists = "exist" ;
        } else {
            $data_exists = "false";
        }
                                
        return $data_exists;
        
    }


}
