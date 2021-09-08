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
}
