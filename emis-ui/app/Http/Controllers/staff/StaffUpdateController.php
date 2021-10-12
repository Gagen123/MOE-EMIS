<?php

namespace App\Http\Controllers\staff;
use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StaffUpdateController extends Controller{
    public $apiService;
    use AuthUser;
    public $database_name="staff_db";
    public $table_name="transfer_application";
    public $service_name="Transfer";
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStaffcareerStage(Request $request){
        $rules = [
            'currier_stage'              =>  'required  ',
        ];
        $customMessages = [
            'currier_stage.required'     => 'Please select applicant',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'staff_id'                          =>  $request->staff_id,
            'currier_stage'                     =>  $request->currier_stage,
            'remarks'                           =>  $request->remarks,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffUpdateController/saveStaffcareerStage', $request_data);
        return $response_data;
    }

    public function saveStaffContactDetails(Request $request){
        $rules = [
            'currier_stage'              =>  'required  ',
        ];
        $customMessages = [
            'currier_stage.required'     => 'Please select applicant',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'staff_id'                          =>  $request->staff_id,
            'currier_stage'                     =>  $request->currier_stage,
            'remarks'                           =>  $request->remarks,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffUpdateController/saveStaffContactDetails', $request_data);
        return $response_data;
    }

    public function saveStaffMaritialStatus(Request $request){
        $rules = [
            'marital_status'              =>  'required  ',
        ];
        $customMessages = [
            'marital_status.required'     => 'Please select applicant',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'staff_id'                          =>  $request->staff_id,
            'marital_status'                     =>  $request->marital_status,
            'remarks'                           =>  $request->remarks,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffUpdateController/saveStaffMaritialStatus', $request_data);
        return $response_data;
    }

    public function saveStaffTeacherSubject(Request $request){
        $rules = [
            'currier_stage'              =>  'required  ',
        ];
        $customMessages = [
            'currier_stage.required'     => 'Please select applicant',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'staff_id'                          =>  $request->staff_id,
            'currier_stage'                     =>  $request->currier_stage,
            'remarks'                           =>  $request->remarks,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffUpdateController/saveStaffTeacherSubject', $request_data);
        return $response_data;
    }

    public function saveStaffRelativeDetails(Request $request){
        $rules = [
            'currier_stage'              =>  'required  ',
        ];
        $customMessages = [
            'currier_stage.required'     => 'Please select applicant',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'staff_id'                          =>  $request->staff_id,
            'currier_stage'                     =>  $request->currier_stage,
            'remarks'                           =>  $request->remarks,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffUpdateController/saveStaffRelativeDetails', $request_data);
        return $response_data;
    }
    public function saveSEN(Request $request){
        $request_data =[
            'id'                                =>  $request->id,
            'is_sen'                            =>  $request->is_sen,
            'is_trained_in_sen'                 =>  $request->is_trained_in_sen,
            'sen_remarks'                       =>  $request->sen_remarks,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffUpdateController/saveSEN', $request_data);
        return $response_data;
    }

    public function saveTeachinSubject(Request $request){
        $request_data =[
            'id'                                =>  $request->id,
            'comp_sub_id'                       =>  $request->comp_sub_id,
            'elective_sub_id1'                  =>  $request->elective_sub_id1,
            'elective_sub_id2'                  =>  $request->elective_sub_id2,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffUpdateController/saveTeachinSubject', $request_data);
        return $response_data;
    }

    public function saveStaffContact(Request $request){
        $request_data =[
            'id'                                =>  $request->id,
            'alternative_email'                 =>  $request->alternative_email,
            'contact_no'                        =>  $request->contact_no,
            'email'                             =>  $request->email,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffUpdateController/saveStaffContact', $request_data);
        return $response_data;
    }

  

}
