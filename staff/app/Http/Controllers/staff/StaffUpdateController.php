<?php

namespace App\Http\Controllers\staff;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\CareerStage;
use App\Models\staff\CareerStageHistory;

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
        $curr_det=CareerStage::where('staff_id',$request->staff_id)->first();
        if($curr_det!=null && $curr_det!=""){
            $his_data=[
                'id'                        =>  $curr_det->id,
                'staff_id'                  =>  $curr_det->staff_id,
                'currier_stage'             =>  $curr_det->currier_stage,
                'remarks'                   =>  $curr_det->remarks,
                'created_by'                =>  $curr_det->created_by,
                'created_at'                =>  $curr_det->created_at,
                'updated_by'                =>  $curr_det->updated_by,
                'updated_at'                =>  $curr_det->updated_at,
                'recorded_by'               =>  $request->user_id,
                'recorded_at'               =>  date('Y-m-d h:i:s')
            ];
            CareerStageHistory::create($his_data);

            $data =[
                'currier_stage'             =>  $request->currier_stage,
                'remarks'                   =>  $request->remarks,
                'updated_by'                =>  $request->user_id,
                'updated_at'                =>  date('Y-m-d h:i:s')
            ];
            $response_data = CareerStage::where('staff_id',$request->staff_id)->update($data);
        }
        else{
            $data =[
                'staff_id'                  =>  $request->staff_id,
                'currier_stage'             =>  $request->currier_stage,
                'remarks'                   =>  $request->remarks,
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
            ];
            $response_data = CareerStage::create($data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}