<?php

namespace App\Http\Controllers\staff;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\CareerStage;
class StaffUpdateController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveStaffcareerStage(Request $request){
        $rules = [
            'currier_stage'              =>  'required  ',
        ];
        $customMessages = [
            'currier_stage.required'     => 'Please select applicant',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'currier_stage'             =>  $request->currier_stage,
            'remarks'                   =>  $request->remarks,
            'created_by'                =>  $request->user_id,
            'created_at'                =>  date('Y-m-d h:i:s')
        ];
        $response_data = CareerStage::create($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}
