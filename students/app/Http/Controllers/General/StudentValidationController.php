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
use App\Models\Students\CeaSchoolProgramme;


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
     * 
     * the field $data can be deleted. It was used to check what values to use
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
            
            case "school_program" : {
                    $record_exists = $this->validateSchoolProgram($request);
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
            'record_type'       => $request->record_type,
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
            'club'                  => $request->club,
            'date'                  => $request->date,
            'responsibilities'      => $request->responsibilities,
            'role'                  => $request->role,
            'record_type'           => $request->record_type,
            'data_type'             =>  'club_members',
            'user_id'               => $request->user_id,
        ];

        $status =  CeaClubMembership::where('CeaProgrammeId', $request->club)
                        ->where('StdStudentId', $request->student)
                        ->whereYear('JoiningDate', date('Y'))
                        ->where('Status', $request->status)
                        ->first();

        if($status!=null && $status!=""){
            $data_exists = "exist" ;
        } else {
            $data_exists = "false";
        }
                                
        return $data_exists;
        
    }

    /**
     * Function to validate and ensure that programs are not repeated in schools
     */

    private function validateSchoolProgram($request){
        $data =[
            'id'                => $request->id,
            'organisation_id'   => $request->organisation_id,
            'program'           => $request->program,
            'supporter'         => $request->supporter,
            'year'              => $request->year,
            'remarks'           => $request->remarks,
            'data_type'         => $request->data_type,
            'record_type'       => $request->record_type,
            'user_id'           => $request->user_id
        ];

        //If add, validate the main fields
        //for edit, validate all fields

        if($request->record_type == 'add'){
            $status =  CeaSchoolProgramme::where('CeaProgrammeId', $request->program)
                        ->where('OrgOrganizationId', $request->organisation_id)
                        ->first();
        } else{
            $status =  CeaSchoolProgramme::where('CeaProgrammeId', $request->program)
                        ->where('OrgOrganizationId', $request->organisation_id)
                        ->where('CeaProgrammeSupporterId', $request->supporter)
                        ->where('EstablishmentYear', $request->year)
                        ->where('Remarks', $request->remarks)
                        ->first();
        }
        
        if($status!=null && $status!=""){
            $data_exists = "exist" ;
        } else {
            $data_exists = "false";
        }
                                
        return $data_exists;

    }

}
