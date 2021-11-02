<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\StudentGuardianDetails;
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
            'date'          =>  $request->date,
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
                        'change_for'    => $request->change_for,
                        'contact'       => $request->contact,
                        'email'         => $request->email,
                        'address'       => $request->address
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateStudentContactDetails($data);
                    break;
                }
            case "update_maritial_status" : {
                    $additional_data = [
                        'maritial_status'   => $request->maritial_status
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateParentsMaritialStatus($data);
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
            case "update_diet" : {
                    $additional_data = [
                        'diet'   => $request->diet
                    ];
                    $data = $data + $additional_data;
                    $response_data = $this->updateStudentDietaryDetails($data);
                    break;
                }
            case "update_guardian" : {
                    $additional_data = [
                        'snationality'    => $request->snationality,
                        'cid_passport'    => $request->cid_passport,
                        'first_name'      => $request->first_name,
                        'middle_name'     => $request->middle_name,
                        'last_name'       => $request->last_name,
                        'dob'             => $request->dob,
                        'dzongkhag'       => $request->dzongkhag,
                        'gewog'           => $request->gewog,
                        'village_id'      => $request->village_id
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

        if($data['action_type']=='add'){
            $history = $this->insertStudentHistory($student_history);
        }

        $new_cid = [
            'CidNo' => $data['cid']
        ];

        $student = Student::where('id',$data['student'])->update($new_cid);
        return $this->successResponse($student);
    }

    private function updateStudentContactDetails($data){
        $student_detail=StudentGuardianDetails::where('StdStudentId',$data['student'])->get()->toArray();
        // dd($student_detail);
        $previousValue = "";
        $new_data = [];
        if($student_detail!=null && $student_detail!=""){
            if($data['action_type']=='add'){
                if($data['address'] != null){
                    $previousValue .= $student_detail[0]['WorkAddress'];
                    $new_address = [
                        'WorkAddress' => $data['address']
                    ];
                    $new_data = $new_data + $new_address;
                }
                if($data['contact'] != null){
                    $previousValue .= '/'.$student_detail[0]['ContactNo'];
                    $new_contact = [
                        'ContactNo' => $data['contact']
                    ];
                    $new_data = $new_data + $new_contact;
                }
                if($data['email'] != null){
                    $previousValue .= '/'.$student_detail[0]['Email'];
                    $new_email = [
                        'Email' => $data['email']
                    ];
                    $new_data = $new_data + $new_email;
                }
                $student_history =[
                    'StdStudentId'  =>  $data['student'],
                    'date'          =>  $data['date'],
                    'historyFor'    =>  'Change in Parent Contact',
                    'previousValue' =>  $previousValue,
                    'Remarks'       =>  $data['Remarks']
                ];
                    $history = $this->insertStudentHistory($student_history);
                }
                $student = StudentGuardianDetails::where('StdStudentId', $data['student'])->where('Relationship', $data['change_for'])->update($new_data);

            }
        else{
            return null;
            // $new_rec = [
            //     'StdStudentId' => $data['student'],
            //     'Relationship' => $data['change_for']
            // ];
            // $new_data = $new_data + $new_rec;
            // $student = StudentGuardianDetails::create($new_data);

        }
        return $this->successResponse($student);
    }

    private function updateParentsMaritialStatus($data){
        $student_detail=StudentGuardianDetails::where('StdStudentId',$data['student'])->get()->toArray();

        //added if condition since it is giving the issue when the studentId is not there in studentguardian tables
        if($student_detail!=null && $student_detail!=""){
            $student_history =[
                'StdStudentId'  =>  $data['student'],
                'date'          =>  $data['date'],
                'historyFor'    =>  'Parents Maritial Status Change',
                'previousValue' =>  $student_detail[0]['MaritialStatus'],
                'Remarks'       =>  $data['Remarks']
            ];
    
            if($data['action_type']=='add'){
                $history = $this->insertStudentHistory($student_history);
            }
    
            $new_data = [
                'MaritialStatus' => $data['maritial_status']
            ];
    
            $student = StudentGuardianDetails::where('StdStudentId',$data['student'])->update($new_data);
        }
        else{
            return null;
        }
       
        return $this->successResponse($student);
    }

    private function updateStudentGuardianDetails($data){
        $students = Student::where('id',$data['id'])->update($data);
        if($students!=null && $students!=""){
            return $students;
        }
        else {
            return null;
        }
    }

    private function updateStudentSenDetails($data){
        $student_detail=Student::where('id',$data['student'])->get('isSen')->toArray();
            if($student_detail!=""|| $student_detail!=""){
                $student_history =[
                    'StdStudentId'  =>  $data['student'],
                    'date'          =>  $data['date'],
                    'historyFor'    =>  'Student SEN Change',
                    'previousValue' =>  $student_detail[0]['isSen'],
                    'Remarks'       =>  $data['Remarks']
                ];
        
                if($data['action_type']=='add'){
                    $history = $this->insertStudentHistory($student_history);
                }
        
                $new_data = [
                    'isSen' => $data['sen']
                ];
        
                $student = Student::where('id',$data['student'])->update($new_data);
            }
            else{
                return null;
            }
       
        return $this->successResponse($student);
    }

    private function updateStudentFeedingDetails($data){
        $student_detail=Student::where('id',$data['student'])->get('noOfMeals')->toArray();
        if($student_detail!=null && $student_detail!=""){
            $student_history =[
                'StdStudentId'  =>  $data['student'],
                'date'          =>  $data['date'],
                'historyFor'    =>  'Student Feeding Change',
                'previousValue' =>  $student_detail[0]['noOfMeals'],
                'Remarks'       =>  $data['Remarks']
            ];
    
            if($data['action_type']=='add'){
                $history = $this->insertStudentHistory($student_history);
            }
    
            $new_data = [
                'noOfMeals' => $data['feeding']
            ];
    
            $student = Student::where('id',$data['student'])->update($new_data);
        }
        else{
            return null;
        }
        
        return $this->successResponse($student);
    }

    private function updateStudentDietaryDetails($data){
        $student_detail=Student::where('id',$data['student'])->get('dietType')->toArray();
        if($student_detail!=null && $student_detail!=""){
            $student_history =[
                'StdStudentId'  =>  $data['student'],
                'date'          =>  $data['date'],
                'historyFor'    =>  'Student Dietary Change',
                'previousValue' =>  $student_detail[0]['dietType'],
                'Remarks'       =>  $data['Remarks']
            ];
    
            if($data['action_type']=='add'){
                $history = $this->insertStudentHistory($student_history);
            }
    
            $new_data = [
                'dietType' => $data['diet']
            ];
    
            $student = Student::where('id',$data['student'])->update($new_data);
        }
        else{
            return null;
        }
        
        return $this->successResponse($student);
    }

    private function updateStudentNeedyDetails($data){
        $student_detail=Student::where('id',$data['student'])->get('isNeedy')->toArray();
        if( $student_detail!=null &&  $student_detail!=""){
            $student_history =[
                'StdStudentId'  =>  $data['student'],
                'date'          =>  $data['date'],
                'historyFor'    =>  'Student Needy Status Change',
                'previousValue' =>  $student_detail[0]['isNeedy'],
                'Remarks'       =>  $data['Remarks']
            ];
    
            if($data['action_type']=='add'){
                $history = $this->insertStudentHistory($student_history);
            }
    
            $new_data = [
                'isNeedy' => $data['needy']
            ];
            $student = Student::where('id',$data['student'])->update($new_data);
        }
        else{
            return null;
        }
        return $this->successResponse($student);
    }

    private function updateStudentScholarshipDetails($data){
        $student_history =[
            'StdStudentId'  =>  $data['student'],
            'date'          =>  $data['date'],
            'historyFor'    =>  'Student Scholarship Details',
            'Remarks'       =>  $data['Remarks']
        ];
        if($data['action_type']=='add'){
            $history = $this->insertStudentHistory($student_history);
        }
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

    /**
     * To load the list depending on param
     */

    public function loadStudentUpdatesList($param="", $org_id=""){
        switch($param){
            case "cid" : {
                    $students = $this->loadStudentCidDetails($org_id);
                    break;
                }
            case "contact" : {
                    $students = $this->loadStudentContactDetails($org_id);
                    break;
                }
            case "maritial_status" : {
                    $students = $this->loadParentsMaritialStatus($org_id);
                    break;
                }
            case "feeding" : {
                    $students = $this->loadStudentFeedingDetails($org_id);
                    break;
                }
            case "diet" : {
                    $students = $this->loadStudentDietaryDetails($org_id);
                    break;
                }
            case "guardian" : {
                    $students = $this->loadStudentGuardianDetails($org_id);
                    break;
                }
            case "needy" : {
                    $students = $this->loadStudentNeedyDetails($org_id);
                    break;
                }
            case "scholarship" : {
                    $students = $this->loadStudentScholarshipDetails($org_id);
                    break;
                }
            case "sen" : {
                    $students = $this->loadStudentSenDetails($org_id);
                    break;
                }
        }

        return $this->successResponse($students);
    }

    /**
     * Private functions to load data
     */

    private function loadStudentCidDetails($org_id){

        $students = DB::table('std_student')
                ->join('std_student_history', 'std_student.id', '=', 'std_student_history.StdStudentId')
                ->select('std_student.Name','std_student.student_code', 'std_student.CidNo','std_student_history.id', 'std_student_history.StdStudentId',
                            'std_student_history.historyFor','std_student_history.previousValue', 'std_student_history.Remarks', 'std_student_history.date')
                ->where('std_student.OrgOrganizationId', $org_id)
                ->where('historyFor', 'Student CID Change')
                ->get();

        return $students;
    }
      private function loadStudentScholarshipDetails($org_id){
        $students = DB::table('std_student')
                ->join('std_student_history', 'std_student.id', '=', 'std_student_history.StdStudentId')
                ->select('std_student.Name','std_student.student_code', 'std_student.CidNo','std_student_history.id', 'std_student_history.StdStudentId',
                            'std_student_history.historyFor','std_student_history.previousValue', 'std_student_history.Remarks', 'std_student_history.date')
                ->where('std_student.OrgOrganizationId', $org_id)
                ->where('historyFor', 'Student Scholarship Details')
                ->get();

        return $students;
    }



    private function loadStudentContactDetails($org_id){

        $students = DB::table('std_student')
                ->join('std_student_history', 'std_student.id', '=', 'std_student_history.StdStudentId')
                ->join('std_student_guardian', 'std_student.id', '=', 'std_student_guardian.StdStudentId')
                ->select('std_student.Name as StudentName','std_student.student_code', 'std_student_guardian.*', 'std_student_history.StdStudentId',
                            'std_student_history.historyFor','std_student_history.previousValue', 'std_student_history.Remarks', 'std_student_history.date')
                ->where('std_student.OrgOrganizationId', $org_id)
                ->where('historyFor', 'Change in Parent Contact')
                ->get();

        return $students;
    }

    private function loadParentsMaritialStatus($org_id){
        $students = DB::table('std_student')
                ->join('std_student_history', 'std_student.id', '=', 'std_student_history.StdStudentId')
                ->join('std_student_guardian', 'std_student.id', '=', 'std_student_guardian.StdStudentId')
                ->select('std_student.Name as StudentName','std_student.student_code', 'std_student_guardian.*', 'std_student_history.StdStudentId',
                            'std_student_history.historyFor','std_student_history.previousValue', 'std_student_history.Remarks', 'std_student_history.date')
                ->where('std_student.OrgOrganizationId', $org_id)
                ->where('historyFor', 'Parents Maritial Status Change')
                ->get();

        return $students;
    }

    private function loadStudentFeedingDetails($org_id){

        $students = DB::table('std_student')
                ->join('std_student_history', 'std_student.id', '=', 'std_student_history.StdStudentId')
                ->select('std_student.Name','std_student.student_code', 'std_student.noOfMeals','std_student_history.id', 'std_student_history.StdStudentId',
                            'std_student_history.historyFor','std_student_history.previousValue', 'std_student_history.Remarks', 'std_student_history.date')
                ->where('std_student.OrgOrganizationId', $org_id)
                ->where('historyFor', 'Student Feeding Change')
                ->get();

        return $students;
    }

    private function loadStudentDietaryDetails($org_id){

        $students = DB::table('std_student')
                ->join('std_student_history', 'std_student.id', '=', 'std_student_history.StdStudentId')
                ->select('std_student.Name','std_student.student_code', 'std_student.dietType','std_student_history.id', 'std_student_history.StdStudentId',
                            'std_student_history.historyFor','std_student_history.previousValue', 'std_student_history.Remarks', 'std_student_history.date')
                ->where('std_student.OrgOrganizationId', $org_id)
                ->where('historyFor', 'Student Dietary Change')
                ->get();

        return $students;
    }


    private function loadStudentNeedyDetails($org_id){

        $students = DB::table('std_student')
                ->join('std_student_history', 'std_student.id', '=', 'std_student_history.StdStudentId')
                ->select('std_student.Name','std_student.student_code', 'std_student.isNeedy','std_student_history.id', 'std_student_history.StdStudentId',
                            'std_student_history.historyFor','std_student_history.previousValue', 'std_student_history.Remarks', 'std_student_history.date')
                ->where('std_student.OrgOrganizationId', $org_id)
                ->where('historyFor', 'Student Needy Status Change')
                ->get();

        return $students;
    }

    private function loadStudentSenDetails($org_id){

        $students = DB::table('std_student')
                ->join('std_student_history', 'std_student.id', '=', 'std_student_history.StdStudentId')
                ->select('std_student.Name','std_student.student_code', 'std_student.isSen','std_student_history.id', 'std_student_history.StdStudentId',
                            'std_student_history.historyFor','std_student_history.previousValue', 'std_student_history.Remarks', 'std_student_history.date')
                ->where('std_student.OrgOrganizationId', $org_id)
                ->where('historyFor', 'Student SEN Change')
                ->get();

        return $students;
    }

}
