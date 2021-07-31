<?php

namespace App\Http\Controllers\staff;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\CareerStage;
use App\Models\staff\CareerStageHistory;
use App\Models\staff\PersonalDetails;
use Illuminate\Support\Facades\DB;

class StaffUpdateController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public $audit_database;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
    }

    public function saveStaffcareerStage(Request $request){
        $rules = [
            'currier_stage'              =>  'required  ',
        ];
        $customMessages = [
            'currier_stage.required'     => 'Please select applicant',
        ];
        $this->validate($request, $rules,$customMessages);
        $curr_data = PersonalDetails::where('id',$request->id)->first();
        //insert into audit
        $messs_det=' cureer_stagge_id:'.$curr_data->cureer_stagge_id.'; currier_stage__remarks:'.$curr_data->currier_stage__remarks;
        DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','stf_staff','".$request->id."','".$messs_det."','".$request->user_id."','Currier Stage Edit')");

        $data =[
            'cureer_stagge_id'             =>  '$request->currier_stage',
            'currier_stage_remarks'        =>  $request->remarks,
        ];
        $response_data = PersonalDetails::where('id',$request->id)->update($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function saveSEN(Request $request){
        $curr_data = PersonalDetails::where('id',$request->id)->first();
        //insert into audit
        $messs_det=' is_sen:'.$curr_data->is_sen.'; is_trained_in_sen:'.$curr_data->is_trained_in_sen.'; curr_data:'.$curr_data->sen_remarks;
        DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','stf_staff','".$request->id."','".$messs_det."','".$request->user_id."','SEN Edit')");

        $data =[
            'is_sen'                    =>  $request->is_sen,
            'is_trained_in_sen'         =>  $request->is_trained_in_sen,
            'sen_remarks'               =>  $request->sen_remarks,
        ];
        $response_data = PersonalDetails::where('id',$request->id)->update($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function saveTeachinSubject(Request $request){
        $curr_data = PersonalDetails::where('id',$request->id)->first();
        //insert into audit
        $messs_det=' comp_sub_id:'.$curr_data->comp_sub_id.'; elective_sub_id1:'.$curr_data->elective_sub_id1.'; elective_sub_id2:'.$curr_data->elective_sub_id2;
        DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','stf_staff','".$request->id."','".$messs_det."','".$request->user_id."','Teachin Subject Edit')");

        $data =[
            'comp_sub_id'                   =>  $request->comp_sub_id,
            'elective_sub_id1'              =>  $request->elective_sub_id1,
            'elective_sub_id2'              =>  $request->elective_sub_id2,
        ];
        $response_data = PersonalDetails::where('id',$request->id)->update($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
<<<<<<< HEAD
=======

    public function saveStaffContact(Request $request){
        $curr_data = PersonalDetails::where('id',$request->id)->first();
        //insert into audit
        $messs_det=' email:'.$curr_data->email.'; alternative_email:'.$curr_data->alternative_email.'; contact_no:'.$curr_data->contact_no;
        DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','stf_staff','".$request->id."','".$messs_det."','".$request->user_id."','Contact Edit')");

        $data =[
            'email'                   =>  $request->email,
            'alternative_email'       =>  $request->alternative_email,
            'contact_no'              =>  $request->contact_no,
        ];
        $response_data = PersonalDetails::where('id',$request->id)->update($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
>>>>>>> a99f900cd9364cfd9493c0dfd5e7d0d7175517e4
}
