<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\StudentHistory;

class StudentUpdateController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveStudentUpdates(Request $request){

        $record_type = $request->record_type;

        $data =[
            'id'            =>  $request->id,
            'student'       =>  $request->student,
            'Remarks'       =>  $request->remarks,
            'record_type'   =>  $request->record_type,
            'action_type'   =>  $request->action_type,
            'user_id'       =>  $request->user_id
        ];

        switch($record_type){
            case "update_cid" : {
                    $additional_data = [
                        'cid'   => $request->cid
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateStudentCidDetails($data);
                    break;
                }
            case "update_contact" : {
                    $additional_data = [
                        'contact'   => $request->contact
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateStudentContactDetails($data);
                    break;
                }
            case "update_feeding" : {
                    $additional_data = [
                        'feeding'   => $request->feeding
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateStudentFeedingDetails($data);
                    break;
                }
            case "update_guardian" : {
                    $additional_data = [
                        'cid'   => $request->cid
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateStudentGuardianDetails($data);
                    break;
                }
            case "update_needy" : {
                    $additional_data = [
                        'needy'   => $request->needy
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateStudentNeedyDetails($data);
                    break;
                }
            case "update_scholarship" : {
                    $additional_data = [
                        'scholarship'   => $request->scholarship
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateStudentScholarshipDetails($data);
                    break;
                }
            case "update_sen" : {
                    $additional_data = [
                        'sen'   => $request->sen
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateStudentSenDetails($data);
                    break;
                }
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadStudentUpdatesList($param){
        // $id =$param;

        // $students = DB::table('std_student')
        //         ->where('std_student.OrgOrganizationId', $id)
        //         ->where('IsTransferred', '1')
        //         ->get();

        return $this->successResponse($students);
    }

    /**
     * Private Functions to update Student Details
     * here 'student' is the student id
     */

    private function updateStudentCidDetails($data){
        $student_detail=Student::where('id',$data['student'])->get('CidNo')->toArray();
        
        $student_history =[
            'StdStudentId'  =>  $data['student'],
            'historyFor'    =>  'Student CID Change',
            'previousValue' =>  $student_detail[0]['CidNo'],
            'Remarks'       =>  $data['Remarks']
        ];

        $history = $this->insertStudentHistory($student_history);

        $new_cid = [
            'CidNo' => $data['cid']
        ];

        $student = Student::where('id',$data['student'])->update($new_cid);
        return $this->successResponse($student);
    }

    private function updateStudentContactDetails($data){
        $students = Student::where('id',$data['id'])->update($data);
        return $students;
    }

    private function updateStudentGuardianDetails($data){
        $students = Student::where('id',$data['id'])->update($data);
        return $students;
    }

    private function updateStudentSenDetails($data){
        $students = Student::where('id',$data['id'])->update($data);
        return $students;
    }

    private function updateStudentFeedingDetails($data){
        $students = Student::where('id',$data['id'])->update($data);
        return $students;
    }

    private function updateStudentNeedyDetails($data){
        $students = Student::where('id',$data['id'])->update($data);
        return $students;
    }

    private function updateStudentScholarshipDetails($data){
        $students = Student::where('id',$data['id'])->update($data);
        return $students;
    }

    /**
     * Function to keep history
     */

    private function insertStudentHistory($student_data){
        $history = StudentHistory::create($student_data);
        return $this->successResponse($history);

    }

}
