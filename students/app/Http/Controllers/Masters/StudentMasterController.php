<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\AdmissionValidationModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Masters\StudentAwards;
use App\Models\Masters\StudentType;
use App\Models\Masters\StudentAwardType;
use App\Models\Masters\CeaProgram;
use App\Models\Masters\SubjectMarks;
use App\Models\Masters\CeaRole;
use App\Models\Masters\VaccineType;
use App\Models\Masters\CeaProgramType;
use App\Models\Masters\CeaScoutSection;
use App\Models\Masters\CeaProgramItem;
use App\Models\Masters\CeaScoutSectionLevel;
use App\Models\Masters\CeaScoutProficiencyBadge;
use App\Models\Masters\CounsellingType;
use App\Models\Masters\FoodSourceType;

class StudentMasterController extends Controller
{

    use ApiResponser;

    public $audit_database;
    public $database;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
        $this->database = config('services.constant.studentdb');
    }



    /**
     * method to save or update student masters data
    */

    public function saveStudentMasters(Request $request){
       // dd($request);
        $rules = [
            'name'  =>  'required',
        ];

        $this->validate($request, $rules);

        $record_type = $request['recordtype'];

        $data = $this->extractRequestInformation($request, $record_type, $type='data');

        $databaseModel=$this->extractRequestInformation($request, $record_type, $type='Model');

        if($request->actiontype=="add"){
            $response_data = $this->insertData($data, $databaseModel);
        }
        else if($request->actiontype=="edit"){

            $response_data = $this->updateData($request,$data, $databaseModel);
        }
       // dd($response_data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);

    }
    public function saveStreamSubject(Request $request){
        $id = $request->id;
        if($id != null){
            $subjectlist = [
                'streamId'           =>  $request['streamId'],
                'aca_sub_id'         =>  $request['aca_sub_id'],
                'marks'              =>  $request['marks'],
                'id'                 =>  $request['id'],
                'updated_by'         =>  $request->user_id,
                'created_at'         =>  date('Y-m-d h:i:s')
                
            ];
            $stcrcv = SubjectMarks::where('id', $id)->update($subjectlist);
            return $this->successResponse($stcrcv, Response::HTTP_CREATED);

        }else{
            foreach ($request->input('subjectlist') as  $i=> $classstream){
                   $marks="";
                   if(isset($classstream['marks'])){
                       $marks=$classstream['marks'];
                   }
                   $aca_sub_id="";
                   if(isset($classstream['aca_sub_id'])){
                       $aca_sub_id=$classstream['aca_sub_id'];
                   }
                   $data = array(
                    'streamId'           =>  $request['streamId'],
                    'aca_sub_id'         =>  $aca_sub_id,
                    'marks'              =>  $marks,
                    'id'                 =>  $request['id'],
                    'created_by'         =>  $request->user_id,
                    'created_at'         =>  date('Y-m-d h:i:s')
                   );
                   try{
                    SubjectMarks::create($data);
        
                    } catch(\Illuminate\Database\QueryException $ex){
                        dd($ex->getMessage());
                        // Note any method of class PDOException can be called on $ex.
                    }
                   
               }

            }
            return $this->successResponse(Response::HTTP_CREATED);


        }
        public function loadstreamMarks(){
            return $this->successResponse(SubjectMarks::all());

        }

    public function saveValidationcondition(Request $request){
        $rules = [
            'date'          =>  'required',
            'date1'         =>  'required',
            'status'        =>  'required',
            'no_months'     =>  'required',
            'no_months1'    =>  'required',
        ];
        $customMessages = [
            'date.required' => 'This field is required',
            'date1.required' => 'This field is required',
            'status.required' => 'This field is required',
            'no_months.required' => 'This field is required',
            'no_months1.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'date'                      =>  $request->date,
            'date1'                     =>  $request->date1,
            'status'                    =>  $request->status,
            'no_months'                 =>  $request->no_months,
            'no_months1'                =>  $request->no_months1,
        ];
        // dd($data);
        $existing_data=AdmissionValidationModel::first();
        if($existing_data!=null && $existing_data!=""){
            $response_data = AdmissionValidationModel::first();
            $data =$data+[
                'updated_by'                =>  $request->user_id,
                'updated_at'                =>   date('Y-m-d h:i:s'),
            ];
            AdmissionValidationModel::where('id',$response_data->id)->update($data);
            $response_data = AdmissionValidationModel::first();
        }
        else{
            $data =$data+[
                'created_by'                =>  $request->user_id,
                'created_at'                =>   date('Y-m-d h:i:s'),
            ];
            $response_data = AdmissionValidationModel::create($data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);

    }

    public function loadValidationcondition(){
        $response_data = AdmissionValidationModel::first();
        return $this->successResponse($response_data);
    }

    /**
     * method to list students masters
    */

    public function loadStudentMasters($param=""){
        $orginal_param=$param;
        if(strpos($param,'_Active')){
            // $param=explode('_',$param)[0]; //commented by Tshewang as there are pareamers which contains _ more then 1 like student_program_Active
            $param=str_replace('_Active','',$param);
        }

        $databaseModel=$this->extractRequestInformation($request=NULL, $param, $type='Model');
        $modelName = "App\\Models\\Masters\\"."$databaseModel";

        $model = new $modelName();
        //need to separate programs from clubs

        if($param == 'program_name'){
            //commented by Tshewang and load respective master data by program type
            // $program_type = CeaProgram::where('Name', 'like', 'Program%')->select('id')->first();
            // $response_data = $model::where('id', $program_type->id)->get();
            $programid=CeaProgramType::where('Name', 'like', 'Program%')->first();
            $response_data = CeaProgram::where('CeaProgrammeTypeId', $programid->id)->get();
            return $this->successResponse($response_data);
            // dd($response_data);

        } elseif($param == 'club_name'){
            //commented by Tshewang and load respective master data by program type
            // $program_type = CeaProgram::where('Name', 'like', 'Club%')->select('id')->first();
            // $response_data = $model::where('CeaProgrammeTypeId', $program_type->id)->get();
            $programid=CeaProgramType::where('Name', 'like', 'Club%')->first();
            $response_data = CeaProgram::where('CeaProgrammeTypeId', $programid->id)->get();
            return $this->successResponse($response_data);

        } elseif(strpos($orginal_param,'_Active')){//change from param to $orginal_param as param value is changing above
            return $this->successResponse($model::where('status',1)->get());

        } elseif($param == 'student_award_type'){
            return $this->successResponse(StudentAwardType::all());

        } elseif($param == 'program_type'){
            return $this->successResponse(CeaProgramType::all());

        } else {
            return $this->successResponse($model::all());
        }

    }


    /**
     * method to list students masters of active records for dropdown
    */
    public function loadActiveStudentMasters($param=""){
        if($param == 'program_teacher_roles'){
            $status = '1';
            $assigned_to = '1';
            return $this->successResponse(CeaRole::where('status',$status)->where('AssignedTo', $assigned_to)->get());//change from assigned_to AssignTo by Tshewang as its find in db

        } else if($param == 'program_student_roles'){
            $status = '1';
            $assigned_to = '2';
            return $this->successResponse(CeaRole::where('status',$status)->where('AssignedTo', $assigned_to)->get());//change from assigned_to AssignTo by Tshewang as its find in db

        } else if($param == 'program_name'){
            $program_type = CeaProgramType::where('Name', 'like', 'Program%')->select('id')->first();
            $databaseModel=$this->extractRequestInformation($request=NULL, $param, $type='Model');
            $modelName = "App\\Models\\Masters\\"."$databaseModel";
            $model = new $modelName();

            $data = $model::where('CeaProgrammeTypeId', $program_type->id)->get();
            return $data;

        } else if($param == 'club_name'){
            $program_type = CeaProgramType::where('Name', 'like', 'Club%')->select('id')->first();
            $databaseModel=$this->extractRequestInformation($request=NULL, $param, $type='Model');
            $modelName = "App\\Models\\Masters\\"."$databaseModel";
            $model = new $modelName();

            $data = $model::where('CeaProgrammeTypeId', $program_type->id)->get();
            return $data;
        }else if($param == 'program_item_central' || $param == 'program_item_local'){
            $databaseModel=$this->extractRequestInformation($request=NULL, 'program_item', $type='Model');
            $modelName = "App\\Models\\Masters\\"."$databaseModel";
            $model = new $modelName();
            if($param == 'program_item_central'){
                $data = $model::where('status',1)->where('Central',1)->get();
            }
            if($param == 'program_item_local'){
                $data = $model::where('status',1)->where('Local',1)->get();
            }
            return $data;
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
       //  dd($data);
        //Audit Trails
        $msg_det='Name:'.$data->Name.'; Status:'.$data->Status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
        // $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','".$databaseModel."','".$request->id."','".$msg_det."','".$request['user_id']."','Edit')");
      // dd('m here',$dataRequest);

        //data to be updated
        $data->Name = $dataRequest['Name'];
        // dd($data);
        if($request['recordtype']!="StudentType" && $request['recordtype']!="ScholarType" && $request['recordtype']!="SpBenefit"){
            $data->Description = $dataRequest['Description'];
        }
        if($request['recordtype']=="vaccine_type" ){
            $data->Description = $dataRequest['vaccineFor'];
        }
        if($request['recordtype']=="program_item" ){
            $data->Central   =  $dataRequest['Central'];
            $data->Local     =  $dataRequest['Local'];
            $data->Unit_id   =  $dataRequest['Unit_id'];
            $data->CeaProgrammeItemVarietyId   =  $dataRequest['variety'];
        }
        $data->Description = $dataRequest['Description'];
        $data->Status = $dataRequest['Status'];
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
            if($record_type=="program_item"){
                $additional_data = [
                    'Central'   =>  $request['central'],
                    'Local'     =>  $request['local'],
                    'Unit_id'   =>  $request['unit_id'],
                    'CeaProgrammeItemVarietyId'   =>  $request['variety'],
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
            case "club_name" : {
                    $databaseModel = "CeaProgram";
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
            case "scout_section" : {
                    $databaseModel = "CeaScoutSection";
                    break;
                }

            case "scout_section_level" : {
                    $databaseModel = "CeaScoutSectionLevel";
                    if($type =='data'){
                        $additional_data = [
                            'CeaScoutSectionId' => $request['scout_type'],
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }

            case "scout_badge" : {
                    $databaseModel = "CeaScoutBadge";
                    if($type =='data'){
                        $additional_data = [
                            'CeaScoutSectionLevelId' => $request->scout_level_id,
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }

            case "scout_leader" : {
                    $databaseModel = "CeaScoutLeader";
                    break;
                }

            case "program_role" : {
                    $databaseModel = "CeaRole";
                    if($type =='data'){
                        $additional_data = [
                            'CeaProgrammeId' => $request->program,
                            'AssignedTo'=> $request->assigned_to,  //change from assigned_to AssignTo by Tshewang as its find in db
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
                    if($type =='data'){
                        $additional_data = [
                            'vaccineFor' => $request->vaccineFor
                        ];
                        $data = $data + $additional_data;
                    }
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
            case "health_supplementation" : {
                    $databaseModel = "HealthSupplementation";
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
            case "item_variety" : {
                    $databaseModel = "CeaProgramItemVariety";
                    if($type =='data'){
                        $additional_data = [
                            'UnitId' => $request->unit_id
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "program_measurement" : {
                    $databaseModel = "CeaProgramMeasurement";
                    break;
                }
            case "counselling_class_range" : {
                    $databaseModel = "CounsellingClassRange";
                    break;
                }
            case "counselling_age_range" : {
                    $databaseModel = "CounsellingAgeRange";
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

    /**
     * The following functions are written differently.
     * Integrate to Case statements in the future
     */

    /**Get Scout Section in Dropdown */
    public function getScoutSection(){
        $data=CeaScoutSection::select('id','name')->get();
        return $data;
    }


    /**Get Scout Level in Dropdown By ScoutSectionID*/
    public function getScoutSectionLevel($scoutSectionId){
        $data=CeaScoutSectionLevel::select('id','name')->where('CeaScoutSectionId',$scoutSectionId)->get();
        return $data;
    }

    /**Get Scout Badge in Dropdown By ScoutSectionID*/
    public function getScoutBadge($scoutSectionId){
        $data=CeaScoutProficiencyBadge::select('id','name')->where('CeaScoutSectionId',$scoutSectionId)->get();
        return $data;
    }

    /**Get the program items by varity id*/
    public function getProgramItems($id){
        $data=CeaProgramItem::select('id','name', 'Unit_id')->where('CeaProgrammeItemVarietyId',$id)->get();
        return $data;
    }

    /**
     * Counselling Master
     */

    public function saveCounsellingType(Request $request){
         //  dd($request);
           $id = $request->id;
           if( $id != null){
               $data =[
                   'id'                =>  $request->id,
                   'name'              =>  $request->name,
                   'description'       =>  $request->description,
                   'status'            =>  $request->status,
                   'updated_by'        =>  $request['user_id'],
                   'updated_at'        =>  date('Y-m-d h:i:s'),
                ];
                CounsellingType::where('id', $id)->update($data);
               $response_data = CounsellingType::where('id', $id)->first();
           } else {
               $data =[
                'id'                =>  $request->id,
                'name'              =>  $request->name,
                'description'       =>  $request->description,
                'status'            =>  $request->status,
                'created_by'        =>  $request['user_id'],
                'created_at'        =>  date('Y-m-d h:i:s'),
               ];
               $response_data = CounsellingType::create($data);
           }
          // dd($data);
           return $this->successResponse($response_data, Response::HTTP_CREATED);
       }

       public function getCounsellingTypeDropdown(){
        // dd('from microserve ');
         return CounsellingType::where('status',1)->get();
    }

    public function saveFoodSourceType(Request $request){
    //  dd($request);
        $id = $request->id;
        if( $id != null){
            $data =[
                 'id'                =>  $request->id,
                'Name'              =>  $request->Name,
                'Description'       =>  $request->Description,
                'Status'            =>  $request->Status,
                'updated_by'        =>  $request['user_id'],
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];
            FoodSourceType::where('id', $id)->update($data);
            $response_data = FoodSourceType::where('id', $id)->first();
        } else {
            $data =[
             'id'                =>  $request->id,
             'Name'              =>  $request->Name,
             'Description'       =>  $request->Description,
             'Status'            =>  $request->Status,
             'created_by'        =>  $request['user_id'],
             'created_at'        =>  date('Y-m-d h:i:s'),
            ];
            $response_data = FoodSourceType::create($data);
        }
         // dd($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadfoodSourceList(){
        $data = FoodSourceType::all();
        return $data;
    }
    public function loadActiveFoodSourceMaster(){
        // dd('from microserve ');
         return FoodSourceType::where('status',1)->get();
    }
}
