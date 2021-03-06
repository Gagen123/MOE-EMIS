<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentAdmissionRelatedController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

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
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];

        // try{
            $response_data= $this->apiService->createData('emis/students/reportStudents', $data);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }

    }

    /**
     * load un reported students list by org id
     */

    public function loadUnreportedStudents($param){
        $org_id = $this->getWrkingAgencyId();
        $student_list = $this->apiService->listData('emis/students/loadUnreportedStudents/'.$org_id);
        return $student_list;
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
            'date'             => $request->date,
            'student'             => $request->student,
            'last_class_attended'             => $request->last_class_attended,
            'action_type'       => $request->action_type,
            'reasons'            => $request->reasons,
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];

        // try{
            $response_data= $this->apiService->createData('emis/students/saveStudentTransfer', $data);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // // }

    }

    public function loadStudentTransfers($param=""){
        $param= $this->getWrkingAgencyId();
        $data = $this->apiService->listData('emis/students/loadStudentTransfers/'.$param);
        return $data;
    }

    public function loadStudentTransfersDetail($id=""){
        $data = $this->apiService->listData('emis/students/loadStudentTransfersDetail/'.$id);
        return $data;
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
            'date'             => $request->date,
            'student'             => $request->student,
            'dropout'             => $request->dropout,
            'last_class_attended'             => $request->last_class_attended,
            'action_type'       => $request->action_type,
            'reasons'            => $request->reasons,
            'current_engagement'    => $request->current_engagement,
            'current_address'       => $request->current_address,
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];

        // try{
            $response_data= $this->apiService->createData('emis/students/saveStudentWhereabouts', $data);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }

    }

    public function loadStudentWhereabouts($param=""){
        $students = $this->apiService->listData('emis/students/loadStudentWhereabouts/'.$param);
        return $students;
    }

    /**
     * Update the admission request
     */

    public function updateAdmissionRequest(Request $request){
        $data = $request->all();
        $response_data= $this->apiService->createData('emis/students/admission/updateAdmissionRequest', $data);
        return $response_data;
    }

    /**
     * load the list of admission requests
     *
     * std_id = 0 to get all requests
     */

    public function loadAdmissionRequest($std_id=""){
        $dzo_id = $this->getUserDzoId();
        $response_data= $this->apiService->listData('emis/students/admission/loadAdmissionRequest/'.$std_id.'/'.$dzo_id);
        return $response_data;
    }

    public function getStudentAdmissionRequest($std_id=""){
        $response_data= $this->apiService->listData('emis/students/admission/getStudentAdmissionRequest/'.$std_id);
        return $response_data;
    }

    ///Student Residing Aboard
    //load function
    public function loadAboardList($orgId=""){
        if($orgId=="null" || $orgId==""){
            $orgId=$this->getWrkingAgencyId();
        }
        $loadlist = $this->apiService->listData('emis/students/loadAboardList/'.$orgId);
        return $loadlist;
    }
    //save function
    public function saveStudentAboard(Request $request){
        $rules = [
            'cid_passport'            =>  'required',
           // 'first_name'            =>  'required',
          //  'middle_name'           =>  'required',
          //  'last_name'             =>  'required',
            // 'dob'                   =>  'required',
            // 'sex_id'                =>  'required',
            // 'mother_tongue'         =>  'required',
            // 'status'                =>  'required',
            // 'fulladdress'           =>  'required','required|digits:10',
            // 'country'               =>  'required',
            // 'city'                  =>  'required',
            'phone'                    =>  'required|digits:8',
        ];
        $customMessages = [
            'cid_passport.required'      => 'cid_passport is required',
          // 'first_name.required'        => 'first_name is required',
          //  'middle_name.required'       => 'middle_name is required',
          // 'last_name'                  => 'last_name is required',
            // 'dob'                        => 'dob is required',
            // 'sex_id'                     => 'sex_id is required',
            // 'mother_tongue'              => 'mother_tongue is required',
            // 'status'                     => 'status is required',
            // 'fulladdress'                => 'fulladdress is required',
            // 'country'                    => 'country is required',
            // 'city'                       => 'city is required',
            'phone'                    =>  'Phone number should be of 8 digit',
        ];
        $this->validate($request, $rules, $customMessages);
        $personal_details =[
            'organizationId'             =>  $this->getWrkingAgencyId(),
            'cid_passport'               =>  $request->cid_passport,
            'first_name'                 =>  $request->first_name,
            'middle_name'                =>  $request->middle_name,
            'last_name'                  =>  $request->last_name,
            'dob'                        =>  $request->dob,
            'sex_id'                     =>  $request->sex_id,
            'mother_tongue'              =>  $request->mother_tongue,
            'status'                     =>  $request->status,
            'fulladdress'                =>  $request->fulladdress,
            'country'                    =>  $request->country,
            'city'                       =>  $request->city,
            'id'                         =>  $request->id,
            'phone'                      =>  $request->phone,
            'user_id'                    =>  $this->userId()

        ];
      // dd($personal_details);
        // try{
            $response_data= $this->apiService->createData('emis/students/saveStudentAboard', $personal_details);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
    }
}
