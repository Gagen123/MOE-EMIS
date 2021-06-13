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
use App\Models\Students\StudentAboard;



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
            'date'                  => 'required'
        ];

        $customMessages = [
            'date.required'         => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                    => $request->id,
            'date'                  => $request->date,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_reported'          => $request->std_reported,
        ];

        $std_unreported = $data['std_reported'];
        $student_id = $data['std_id'];

        unset($data['std_reported']);

        foreach($std_unreported as $index => $unreported){
            if($unreported == 'on'){
                $StdStudentId = $student_id[$index];
                $response_data = $this->updateStudentStatus('reporting', $StdStudentId);
            }

        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);

    }

    public function loadUnreportedStudents($org_id){

        $students = DB::table('std_student')
                ->where('OrgOrganizationId', $org_id)
                ->where('IsRejoined', '1')
                ->get();

        return $this->successResponse($students);
    }

    public function saveStudentTransfer(Request $request){

        $rules = [
            'student'                       => 'required',
            'last_class_attended'           => 'required',
            'date'                          => 'required',
            'reasons'                       => 'required'
        ];

        $customMessages = [
            'student.required'              => 'This field is required',
            'last_class_attended.required'  => 'This field is required',
            'date.required'                 => 'This field is required',
            'reasons.required'              => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                            => $request->id,
            'OrgOrganizationId'             => $request->working_agency_id,
            'LeavingDate'                   => $request->date,
            'StdStudentId'                  => $request->student,
            'Reasons'                       => $request->reasons
        ];

        if($request->action_type=="add"){
            $response_data = StdSchoolLeaving::create($data);
            $updated_status = $this->updateStudentStatus('school_leaving', $request->student);

        } else if($request->action_type=="edit"){

            //Audit Trails
            // $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            // $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','master_working_agency','".$request['id']."','".$msg_det."','".$request->input('user_id')."','Edit')");

            $app_data = [
                'StdStudentId'             => $request['student'],
                'awarded_by'               =>  $request['award_given_by'],
                'CeaAwardId'               =>  $request['award_type_id'],
                'Place'                    =>  $request['place'],
                'AwardDate'                =>  $request['date'],
                'Remarks'                  =>  $request['remarks'],
            ];

            StdSchoolLeaving::where('id', $request['id'])->update($app_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadStudentTransfers($param){
        $id =$param;

        $students = DB::table('std_student')
                ->where('std_student.OrgOrganizationId', $id)
                ->where('IsTransferred', '1')
                ->get();

        return $this->successResponse($students);
    }

    public function saveStudentWhereabouts(Request $request){

        $rules = [
            'student'                   => 'required',
            'last_class_attended'       => 'required',
            'date'                      => 'required',
            'reasons'                   => 'required',
            'current_engagement'        => 'required',
            'current_address'           => 'required'
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

    /// student Aboard

    public function loadAboardList($orgId=""){

         $list = DB::table('student_aboards')
             ->select('id', 'first_name', 'middle_name', 'last_name', 'dob', 'country')
             ->where('organizationId',$orgId)->get();
         return $list;
    }
    /**
     * method to save student aboard details
     */
    public function saveStudentAboard(Request $request){
     //   dd('m here at services');
        $id = $request->id;
        if( $id != null){
            $data =[
                'id'                        =>  $request->id,
                'organizationId'            =>  $request->organizationId,
                'cid_passport'              =>  $request->cid_passport,
                'first_name'                =>  $request->first_name,
                'middle_name'               =>  $request->middle_name,
                'last_name'                 =>  $request->last_name,
                'dob'                       =>  $request->dob,
                'sex_id'                    =>  $request->sex_id,
                'mother_tongue'             =>  $request->mother_tongue,
                'status'                    =>  $request->status,
                'fulladdress'               =>  $request->fulladdress,
                'country'                   =>  $request->country,
                'phone'                     =>  $request->phone,
                'city'                      =>  $request->city,
             ];
            StudentAboard::where('id', $id)->update($data);
            $persondata = StudentAboard::where('id', $id)->first();
        } else {
            $data =[
                'id'                        =>  $request->id,
                'organizationId'            =>  $request->organizationId,
                'cid_passport'              =>  $request->cid_passport,
                'first_name'                =>  $request->first_name,
                'middle_name'               =>  $request->middle_name,
                'last_name'                 =>  $request->last_name,
                'dob'                       =>  $request->dob,
                'sex_id'                    =>  $request->sex_id,
                'mother_tongue'             =>  $request->mother_tongue,
                'status'                    =>  $request->status,
                'fulladdress'               =>  $request->fulladdress,
                'country'                   =>  $request->country,
                'city'                      =>  $request->city,
                'phone'                     =>  $request->phone,
            ];
            $persondata = StudentAboard::create($data);
        }

        return $this->successResponse($persondata, Response::HTTP_CREATED);
    }

    private function updateStudentStatus($type, $student_id){
        if($type == 'school_leaving'){
            $app_data = [
                'IsTransferred' => '1',
            ];
        }
        if($type == 'reporting'){
            $app_data = [
                'IsRejoined' => '1',
            ];
        }
        Student::where('id', $student_id)->update($app_data);
        $response_data=Student::where('id', $student_id)->first();
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}
