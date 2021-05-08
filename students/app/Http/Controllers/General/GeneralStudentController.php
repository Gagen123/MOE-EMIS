<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Traits\ApiResponser;
use App\Models\Masters\StudentAwards;
use App\Models\Students\Student;

class GeneralStudentController extends Controller
{
    //
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
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
        $data = [
            'id'  =>  $request['id'],
            'name'  =>  $request['name'],
            'description'  =>  $request['description'],
            'status'    =>  $request['status'],
            'created_by'=>$request['user_id'],
            'created_at'=>date('Y-m-d h:i:s'),
        ];
        
        $databaseModel=$this->getModelName($record_type);

        if($request->actiontype=="add"){
            $response_data = $this->insertData($data, $databaseModel);

        } else if($request->actiontype=="edit"){
            $response_data = $this->updateData($data, $databaseModel);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    public function loadStudentList($param=""){
        $id = $param;
        
        return $this->successResponse(Student::where('OrgOrganizationId',$id)->take(10)
                            ->get(['id', 'Name', 'DateOfBirth']));
    }

    public function loadStudentBySection($param1){
        $id = $param1;
        
        return $this->successResponse(Student::where('OrgOrganizationId',$id)->take(10)
                            ->get(['id', 'Name', 'DateOfBirth']));
    }
    /**
     * method to list students masters
    */

    public function loadStudentMasters($param=""){

        $databaseModel=$this->getModelName($param);

        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();

        return $this->successResponse($model::all());

    }

    /**
     * method to list students masters of active records for dropdown
    */

    public function loadActiveStudentMasters($param=""){

        $databaseModel=$this->getModelName($param);

        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();
        $status = '1';

        return $this->successResponse($model::where('status',$status)->first());

    }

    /**
     * method to list students masters by id
    */

    public function allActiveStudentDropdowns($param="",$id=""){
        
        $databaseModel = $this->getModelName($param);

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

    /*
    * To get the model names based on parameters
    */

    private function getModelName($parameter){
        $databaseModel='';

        switch($parameter){
            case "student_awards" : {
                    $databaseModel = "StudentAwards";
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
        }
        return $databaseModel;
    }
    
}
