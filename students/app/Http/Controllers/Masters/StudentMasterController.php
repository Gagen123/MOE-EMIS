<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Masters\StudentAwards;
use App\Models\Masters\CeaRole;

class StudentMasterController extends Controller
{
    //
    use ApiResponser;
    public $audit_database;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
        $this->database = config('services.constant.studentdb');
    }

    /** 
     * method to save or update student masters data
    */

    public function saveStudentMasters(Request $request){
        
        $rules = [
            'name'  =>  'required',
        ];

        $this->validate($request, $rules);

        $record_type = $request['recordtype'];

        $data = $this->extractRequestInformation($request, $record_type, $type='data');
        
        $databaseModel=$this->extractRequestInformation($request, $record_type, $type='Model');

        if($request->actiontype=="add"){
            $response_data = $this->insertData($data, $databaseModel);

        } else if($request->actiontype=="edit"){
            $response_data = $this->updateData($request,$data, $databaseModel);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    /**
     * method to list students masters
    */

    public function loadStudentMasters($param=""){
        if(strpos($param,'_Active')){
            $param=explode('_',$param)[0];
        }
        $databaseModel=$this->extractRequestInformation($request=NULL, $param, $type='Model');

        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();
        if(strpos($param,'_Active')){
            return $this->successResponse($model::where('status',1)->get());
        }
        return $this->successResponse($model::all());
    }

    /**
     * method to list students masters of active records for dropdown
    */

    public function loadActiveStudentMasters($param=""){

        if($param == 'program_teacher_roles'){
            $status = '1';
            $assigned_to = '1';

            return $this->successResponse(CeaRole::where('status',$status)->where('assigned_to', $assigned_to)->get());
            
        } else if($param == 'program_student_roles'){

            $status = '1';
            $assigned_to = '2';
            return $this->successResponse(CeaRole::where('status',$status)->where('assigned_to', $assigned_to)->get());

        } else {

            $databaseModel=$this->extractRequestInformation($request=NULL, $param, $type='Model');

            $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
            $model = new $modelName();
            $status = '1';

            return $this->successResponse($model::where('status',$status)->get());
        }
        

    }

    /**
     * method to list students masters by id
    */

    public function allActiveStudentDropdowns($param="",$id=""){
        
        $databaseModel=$this->extractRequestInformation($request=NULL, $param, $type='Model');

        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();

        return $this->successResponse($model::where('id',$id)->first());
        
    }

    /**
     * Function to insert data into the respective tables
     */

    private function insertData($data, $databaseModel){
        
        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();

        $response_data = $model::create($data);
        
        return $response_data;
    }

    /**
     * Function to insert data into the respective tables
     */

    private function updateData($request,$dataRequest, $databaseModel){
        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();
        $data = $model::find($request->id);
        //Audit Trails
        $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
        $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','".$databaseModel."','".$request->id."','".$msg_det."','".$request['user_id']."','Edit')");
        
        //data to be updated
        $data->name = $dataRequest['name'];
        if($request['recordtype']!="StudentType" && $request['recordtype']!="ScholarType" && $request['recordtype']!="SpBenefit"){
            $data->description = $dataRequest['description'];
        }
        $data->status = $dataRequest['status'];
        $data->updated_by = $dataRequest['created_by'];
        $data->updated_at = date('Y-m-d h:i:s');
        $data->update();
        return $data;
    }

    /*
    * To get the model names based on parameters
    */

    private function extractRequestInformation($request, $record_type, $type){
        $databaseModel='';
        if($type=='data'){
            $data = [
                'id'  =>  $request['id'],
                'Name'  =>  $request['name'],
                'Status'    =>  $request['status'],
                'created_by'=>$request['user_id'],
                'created_at'=>date('Y-m-d h:i:s'),
            ];
            if($record_type!="StudentType" || $record_type!="ScholarType" || $record_type!="SpBenefit"){
                $additional_data = [
                    'Description'  =>  $request['description'],
                ];
                $data = $data + $additional_data; 
            }
        }

        switch($record_type){
            case "student_award_type" : {
                    $databaseModel = "StudentAwardType";
                    break;
                }
            case "student_awards" : {
                    $databaseModel = "StudentAwards";
                    if($type =='data'){
                        $additional_data = [
                            'CeaAwardTypeId'  =>  $request['award_type_id'],
                            'CeaProgrammeId'  =>  $request['program_id'],
                            'CeaAwardId'      =>  $request['award_id'],
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "offence_type" : {
                    $databaseModel = "OffenceType";
                    break;
                }
            case "offence_severity" : {
                    $databaseModel = "OffenceSeverity";
                    break;
                }
            case "disciplinary_action_taken" : {
                    $databaseModel = "DisciplinaryActionTaken";
                    break;
                }
            case "roles_responsibilities" : {
                    $databaseModel = "StudentRole";
                    break;
                }
            case "program_name" : {
                    $databaseModel = "CeaProgram";
                    if($type =='data'){
                        $additional_data = [
                            'CeaProgrammeTypeId'  =>  $request['program_type'],
                            //'CeaProgrammeId'  =>  $request['program_id']
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "program_type" : {
                    $databaseModel = "CeaProgramType";
                    break;
                }
            case "program_support" : {
                    $databaseModel = "CeaProgramSupporter";
                    break;
                }
            case "project_type" : {
                    $databaseModel = "CeaProjectType";
                    break;
                }
            case "training_type" : {
                    $databaseModel = "CeaTrainingType";
                    break;
                }
            case "training" : {
                    $databaseModel = "CeaTraining";
                    if($type =='data'){
                        $additional_data = [
                            'CeaTrainingTypeId'  =>  $request['training_type_id'],
                            'CeaProgrammeId'  =>  $request['program_id']
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "scout_type" : {
                    $databaseModel = "CeaScoutType";
                    break;
                }
            case "scout" : {
                    $databaseModel = "CeaScout";
                    if($type =='data'){
                        $additional_data = [
                            'CeaScoutTypeId'  =>  $request['scout_type'],
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "program_role" : {
                    $databaseModel = "CeaRole";
                    if($type =='data'){
                        $additional_data = [
                            'CeaProgrammeId' => $request->program,
                            'assigned_to'=> $request->assigned_to,
                            'remarks'=> $request->remarks
                        ];
                        $data = $data + $additional_data;
                        unset($data['description']);
                    }
                    break;
                }
            case "quarter_name" : {
                    $databaseModel = "CeaQuarterType";
                    break;
                }
            case "vaccine_type" : {
                    $databaseModel = "VaccineType";
                    break;
                }
            case "term_type" : {
                    $databaseModel = "HealthTerm";
                    break;
                }
            case "health_screening" : {
                    $databaseModel = "HealthScreening";
                    break;
                }
            case "screening_position" : {
                    $databaseModel = "ScreeningPositionTitle";
                    break;
                }
            case "screening_endorser" : {
                    $databaseModel = "ScreeningEndorsedBy";
                    break;
                }
            case "program_item" : {
                    $databaseModel = "CeaProgramItem";
                    break;
                }
            case "program_measurement" : {
                    $databaseModel = "CeaProgramMeasurement";
                    break;
                }
            default : {
                $databaseModel =$record_type;
                break;
            }
        }
        if($type == 'Model'){
            return $databaseModel;
        } else{
            return $data;
        }
    }
}
