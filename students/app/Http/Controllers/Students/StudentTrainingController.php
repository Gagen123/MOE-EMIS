<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Students\CeaStudentTraining;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\CeaTrainingParticipant;
use Exception;
use PhpParser\Node\Stmt\Else_;

class StudentTrainingController extends Controller
{
    use ApiResponser;

    public $database="student_db";
    public $audit_table="system_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveStudentTraining(Request $request){
        $rules = [
            'name'            => 'required',
            'training_type'   => 'required',
            'program'         => 'required',
            'place'           => 'required',
            'country'         => 'required',
            'from_date'       => 'required',
            'to_date'         => 'required'
        ];
        $customMessages = [
            'name.required'           => 'This field is required',
            'place.required'          => 'This field is required',
            'training_type.required'  => 'This field is required',
            'program.required'        => 'This field is required',
            'country.required'        => 'This field is required',
            'from_date.required'      => 'This field is required',
            'to_date.required'        => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'OrgId'             => $request->org_id,
            'TrainingTypeName'  => $request->name,
            'Place'             => $request->place,
            'CeaTrainingId'     => $request->training_type,
            'CeaProgrammeId'    => $request->program,
            'CmnCountryId'      => $request->country,
            'FromDate'          => $request->from_date,
            'ToDate'            => $request->to_date,
            'DetailsOfTraining' => $request->details,
            'created_at'        => date('Y-m-d h:i:s'),
            'created_by'        => $request->user_id 
        ];
        if($request->form_type == "add"){
            $data =[
                'OrgId'             => $request->org_id,
                'TrainingTypeName'  => $request->name,
                'Place'             => $request->place,
                'CeaTrainingId'     => $request->training_type,
                'CeaProgrammeId'    => $request->program,
                'CmnCountryId'      => $request->country,
                'FromDate'          => $request->from_date,
                'ToDate'            => $request->to_date,
                'DetailsOfTraining' => $request->details,
                'created_at'        => date('Y-m-d h:i:s'),
                'created_by'        => $request->user_id 
            ];
            $response_data = CeaStudentTraining::create($data);
      
        }
        if($request->form_type=="edit"){
            $data = CeaStudentTraining::find($request->id);
            $messs_det='OrgId:'.$data->OrgId.'; TrainingTypeName:'.$data->TrainingTypeName.'; Place:'.$data->Place.'; CeaTrainingId:'.$data->CeaTrainingId.'; CeaProgrammeId:'.$data->CeaProgrammeId.'; CmnCountryId:'.$data->CmnCountryId.'; FromDate:'.$data->FromDate.'; ToDate:'.$data->ToDate.'; DetailsOfTraining:'.$data->DetailsOfTraining.'; created_at:'.$data->created_at;
            $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','cea_student_training','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
            $data->OrgId = $request['org_id'];
            $data->TrainingTypeName = $request['name'];
            $data->Place = $request['place'];
            $data->CeaTrainingId = $request['training_type'];
            $data->CeaProgrammeId = $request['program'];
            $data->CmnCountryId = $request['country'];
            $data->FromDate = $request['from_date'];
            $data->ToDate = $request['to_date'];
            $data->DetailsOfTraining = $request['details'];
            $data->created_at = $request['created_at'];
            $data->update();
            $response_data = $data;
        }
    
       return $this->successResponse($response_data);
    }
    
    /*
    * Function is to list Trainings for drop down
    */

    public function listStudentTrainings($param,$orgId){
        $records = DB::select('SELECT t1.id, t1.TrainingTypeName AS Name,t1.CeaTrainingId,t1.CeaProgrammeId,t1.DetailsOfTraining,t1.CmnCountryId,t2.Name AS TrainingTypeName, t3.Name AS Program, t1.FromDate, t1.ToDate, t1.Place FROM cea_student_training t1 JOIN cea_training_type t2 ON t1.CeaTrainingId = t2.id JOIN cea_programme t3 ON t1.CeaProgrammeId = t3.id WHERE OrgId = ?',[$orgId]);
        return $this->successResponse($records);
    }
    public function saveTrainingParticipants(Request $request){
        $rules = [
            'training_id' => 'required',
        ];
        $customMessages = [
            'training_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        if($request->form_type=="add"){
            $data =[];
            foreach($request->student_id as $index => $studentId){
                $data[$index]['OrgId'] = $request->org_id;
                $data[$index]['CeaStudentTrainingId'] = $request->training_id;
                $data[$index]['Remarks'] = $request->remarks;
                $data[$index]['StdStudentId'] =$studentId;
                $data[$index]['created_at'] = date('Y-m-d h:i:s');
                $data[$index]['created_by'] = $request->user_id;
            }
            foreach($data as $std){
                $response_data =   CeaTrainingParticipant::create($std);
            }
        }
        if($request->form_type=="edit"){
            $data = CeaTrainingParticipant::find($request->id);
            if($request->participant==false){
                $messs_det='OrgId:'.$data->OrgId.'; CeaStudentTrainingId:'.$data->CeaStudentTrainingId.'; StdStudentId:'.$data->StdStudentId.'; Remarks:'.$data->Remarks.'; created_at:'.$data->created_at;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','cea_student_training_participant','".$request['id']."','".$messs_det."','".$request['user_id']."','DELETE')");
                DB::delete('DELETE FROM cea_student_training_participant WHERE id = ? AND StdStudentId = ?  ',[$request['id'],$request['student_id']]);
                $response_data = "deleted!";
            }else{
                $messs_det='OrgId:'.$data->OrgId.'; CeaStudentTrainingId:'.$data->CeaStudentTrainingId.'; StdStudentId:'.$data->StdStudentId.'; Remarks:'.$data->Remarks.'; created_at:'.$data->created_at;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','cea_student_training_participant','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->OrgId = $request['org_id'];
                $data->CeaStudentTrainingId = $request['training_id'];
                $data->StdStudentId = $request['student_id'];
                $data->Remarks = $request['remarks'];
                $data->created_at = $request['created_at'];
                $data->update();
                $response_data = $data;
            }
            
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    public function listTrainingParticipants($param,$orgId){
        $records = DB::select('SELECT t1.id,t2.id AS std_student_id,t3.id AS training_id, t2.Name AS student_name, t6.OrgClassStreamId,t6.SectionDetailsId, t3.TrainingTypeName AS training, t4.Name AS training_type, t5.Name AS program, t3.FromDate AS fromdate, t3.ToDate AS todate,t3.Place, t3.CmnCountryId,t1.Remarks
            FROM cea_student_training_participant t1 
            JOIN std_student t2 ON t1.StdStudentId = t2.id 
            LEFT JOIN cea_student_training t3 ON t1.CeaStudentTrainingId = t3.id 
            LEFT JOIN cea_training_type t4 ON t3.CeaTrainingId = t4.id 
            LEFT JOIN cea_programme t5 ON t3.CeaProgrammeId = t5.id 
            LEFT JOIN std_student_class_stream t6 ON t1.StdStudentId = t6.StdStudentId 
            WHERE t1.OrgId = ?',[$orgId]);
        return $this->successResponse($records);
    }
}
