<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller{
    use ServiceHelper;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function savePersonalDetails(Request $request){
        $rules = [
            'emp_type'              =>  'required',
            'cid_no'                =>  'required',
            'full_name'             =>  'required',
            'position_title'        =>  'required',
            'working_agency'        =>  'required',
            'contact_number'        =>  'required',
            'email'                 =>  'required',
            'comp_sub'              =>  'required',
            'elective_sub1'         =>  'required',
            'currier_stage'         =>  'required',
            'emp_file_code'         =>  'required',
        ];
        $this->validate($request, $rules);
        $personal_details =[
            'emp_type'          =>  $request->emp_type,
            'cid_no'            =>  $request->cid_no,
            'full_name'         =>  $request->full_name,
            'position_title'    =>  $request->position_title,
            'working_agency'    =>  $request->working_agency,
            'contact_number'    =>  $request->contact_number,
            'email'             =>  $request->email,
            'comp_sub'          =>  $request->comp_sub,
            'elective_sub1'     =>  $request->elective_sub1,
            'elective_sub2'     =>  $request->elective_sub2,
            'currier_stage'     =>  $request->currier_stage,
            'emp_file_code'     =>  $request->emp_file_code,
            'remarks'           =>  $request->remarks,
        ];
        $response_data= $this->apiService->createData('emis/staff/savePersonalDetails', $personal_details);
        return $response_data;
    }
}
