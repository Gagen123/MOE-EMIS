<?php
namespace App\Http\Controllers\staff;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StaffSepSecController extends Controller{
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function saveSecondmentSeperation(Request $request){
        $rules = [
            'staff_id'              =>  'required',
            'start_date'            =>  'required',
            // 'end_date'              =>  'required',
        ];
        $customMessages = [
            'staff_id.required'     => 'Please select applicant',
            'start_date.required'   => 'This field is required',
            // 'end_date.required'     => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'staff_id'                          =>  $request->staff_id,
            'secondment_typ'                    =>  $request->secondment_typ,
            'seperation_type'                   =>  $request->seperation_type,
            'start_date'                        =>  $request->start_date,
            'end_date'                          =>  $request->end_date,
            'model'                             =>  $request->model,
            'agency'                            =>  $request->agency,
            'action_type'                       =>  $request->action_type,
            'remarks'                           =>  $request->remarks,
            'user_id'                           =>  $this->userId(),
        ];
       // dd( $request_data);
        $response_data= $this->apiService->createData('emis/staff/staffSepSecController/saveSecondmentSeperation', $request_data);
        return $response_data;
    }

    public function loadSecondment($type="",$model=""){
        $response_data= $this->apiService->listData('emis/staff/staffSepSecController/loadSecondment/'.$type.'/'.$model);
        return $response_data;
    }
    public function loadLeaveStaffList(){
        $response_data= $this->apiService->listData('emis/staff/staffSepSecController/loadLeaveStaffList');
        return $response_data;
    }
}
