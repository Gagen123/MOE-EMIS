<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\CeaProgramInventory;
use App\Models\Students\CeaProgramInventoryDetail;
use App\Models\Students\CeaProgramInventoryExpenditure;
use App\Models\Students\CeaProgramInventoryProduction;
use App\Models\Students\CeaProgramActionPlan;
use App\Models\Students\CeaProgramActionPlanDetail;
use App\Models\Students\CeaSchoolProgramme;
use App\Models\Students\CeaProgrammeMembership;
use App\Models\Students\CeaRoleStaff;
use App\Models\Students\CeaRoleStudent;
use App\Models\Masters\CeaProgramType;
use App\Models\Students\StudentClub;


class StudentProgramClubController extends Controller
{
    //
    use ApiResponser;
  //  public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function saveStudentClub(Request $request){
//    dd('from services');
        $std_id = $request->student;
        $status = $request->status;
        $status =  StudentClub:: where ('status', $status)->where ('StdStudentId', $std_id)->first();
        if($status!=null && $status!=""){
            $persondata = "exist" ;
        }
        else{
            $data =[
                'organizationId'            => $request->organizationId,
                'id'                        => $request->id,
                'StdStudentId'              => $request->student,
                'status'                    => $request->status,
                'CeaSchoolProgrammeId'      => $request->program,
                'Responsibility'            => $request->responsibilities,
                'JoiningDate'               => $request->date,
                'role'                      => $request->role
            ];
            $persondata = StudentClub::create($data);
          //  dd( $data);
        }
        return $this->successResponse($persondata, Response::HTTP_CREATED);
    }

    public function listProgramMembers($orgId=""){
        $id ="1";

        $records = DB::table('student_club')
                ->join('cea_programme', 'cea_school_programme.CeaProgrammeId', '=', 'cea_programme.id')
                ->join('cea_programme_membership', 'cea_school_programme.id', '=', 'cea_programme_membership.CeaSchoolProgrammeId')
                ->join('std_student', 'cea_programme_membership.StdStudentId', '=', 'std_student.id')
                ->select('cea_programme_membership.*', 'std_student.Name AS student_name', 'cea_programme.name AS program_name')
                ->get();

        return $this->successResponse($records);
    }
}
