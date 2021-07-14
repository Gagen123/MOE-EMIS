<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentUpdateController extends Controller{

    use ServiceHelper;
    use AuthUser;
    public $apiService;
    
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentUpdates(Request $request){

        $record_type = $request->record_type;

        $rules = [
            'student'       =>  'required'
        ];

        $customMessages = [
            'student.required'  => 'This field is required'
        ];

        $data =[
            'id'            =>  $request->id,
            'student'       =>  $request->student,
            'remarks'       =>  $request->remarks,
            'record_type'   =>  $request->record_type,
            'action_type'   =>  $request->action_type,
            'user_id'       =>  $this->userId()
        ];

        switch($record_type){
            case "update_cid" : {
                    $additional_rules =[
                        'cid'   =>  'required|min:11|max:11'
                    ];
                    $additional_messages=[
                        'cid.required'  => 'This field is required'
                    ];
                    $additional_data = [
                        'cid'   => $request->cid
                    ];
                    break;
                }
            case "update_contact" : {
                    $additional_rules =[
                        'change_for'   =>  'required'
                    ];
                    $additional_messages=[
                        'change_for.required'  => 'This field is required'
                    ];
                    $additional_data = [
                        'change_for'    => $request->change_for,
                        'address'       => $request->address,
                        'email'         => $request->email,
                        'contact'       => $request->contact
                    ];
                    break;
                }
            case "update_maritial_status" : {
                    $additional_rules =[
                        'maritial_status'   =>  'required'
                    ];
                    $additional_messages=[
                        'maritial_status.required'  => 'This field is required'
                    ];
                    $additional_data = [
                        'maritial_status'   => $request->maritial_status
                    ];
                    break;
                }
            case "update_feeding" : {
                    $additional_rules =[
                        'feeding'   =>  'required'
                    ];
                    $additional_messages=[
                        'feeding.required'  => 'This field is required'
                    ];
                    $additional_data = [
                        'feeding'   => $request->feeding
                    ];
                    break;
                }
            case "update_diet" : {
                    $additional_rules =[
                        'diet'   =>  'required'
                    ];
                    $additional_messages=[
                        'diet.required'  => 'This field is required'
                    ];
                    $additional_data = [
                        'diet'   => $request->diet
                    ];
                    break;
                }
            case "update_guardian" : {
                    $additional_rules =[
                        'cid'   =>  'required'
                    ];
                    $additional_messages=[
                        'cid.required'  => 'This field is required'
                    ];
                    $additional_data = [
                        'cid'   => $request->cid
                    ];
                    break;
                }
            case "update_needy" : {
                    $additional_rules =[
                        'needy'   =>  'required'
                    ];
                    $additional_messages=[
                        'needy.required'  => 'This field is required'
                    ];
                    $additional_data = [
                        'needy'   => $request->needy
                    ];
                    break;
                }
            case "update_scholarship" : {
                    $additional_rules =[
                        'scholarship'   =>  'required'
                    ];
                    $additional_messages=[
                        'scholarship.required'  => 'This field is required'
                    ];
                    $additional_data = [
                        'scholarship'   => $request->scholarship
                    ];
                    break;
                }
            case "update_sen" : {
                    $additional_rules =[
                        'sen'   =>  'required'
                    ];
                    $additional_messages=[
                        'sen.required'  => 'This field is required'
                    ];
                    $additional_data = [
                        'sen'   => $request->sen
                    ];
                    break;
                }
        }
        
        $rules = $rules + $additional_rules;
        $customMessages = $customMessages + $additional_messages;

        $this->validate($request, $rules, $customMessages);

        $data = $data + $additional_data;

        $response_data= $this->apiService->createData('emis/students/saveStudentUpdates', $data);
        return $response_data;
        
    }

    public function loadStudentUpdatesList($param=""){
        $org_id = $this->getWrkingAgencyId();
        $student_list = $this->apiService->listData('emis/students/loadStudentUpdatesList/'.$param.'/'.$org_id);
        return $student_list;
    }
    
}
