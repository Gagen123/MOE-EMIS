<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StaffController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function savePersonalDetails(Request $request){
        $rules = [
            'emp_type'              =>  'required',
            'cid_work_permit'       =>  'required',
            'name'                  =>  'required',
            'sex_id'                =>  'required',
            'position_title'        =>  'required',
            'working_agency_id'     =>  'required',
            'contact_number'        =>  'required',
            'email'                 =>  'required',
            'comp_sub'              =>  'required',
            'elective_sub1'         =>  'required',
            'currier_stage'         =>  'required',
            'emp_file_code'         =>  'required',
        ];
        $customMessages = [
            'cid_work_permit.required' => 'This field is required',
            'name.required' => 'This field is required',
            'sex_id.required' => 'This field is required',
            'position_title.required' => 'This field is required',
            'working_agency_id.required' => 'This field is required',
            'contact_number.required' => 'This field is required',
            'email.required' => 'This field is required',
            'comp_sub.required' => 'This field is required',
            'elective_sub1.required' => 'This field is required',
            'currier_stage.required' => 'This field is required',
            'emp_file_code.required' => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        
        $personal_details =[
            'personal_id'       =>  $request->personal_id,
            'emp_type'          =>  $request->emp_type,
            'cid_work_permit'   =>  $request->cid_work_permit,
            'name'              =>  $request->name,
            'position_title'    =>  $request->position_title,
            'sex_id'            =>  $request->sex_id,
            'country_id'        =>  $request->country_id,
            'village_id'        =>  $request->village_id,
            'address'           =>  $request->address,
            'working_agency_id' =>  $request->working_agency_id,
            'working_agency'    =>  $request->working_agency,
            'contact_number'    =>  $request->contact_number,
            'email'             =>  $request->email,
            'comp_sub'          =>  $request->comp_sub,
            'elective_sub1'     =>  $request->elective_sub1,
            'elective_sub2'     =>  $request->elective_sub2,
            'currier_stage'     =>  $request->currier_stage,
            'emp_file_code'     =>  $request->emp_file_code,
            'remarks'           =>  $request->remarks,
            'user_id'           =>$this->user_id() 
        ];
        $response_data= $this->apiService->createData('emis/staff/savePersonalDetails', $personal_details);
        return $response_data;
    }
    public function loaddraftpersonalDetails(Request $request){
        $response_data= $this->apiService->listData('emis/staff/loaddraftpersonalDetails/'.$this->user_id());
        return $response_data;
    }
    
}
