<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\AdmissionValidationModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponser;
use App\Models\Masters\StudentAwards;
use App\Models\Masters\OffenceType;
use App\Models\Masters\DisciplinaryActionTaken;
use App\Models\Masters\CeaProgram;
use App\Models\Masters\SubjectMarks;
use App\Models\Masters\CeaRole;
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
        $modelName = "App\\Models\\Masters\\"."$request->model";
        $model = new $modelName();
        $response_data="";
        $rules = [
            'name'          =>  'required',
            'status'        =>  'required',
        ];
        if($request->action_type=="edit"){
            $rules = $rules+[
                //for update, unique:table,column,idColumn
                'code'          =>  'unique:'.$model->getTable().',code,'.$request->id,
                // 'name'          =>  'unique:'.$model->getTable().',name,id,'.$request->name.',code,'.$request->code,
            ];
        }else{
            $rules = $rules+[
                //for create, unique:table,column
                'code'          =>  'unique:'.$model->getTable().',code',
                // 'name'          =>  'unique:'.$model->getTable().',name,id,'.$request->name.',code,'.$request->code,
            ];

            $rules = $rules+[
                //for create, unique:table,column
                'name'          =>  'unique:'.$model->getTable().',name,'.$request->name.',code,'.$request->code,
            ];
        }
        $customMessages = [
            'name.required'         => 'This field is required',
            'status.required'       => 'This field is required',
            'code.unique'           => 'This code is already taken. please choose another one',
            // 'name.unique'           => 'This code and name combination is already taken. please choose another one',
        ];
        $this->validate($request, $rules, $customMessages);
            $master_data = [
                'Name'              =>  $request->name,
                'Code'              =>  $request->code,
                'Description'       =>  $request->description,
                'Status'            =>  $request->status,
                'created_by'        =>  $request->userId,
            ];
        if($request->model=="StudentAwards"){
            $master_data = [
                'Name'              =>  $request->name,
                'Code'              =>  $request->code,
                'CeaAwardTypeId'    =>  $request->award_type_id,
                'CeaProgrammeId'    =>  $request->program_id,
                'Description'       =>  $request->description,
                'Status'            =>  $request->status,
            ];
        }
        if($request->model=="VaccineType"){
            $master_data = [
                'Name'              =>  $request->name,
                'Code'              =>  $request->code,
                'Description'       =>  $request->description,
                'Status'            =>  $request->status,
                'vaccineFor'       =>  $request->vaccineFor,
            ];
        }
        if($request->model=="CeaProgram"){
            $master_data = [
                'Name'                     =>  $request->name,
                'Code'                     =>  $request->code,
                'Description'              =>  $request->description,
                'Status'                   =>  $request->status,
                'CeaProgrammeTypeId'       =>  $request->program_type,
            ];
        }
        if($request->model=="CeaProgramItemVariety"){
            $master_data = [
                'Name'                     =>  $request->name,
                'Code'                     =>  $request->code,
                'Description'              =>  $request->description,
                'Status'                   =>  $request->status,
                'UnitId'                   =>  $request->unit_id,
            ];
        }

        if($request->model=="CeaRole"){
            $master_data = [
                'Name'                     =>  $request->name,
                'Code'                     =>  $request->code,
                'Description'              =>  $request->description,
                'Status'                   =>  $request->status,
                'AssignedTo'               =>  $request->assigned_to,
                'CeaProgrammeId'           =>  $request->program,
            ];
        }
        if($request->model=="CeaTraining"){
            $master_data = [
                'Name'                     =>  $request->name,
                'Code'                     =>  $request->code,
                'Description'              =>  $request->description,
                'Status'                   =>  $request->status,
                'CeaTrainingTypeId'        =>  $request->training_type_id,
                'CeaProgrammeId'           =>  $request->program_id,
            ];
        }
        if($request->model=="CeaProgramItem"){
            $master_data = [
                'Name'                          =>  $request->name,
                'Code'                          =>  $request->code,
                'Description'                   =>  $request->description,
                'Status'                        =>  $request->status,
                'CeaProgrammeItemVarietyId'     =>  $request->variety,
                'Central'                       =>  $request->central,
                'Local'                         =>  $request->local,
                'Unit_id'                       =>  $request->unit_id,
            ];
        }

        if($request->model=="CeaScoutSectionLevel" || $request->model=="CeaScoutBadge" ){
            $master_data = [
                'Name'                     =>  $request->name,
                'Code'                     =>  $request->code,
                'Description'              =>  $request->description,
                'Status'                   =>  $request->status,
                'CeaScoutSectionId'        =>  $request->scout_type,
            ];
        }

        if($request->model=="OffenceType"|| $request->model=="DisciplinaryActionTaken"){
            $master_data = [
                'Name'                   =>  $request->name,
                'Code'                   =>  $request->code,
                'StdDisciplinarySeverity'=>  $request->offence_severity_id,
                'Description'            =>  $request->description,
                'Status'                 =>  $request->status,
            ];
        }
        if($request->action_type=="add"){
            $Finalmaster_data =$master_data+[
                'created_by'        =>  $request->user_id,
                'created_at'        =>  date('Y-m-d h:i:s'),
            ];
            try{
                $response_data = $model::create($Finalmaster_data);
            } catch(\Illuminate\Database\QueryException $ex ){
                dd($ex);
            }

        }
        if($request->action_type=="edit"){
            $Finalmaster_data =$master_data+[
                'updated_by'        =>  $request->user_id,
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];
            $model::where('id',$request->id)->update($Finalmaster_data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);

        //old code of phuntsho sir
        // $record_type = $request['record_type'];
        // $data = $this->extractRequestInformation($request, $record_type, $type='data');
        // $databaseModel=$this->extractRequestInformation($request, $record_type, $type='Model');

        // if($request->action_type=="add"){
        //     $response_data = $this->insertData($data, $databaseModel);
        // }
        // else if($request->action_type=="edit"){
        //     $response_data = $this->updateData($request,$data, $databaseModel);
        // }


    }

    /**
     * Qualification marks for class XI
     */

    public function saveStreamSubject(Request $request){
        $id = $request->id;
        if($id != null){
            $subjectlist = [
                'streamId'           =>  $request['streamId'],
                'aca_sub_id'         =>  $request['aca_sub_id'],
                'subject_name'       =>  $request['name'],
                'marks'              =>  $request['marks'],
                'grade'              =>  $request['grade'],
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
                $grade="";
                if(isset($classstream['grade'])){
                    $grade=$classstream['grade'];
                }
                $subject_name="";
                if(isset($classstream['name'])){
                    $subject_name=$classstream['name'];
                }
                $aca_sub_id="";
                if(isset($classstream['aca_sub_id'])){
                    $aca_sub_id=$classstream['aca_sub_id'];
                }
                $data = array(
                'streamId'           =>  $request['streamId'],
                'aca_sub_id'         =>  $aca_sub_id,
                'subject_name'       =>  $subject_name,
                'marks'              =>  $marks,
                'grade'              =>  $grade,
                'id'                 =>  $request['id'],
                'created_by'         =>  $request->user_id,
                'created_at'         =>  date('Y-m-d h:i:s')
                );
                SubjectMarks::create($data);

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

    public function loadStudentMasters($type="",$model=""){
        $mod=$model;
        $modelName = "App\\Models\\Masters\\"."$model";
        $model = new $modelName();
        if($type == 'all'){
            if($mod=="ChildGroupPosition"){
                $response_data=$model::get();
                return $this->successResponse($response_data);
            }else{
                return $this->successResponse($model::get());
            }
        }
        else if(strpos($type,'joinall')!==false){
            $response_data=$model::get();
            if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
                foreach($response_data as $data){
                    $submod=explode('__',$type)[1];
                    $sub_det="App\\Models\\staff_masters\\"."$submod";
                    $submodel = new $sub_det();
                    $data->sub_det=$submodel::where('id',$data[explode('__',$type)[2]])->first();
                }
            }
            return $this->successResponse($response_data);
        }
        else if($type == 'active'){
            return $this->successResponse($model::where('status',1)->get());
        }
        else if(strpos($type,'byparent')!==false){
            // dd(explode('__',$type)[1]);
            return $this->successResponse($model::where(explode('__',$type)[1],explode('__',$type)[2])->get());
        }
        else if($type=="Qualification"){
            return $this->successResponse($model::with('quialificationtype','quialificationlevel')->get());
        }
        else if($type=="StaffSubMajorGrop"){
            return $this->successResponse($model::with('majorgroup')->get());
        }
        else if($type == 'active'){
            return $this->successResponse($model::where('status',1)->get());
        }

    }

    // old code of phuntsho sir to load student master
    // public function loadStudentMasters($param=""){
    //     $orginal_param=$param;
    //     if(strpos($param,'_Active')){
    //         $param=str_replace('_Active','',$param);
    //     }

    //     if($param == 'program_name' || $param == 'club_name'){
    //         $model_name = 'CeaProgram';
    //     } else {
    //         $model_name = $param;
    //     }

    //     $databaseModel=$this->extractRequestInformation($request=NULL, $model_name, $type='Model');
    //     $modelName = "App\\Models\\Masters\\"."$databaseModel";

    //     $model = new $modelName();

    //     if($param == 'program_name'){
    //         $programid=CeaProgramType::where('Name', 'like', 'Program%')->first();
    //         $response_data = CeaProgram::where('CeaProgrammeTypeId', $programid->id)->get();
    //         return $this->successResponse($response_data);

    //     } elseif($param == 'club_name'){
    //         $programid=CeaProgramType::where('Name', 'like', 'Club%')->first();
    //         $response_data = CeaProgram::where('CeaProgrammeTypeId', $programid->id)->get();
    //         return $this->successResponse($response_data);

    //     } elseif(strpos($orginal_param,'_Active')){
    //         //change from param to $orginal_param as param value is changing above
    //         return $this->successResponse($model::where('status',1)->get());

    //     } elseif($param == 'StudentAwardType'){
    //         return $this->successResponse(StudentAwardType::all());

    //     } elseif($param == 'CeaProgramType'){
    //         return $this->successResponse(CeaProgramType::all());

    //     } else {
    //         return $this->successResponse($model::all());
    //     }

    // }

//GET TEACHER POSITION TITLE FOR REPORT

    /**
     * method to list students masters of active records for dropdown
    */
    public function loadActiveStudentMasters($param=""){

        if($param == 'program_teacher_roles'){
            $status = '1';
            $assigned_to = '1';
            return $this->successResponse(CeaRole::where('status',$status)->where('AssignedTo', $assigned_to)->get());

        } else if($param == 'program_student_roles'){
            $status = '1';
            $assigned_to = '2';
            return $this->successResponse(CeaRole::where('status',$status)->where('AssignedTo', $assigned_to)->get());

        } else if($param == 'program_name'){
            $model_name = 'CeaProgram';
            $program_type = CeaProgramType::where('Name', 'like', 'Program%')->select('id')->first();
            $databaseModel=$this->extractRequestInformation($request=NULL, $model_name, $type='Model');
            $modelName = "App\\Models\\Masters\\"."$databaseModel";
            $model = new $modelName();

            $data = $model::where('CeaProgrammeTypeId', $program_type->id)->get();
            return $data;

        } else if($param == 'club_name'){
            $model_name = 'CeaProgram';
            $program_type = CeaProgramType::where('Name', 'like', 'Club%')->select('id')->first();
            $databaseModel=$this->extractRequestInformation($request=NULL, $model_name, $type='Model');
            $modelName = "App\\Models\\Masters\\"."$databaseModel";
            $model = new $modelName();

            $data = $model::where('CeaProgrammeTypeId', $program_type->id)->get();
            return $data;
        }else if($param == 'program_item_central' || $param == 'program_item_local'){
            $databaseModel=$this->extractRequestInformation($request=NULL, 'program_item_central', $type='Model');
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
    public function loadActiveProgramLists($typeId){
        return $this->successResponse(CeaProgram::where ('CeaProgrammeTypeId',$typeId)->get());

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

    private function updateData($request, $dataRequest, $databaseModel){
        $modelName = "App\\Models\\Masters\\"."$databaseModel";
        $model = new $modelName();
        $data = $model::find($request->id);

        //Audit Trails
        $msg_det='Name:'.$data->Name.'; Status:'.$data->Status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
        // $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','".$databaseModel."','".$request->id."','".$msg_det."','".$request['user_id']."','Edit')");
        // dd('m here',$dataRequest);

        //data to be updated
        $data->Name = $dataRequest['Name'];

        if($request['record_type']=="vaccine_type" ){
            $data->Description = $dataRequest['vaccineFor'];
        }

        $response_data = $model::where('id',$request->id)->update($dataRequest);

        return $response_data;

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
                'Code'  =>  $request['code'],
                'Description'  =>  $request['description'],
                'Status'    =>  $request['status'],
                'created_by'=>$request['user_id'],
                'created_at'=>date('Y-m-d h:i:s'),
            ];
        }

        switch($record_type){
            case "StudentAwards" : {
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
            case "OffenceType" : {
                    $databaseModel = "OffenceType";
                    if($type == 'data'){
                        $additional_data = [
                            'StdDisciplinarySeverity' => $request->offence_severity_id
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "DisciplinaryActionTaken" : {
                    $databaseModel = "DisciplinaryActionTaken";
                    if($type == 'data'){
                        $additional_data = [
                            'StdDisciplinarySeverity' => $request->offence_severity_id
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "CeaProgram" : {
                    $databaseModel = "CeaProgram";
                    if($type =='data'){
                        $additional_data = [
                            'CeaProgrammeTypeId'  =>  $request['program_type'],
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "CeaProgramItem" : {
                    $databaseModel = "CeaProgramItem";
                    if($type =='data'){
                        $additional_data = [
                            'Central'   =>  $request['central'],
                            'Local'     =>  $request['local'],
                            'Unit_id'   =>  $request['unit_id'],
                            'CeaProgrammeItemVarietyId'   =>  $request['variety'],
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "CeaTraining" : {
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

            case "CeaScoutSectionLevel" : {
                    $databaseModel = "CeaScoutSectionLevel";
                    if($type =='data'){
                        $additional_data = [
                            'CeaScoutSectionId' => $request['scout_type'],
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }

            case "CeaScoutBadge" : {
                    $databaseModel = "CeaScoutBadge";
                    if($type =='data'){
                        $additional_data = [
                            'CeaScoutSectionId' => $request->scout_type,
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }

            case "CeaRole" : {
                    $databaseModel = "CeaRole";
                    if($type =='data'){
                        $additional_data = [
                            'CeaProgrammeId' => $request->program,
                            'AssignedTo'=> $request->assigned_to,
                            'remarks'=> $request->remarks
                        ];
                        $data = $data + $additional_data;
                        unset($data['description']);
                    }
                    break;
                }
            case "VaccineType" : {
                    $databaseModel = "VaccineType";
                    if($type =='data'){
                        $additional_data = [
                            'vaccineFor' => $request->vaccineFor
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "CeaProgramItemVariety" : {
                    $databaseModel = "CeaProgramItemVariety";
                    if($type =='data'){
                        $additional_data = [
                            'UnitId' => $request->unit_id
                        ];
                        $data = $data + $additional_data;
                    }
                    break;
                }
            case "program_item_central" : {
                    $databaseModel = "CeaProgramItem";
                    break;
                }
            case "program_item_local" : {
                    $databaseModel = "CeaProgramItem";
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

    /**Get the student awards by award type id*/
    public function getStudentAwards($id){
        $data=StudentAwards::select('id','Name')->where('CeaAwardTypeId',$id)->get();
        return $data;
    }

    /**Get the student offence type by severity id*/
    public function getOffenceType($id){
        $data=OffenceType::select('id','Name')->where('StdDisciplinarySeverity',$id)->get();
        return $data;
    }

    /**Get the student action taken by severity id*/
    public function getActionTaken($id){
        $data=DisciplinaryActionTaken::select('id','Name')->where('StdDisciplinarySeverity',$id)->get();
        return $data;
    }

    /**
     * Counselling Master
     */

    public function saveCounsellingType(Request $request){
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
                CounsellingType::where('id', $id)->update($data);
               $response_data = CounsellingType::where('id', $id)->first();
           } else {
               $data =[
                'id'                =>  $request->id,
                'Name'              =>  $request->Name,
                'Description'       =>  $request->Description,
                'Status'            =>  $request->Status,
                'updated_by'        =>  $request['user_id'],
                'updated_at'        =>  date('Y-m-d h:i:s'),
               ];
               $response_data = CounsellingType::create($data);
           }
           return $this->successResponse($response_data, Response::HTTP_CREATED);
       }

       public function getCounsellingTypeDropdown(){
         return CounsellingType::where('status',1)->get();
    }

    public function saveFoodSourceType(Request $request){
        $id = $request->id;
        if( $id != null){
            $data =[
                 'id'               =>  $request->id,
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
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadfoodSourceList(){
        $data = FoodSourceType::all();
        return $data;
    }
    public function loadActiveFoodSourceMaster(){
         return FoodSourceType::where('status',1)->get();
    }

}
