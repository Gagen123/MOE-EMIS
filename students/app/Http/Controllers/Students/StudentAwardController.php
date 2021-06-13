<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\CeaStudentAward;
use App\Models\Students\Student;

class StudentAwardController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update student awards
    */

    public function saveStudentAward(Request $request){
        $id = $request->id;
        if( $id != null){
            $rules = [
                'student'       => 'required',
                'award_given_by'=> 'required',
                'award_type_id' => 'required',
                'place'         => 'required',
                'date'          => 'required'
            ];
            $customMessages = [
                'student.required'          => 'This field is required',
                'award_given_by.required'   => 'This field is required',
                'award_type_id.required'    => 'This field is required',
                'place.required'            => 'This field is required',
                'date.required'             => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);
    
            $data =[
                'id'                => $request->id,
                'StdStudentId'           =>  $request->student,
                'AwardedBy'    =>  $request->award_given_by,
                'CeaAwardId'     =>  $request->award_type_id,
                'Place'             =>  $request->place,
                'AwardDate'              =>  $request->date,
                'Remarks'           =>  $request->remarks,
                'actiontype'        =>  $request->actiontype,
                'recordtype'        =>  $request->recordtype, 
                //'user_id'           => $this->user_id() 
            ];
            $response_data = CeaStudentAward::where('id', $id)->update($data);

        }else{
            $rules = [
                'student'       => 'required',
                'award_given_by'=> 'required',
                'award_type_id' => 'required',
                'place'         => 'required',
                'date'          => 'required'
            ];
            $customMessages = [
                'student.required'          => 'This field is required',
                'award_given_by.required'   => 'This field is required',
                'award_type_id.required'    => 'This field is required',
                'place.required'            => 'This field is required',
                'date.required'             => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);

            $data =[
                'id'                => $request->id,
                'StdStudentId'           =>  $request->student,
                'AwardedBy'    =>  $request->award_given_by,
                'CeaAwardId'     =>  $request->award_type_id,
                'Place'             =>  $request->place,
                'AwardDate'              =>  $request->date,
                'Remarks'           =>  $request->remarks,
                'actiontype'        =>  $request->actiontype,
                'recordtype'        =>  $request->recordtype, 
                //'user_id'           => $this->user_id() 
            ];
            $response_data = CeaStudentAward::create($data);
         }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    //     if($request->actiontype=="add"){
    //         $response_data = CeaStudentAward::create($data);

    //     } else if($request->actiontype=="edit"){

    //         //Audit Trails
    //         // $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
    //         // $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','master_working_agency','".$request['id']."','".$msg_det."','".$request->input('user_id')."','Edit')");

    //         $app_data = [
    //             'StdStudentId' => $request['student'],
    //             'awarded_by'    =>  $request['award_given_by'],
    //             'CeaAwardId'     =>  $request['award_type_id'],
    //             'Place'             =>  $request['place'],
    //             'AwardDate'              =>  $request['date'],
    //             'Remarks'           =>  $request['remarks'],
    //         ];

    //         CeaStudentAward::where('id', $request['id'])->update($app_data);
    //     }

    //     return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    // }

    /**
     * method to list students masters
    */

    public function loadStudentAwards($param=""){

        $id =$param;

        $awards = DB::table('cea_student_award')
                ->join('std_student', 'cea_student_award.StdStudentId', '=', 'std_student.id')
                ->join('cea_award', 'cea_student_award.CeaAwardId', '=', 'cea_award.id')
                ->select('cea_student_award.*', 'std_student.Name','cea_award.name AS award_name')
                ->where('std_student.OrgOrganizationId', $id)
                ->get();
        
        return $this->successResponse($awards);

    }

    /**
     * Function to insert data into the respective tables
     */

    private function updateData($dataRequest, $databaseModel){

        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();

        $data = $model::find($dataRequest['id']);

        //Audit Trails
        // $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
        // $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','master_working_agency','".$request['id']."','".$msg_det."','".$request->input('user_id')."','Edit')");
        
        //data to be updated
        $data->name = $dataRequest['name'];
        $data->description = $dataRequest['description'];
        $data->status = $dataRequest['status'];
        $data->updated_by = $dataRequest['created_by'];
        $data->updated_at = date('Y-m-d h:i:s');
        $data->update();
        
        return $data;

    }    
}
