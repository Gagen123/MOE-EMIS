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

class StudentProgramClubController extends Controller
{
    //
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveStudentClub(Request $request){
   // dd('from services');
        
        $data =[
            'id'                        => $request->id,
            'StdStudentId'              => $request->student,
            'status'                    => $request->status,
            'CeaSchoolProgrammeId'      => $request->program,
            'Responsibility'            => $request->responsibilities,
            'JoiningDate'               => $request->date,
            'role'                      => $request->role

            //'user_id'        => $this->user_id() 
        ];
           dd($data);
        //  dd('m here from services');                   
          $persondata = StudentClub::create($data);
  
          return $this->successResponse($persondata, Response::HTTP_CREATED);
         // dd($persondata);
    }
  
}
