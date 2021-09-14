<?php
namespace App\Http\Controllers\staff;
use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use Illuminate\Http\Request;
class SubstitutionController extends Controller{
    public $apiService;
    use AuthUser;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function savestaff(Request $request){
        $rules = [
            'cid'                   =>  'required | digits:11',
            'name'                  =>  'required  ',
            'dob'                   =>  'required  ',
            'gender'                =>  'required  ',
            'dzongkhag'             =>  'required  ',
            'contact'               =>  'required | numeric|digits:8',
            'email'                 =>  'required | email ',
            'qualification'         =>  'required  ',
        ];
        $customMessages = [
            'cid.required'          => 'Please provide CID',
            'cid.digits'            => 'Please provide 11 digit CID',
            'name.required'         => 'name is required',
            'dob.required'          => 'dob is required',
            'gender.required'       => 'gender is required',
            'dzongkhag.required'    => 'dzongkhag is required',
            'contact.required'      => 'contact is required',
            'contact.numeric'       => 'contact should be numeric',
            'contact.digits'        => 'contact should be 8 digit',
            'email.required'        => 'email is required',
            'qualification.required'=> 'qualification is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $request['user_id']=$this->userId();
        $response_data= $this->apiService->createData('emis/staff/substitution/savestaff', $request->all());
        return $response_data;
    }

    public function loadStaff($type="",$model=""){
        $response_data= $this->apiService->listData('emis/staff/substitution/loadStaff/'.$type.'/'.$model);
        return $response_data;
    }
    
    public function loadsubstitutestaff(){
        $response_data= $this->apiService->listData('emis/staff/substitution/loadsubstitutestaff/');
        return $response_data;
    }
    public function saveStaffSubstituted(Request $request){
        $rules = [
            'staff_id'              =>  'required',
            'start_date'            =>  'required',
            'subsTeacher'           =>  'required',
            'teaching_subject'      =>  'required',
            // 'end_date'              =>  'required',
        ];
        $customMessages = [
            'staff_id.required'                 => 'Please select applicant',
            'start_date.required'               => 'This field is required',
            'subsTeacher.required'              => 'This field is required',
            'teaching_subject.required'         => 'This field is required',
            // 'end_date.required'     => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'staff_id'                          =>  $request->staff_id,
            'subsTeacher'                       =>  $request->subsTeacher,
            'teaching_subject'                  =>  $request->teaching_subject,
            'start_date'                        =>  $request->start_date,
            'end_date'                          =>  $request->end_date,
            'isextended'                        =>  $request->isextended,
            'model'                             =>  $request->model,
            'action_type'                       =>  $request->action_type,
            'remarks'                           =>  $request->remarks,
            'user_id'                           =>  $this->userId(),
        ];
       // dd( $request_data);
        $response_data= $this->apiService->createData('emis/staff/substitution/saveStaffSubstituted', $request_data);
        return $response_data;
    }
    public function loadSubstaff(){
        //dd('m here');
        $response_data= $this->apiService->listData('emis/staff/substitution/loadSubstaff');
        return $response_data;
    }
    public function getEditSubstitutedList($subid=""){
        //dd('m here');
        $response_data= $this->apiService->listData('emis/staff/substitution/getEditSubstitutedList/'.$subid);
        return $response_data;
    }
}   

