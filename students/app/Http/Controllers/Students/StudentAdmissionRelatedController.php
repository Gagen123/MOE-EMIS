<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\StdSchoolLeaving;
use App\Models\Students\StdSeparatedWhereabouts;

class StudentAdmissionRelatedController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update student awards
    */

    public function reportStudents(Request $request){
        
        $rules = [
            'date'               => 'required'
        ];

        $customMessages = [
            'date.required'     => 'This field is required',
        ];
        
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'date'             => $request->date,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_reported'          => $request->std_reported,
        ];
        
        $std_reported = $data['std_reported'];

        unset($data['std_reported']);

        foreach($std_ids as $index => $student_id){
            $screened_data = [
                // 'StdHealthTermId' => $data['term_id'],
                // 'StdStudentId'=> $student_id,
                // 'date' => $data['date'],
                // 'height' => $std_height[$index],
                // 'weight' => $std_weight[$index],
                // 'bmi' => 0,
                // 'remarks' => $std_remarks[$index]
            ];

            //$response_data = StudentBmi::create($screened_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    public function loadUnreportedStudents($param1){
        $id =$param1;
        
        return $this->successResponse(Student::where('OrgOrganizationId',$id)->take(10)
                            ->get(['id', 'Name', 'DateOfBirth']));
    }

    public function saveStudentTransfer(Request $request){
        
        $rules = [
            'student'               => 'required',
            'last_class_attended'               => 'required',
            'date'               => 'required',
            'reasons'               => 'required'
        ];

        $customMessages = [
            'student.required'     => 'This field is required',
            'last_class_attended.required'     => 'This field is required',
            'date.required'     => 'This field is required',
            'reasons.required'     => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'OrgOrganizationId' => $request->working_agency_id,
            'LeavingDate'             => $request->date,
            'StdStudentId'             => $request->student,
            'Reasons'            => $request->reasons
        ];
        
        if($request->action_type=="add"){
            $response_data = StdSchoolLeaving::create($data);

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

    public function loadStudentTransfers($param1){
        $id =$param1;

        $awards = DB::table('std_student_school_leaving')
                ->join('std_student', 'std_student_school_leaving.StdStudentId', '=', 'std_student.id')
                ->select('std_student_school_leaving.*', 'std_student.Name')
                ->get();
        
        return $this->successResponse($awards);
    }

    public function saveStudentWhereabouts(Request $request){
        
        $rules = [
            'student'               => 'required',
            'last_class_attended'               => 'required',
            'date'               => 'required',
            'reasons'               => 'required',
            'current_engagement'    => 'required',
            'current_address'       => 'required'
        ];

        $customMessages = [
            'student.required'     => 'This field is required',
            'last_class_attended.required'     => 'This field is required',
            'date.required'     => 'This field is required',
            'reasons.required'     => 'This field is required',
            'current_engagement.required'     => 'This field is required',
            'current_address.required'     => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'OrgOrganizationId' => $request->working_agency_id,
            'LeaveingDate'             => $request->date,
            'StdStudentId'             => $request->student,
            'last_class_attended'             => $request->last_class_attended,
            'action_type'       => $request->action_type,
            //'reasons'            => $request->reasons,
            'CurrentEngagement'    => $request->current_engagement,
            'CurrentAddress'       => $request->current_address
        ];

        if($request->action_type=="add"){
            $response_data = StdSeparatedWhereabouts::create($data);

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

            StdSeparatedWhereabouts::where('id', $request['id'])->update($app_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadStudentWhereabouts($param1){
        $id =$param1;

        $awards = DB::table('std_student_separated_whereabout')
                ->join('std_student', 'std_student_separated_whereabout.StdStudentId', '=', 'std_student.id')
                ->select('std_student_separated_whereabout.*', 'std_student.Name')
                ->get();
        
        return $this->successResponse($awards);
    }
}
