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
            'StdStudentId'              => 'required',
            'CeaSchoolScoutsId'         => 'required',
            'CeaSchoolSectionLevelId'   => 'required',
            'date'                      => 'required'
        ];

        $customMessages = [
            'StdStudentId.required'             => 'This field is required',
            'CeaSchoolScoutsId.required'        => 'This field is required',
            'CeaSchoolSectionLevelId.required'  => 'This field is required',
            'date.required'                     => 'This field is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                       =>$request->id,
            'StdStudentId'             =>$request->StdStudentId,
            'CeaSchoolScoutsId'        =>$request->CeaSchoolScoutsId,
            'CeaSchoolSectionLevelId'  =>$request->CeaSchoolSectionLevelId,
            'JoiningDate'              =>$request->date,
            'action_type'              =>$request->action_type,
            'created_by'               =>$request->user_id,
        ];
        if($request->action_type=="add"){
            $response_data = CeaSchoolScoutMembers::create($data);
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

            CeaSchoolScoutMembers::where('id', $request['id'])->update($app_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    // public function loadScoutMembers($param=""){
    //     $roles = DB::table('cea_scouts_membership')
    //             ->join('cea_school_scouts', 'cea_school_scouts.id', '=', 'cea_scouts_membership.CeaSchoolScoutsId')
    //             ->join('cea_scouts', 'cea_school_scouts.CeaScoutsId', '=', 'cea_scouts.id')
    //             ->join('std_student', 'cea_scouts_membership.StdStudentId', '=', 'std_student.id')
    //             ->select('cea_scouts_membership.*', 'cea_scouts.name AS scout_name', 'std_student.name as student_name')
    //             ->where('cea_school_scouts.OrgOrganizationId', $param)
    //             ->get();
    //     return $this->successResponse($roles);
    // }
}
