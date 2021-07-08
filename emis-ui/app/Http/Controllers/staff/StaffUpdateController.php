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
            'currier_stage'                     =>  $request->currier_stage,
            'remarks'                           =>  $request->remarks,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffUpdateController/saveStaffcareerStage', $request_data);
        return $response_data;
    }
}
