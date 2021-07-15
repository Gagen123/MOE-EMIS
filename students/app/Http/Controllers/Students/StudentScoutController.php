<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\CeaSchoolScout;
use App\Models\Students\CeaSchoolScoutMembers;
use App\Models\Students\StdScoutBadge;

class StudentScoutController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }


    public function saveStudentScouts(Request $request){

        $rules = [
            'scout'       => 'required',
            'year'       => 'required'
        ];
        $customMessages = [
            'scout.required'          => 'This field is required',
            'year.required'          => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                => $request->id,
            'OrgOrganizationId' => $request->working_agency_id,
            'CeaScoutsId'           =>  $request->scout,
            'EstablishmentYear'           =>  $request->year,
            'Remarks'           =>  $request->remarks
        ];
        if($request->action_type=="add"){
            $response_data = CeaSchoolScout::create($data);
        } else if($request->action_type=="edit"){

            //Audit Trails
            // $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            // $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','master_working_agency','".$request['id']."','".$msg_det."','".$request->input('user_id')."','Edit')");

            $app_data = [
                'StdStudentId' => $request['student'],
                'awarded_by'    =>  $request['award_given_by'],
                'CeaAwardId'     =>  $request['award_type_id'],
                'Place'             =>  $request['place'],
                'AwardDate'              =>  $request['date'],
                'Remarks'           =>  $request['remarks'],
            ];

            CeaSchoolScout::where('id', $request['id'])->update($app_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);


    }

    public function loadStudentScouts($param=""){
        $roles = DB::table('cea_school_scouts')
                ->join('cea_scouts', 'cea_school_scouts.CeaScoutsId', '=', 'cea_scouts.id')
                ->select('cea_school_scouts.*', 'cea_scouts.name AS scout_name')
                ->where('cea_school_scouts.OrgOrganizationId', $param)
                ->get();

        return $this->successResponse($roles);

    }

    public function listStudentScouts($param=""){
        $id = $param;
        $roles = DB::table('cea_school_scouts')
                ->join('cea_scouts', 'cea_school_scouts.CeaScoutsId', '=', 'cea_scouts.id')
                ->select('cea_scouts.name AS scout_name', 'cea_school_scouts.Id AS id')
                ->where('cea_school_scouts.OrgOrganizationId', $id)
                ->get();

        return $this->successResponse($roles);

    }


    //SAVE SCOUT PARTICIPANTS
    public function saveScoutParticipants(Request $request){
        $rules = [
            'student'                   => 'required',
            'CeaScoutSectionId'         => 'required',
            'CeaScoutSectionLevelId'    => 'required',
            'date'                      => 'required'
        ];

        $customMessages = [
            'student.required'                  => 'This field is required',
            'CeaScoutSectionId.required'        => 'This field is required',
            'CeaScoutSectionLevelId.required'   => 'This field is required',
            'date.required'                     => 'This field is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                        =>$request->id,
            'StdStudentId'              =>$request->student,
            'CeaScoutSectionId'         =>$request->CeaScoutSectionId,
            'CeaScoutSectionLevelId'    =>$request->CeaScoutSectionLevelId,
            'joiningDate'               =>$request->date,
            'remarks'                   => $request->remarks,
            'created_by'                =>$request->user_id,
        ];
        
        if($request->action_type=="add"){
            $response_data = CeaSchoolScoutMembers::create($data);
        } else if($request->action_type=="edit"){

            unset($data['created_by']);
            $created_by = [
                'updated_by'    => $request->user_id
            ];

            $data = $data + $created_by;

            $response_data = CeaSchoolScoutMembers::where('id', $data['id'])->update($data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadScoutMembers($orgId="", $user_id=""){

        $roles = DB::table('cea_scout_membership')
                    ->join('cea_scout_section', 'cea_scout_section.id', '=', 'cea_scout_membership.CeaScoutSectionId')
                    ->join('cea_scout_section_level', 'cea_scout_section_level.id', '=', 'cea_scout_membership.CeaScoutSectionLevelId')
                    ->join('std_student', 'cea_scout_membership.StdStudentId', '=', 'std_student.id')
                    ->select('cea_scout_membership.*', 'cea_scout_section.name AS scout_name', 'std_student.name as student_name', 
                                'std_student.student_code as student_code')
                    ->where('std_student.OrgOrganizationId', $orgId)
                    ->where('cea_scout_membership.created_by', $user_id)
                    ->get();
        return $this->successResponse($roles);
    }

    /**
     * list the scout members (in drop down) to award badges
     */

    public function listScoutMembers($orgId="", $user_id=""){

        $roles = DB::table('cea_scout_membership')
                    ->join('cea_scout_section', 'cea_scout_section.id', '=', 'cea_scout_membership.CeaScoutSectionId')
                    ->join('cea_scout_section_level', 'cea_scout_section_level.id', '=', 'cea_scout_membership.CeaScoutSectionLevelId')
                    ->join('std_student', 'cea_scout_membership.StdStudentId', '=', 'std_student.id')
                    ->select('cea_scout_membership.CeaScoutSectionId', 'std_student.name as student_name', 
                                'std_student.student_code as student_code','std_student.id as StdStudentId')
                    ->where('std_student.OrgOrganizationId', $orgId)
                    ->where('cea_scout_membership.created_by', $user_id)
                    ->get();
        return $this->successResponse($roles);
    }

    public function saveStudentScoutsBadge(Request $request){

        $rules = [
            'scout'             => 'required',
            'badgeEarned'       => 'required',
            'date'              => 'required'
        ];

        $customMessages = [
            'scout.required'                => 'This field is required',
            'badgeEarned.required'          => 'This field is required',
            'date.required'                 => 'This field is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $details_details = explode('_', $request->scout);
        $std_id = $details_details[0];

        $data =[
            'id'                            =>$request->id,
            'StdStudentId'                  =>$std_id,
            'CeaScoutProficiencyBadgeId'    =>$request->badgeEarned,
            'remarks'                       =>$request->remarks,
            'date'                          =>$request->date,
            'action_type'                   =>$request->action_type,
            'user_id'                       => $request->user_id,
            'working_agency_id'             => $request->working_agency_id
        ];

        unset($data['action_type']);
        unset($data['user_id']);
        unset($data['working_agency_id']);

        if($request->action_type=="add"){
            $response_data = StdScoutBadge::create($data);
        } else if($request->action_type=="edit"){
            try{
                StdScoutBadge::where('id', $request['id'])->update($data);
    
                } catch(\Illuminate\Database\QueryException $ex){ 
                    dd($ex->getMessage()); 
                    // Note any method of class PDOException can be called on $ex.
                }
            $response_data = StdScoutBadge::where('id', $request['id'])->update($data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);

    }

    /**
     * List of Scout Badges
     */

    public function loadScoutsBadge($orgId="", $user_id=""){

        $badges = DB::table('std_scout_proficiency_badges')
                    ->join('cea_scout_proficiency_badges', 'cea_scout_proficiency_badges.id', '=', 'std_scout_proficiency_badges.CeaScoutProficiencyBadgeId')
                    ->join('std_student', 'std_scout_proficiency_badges.StdStudentId', '=', 'std_student.id')
                    ->join('cea_scout_membership', 'cea_scout_membership.StdStudentId', '=', 'std_student.id')
                    ->select('std_scout_proficiency_badges.*', 'cea_scout_proficiency_badges.name AS badge_name', 'std_student.name as student_name', 
                                'std_student.student_code as student_code', 'cea_scout_membership.CeaScoutSectionId')
                    ->where('std_student.OrgOrganizationId', $orgId)
                    // ->where('cea_scout_membership.created_by', $user_id)
                    ->get();
        return $this->successResponse($badges);
    }
}
