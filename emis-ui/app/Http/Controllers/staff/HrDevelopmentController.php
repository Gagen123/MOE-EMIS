<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class HrDevelopmentController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function saveprogramDetails(Request $request){
        $rules = [
            'training_type'             =>  'required  ',
            'course_title'              =>  'required',
            'organizer'                 =>  'required',
            'start_date'                =>  'required | date',
            'end_date'                  =>  'required | date',
            'programme_level'           =>  'required',
            'programme_type'            =>  'required',
            'course_type'               =>  'required',
            'course_provider'           =>  'required',
            'vanue'                     =>  'required',
            'total_budget'              =>  'required',
            'financial_source'          =>  'required',
            'nature_of_participant'     =>  'required',

        ];
        $customMessages = [
            'training_type.required'                => 'Please select training type',
            'course_title.required'                 => 'Please mention course title ',
            'organizer.required'                    => 'Please select organizer',
            'start_date.required'                   => 'Please select start date',
            'end_date.required'                     => 'Please select end date',
            'programme_level.required'              => 'Please select programme level',
            'programme_type.required'               => 'Please select programme type',
            'course_type.required'                  => 'Please select couorse type',
            'course_provider.required'              =>  'Please select course provider',
            'vanue.required'                        =>  'Plese mention place/vanue',
            'total_budget.required'                 =>  'Please provide total budget',
            'financial_source.required'             =>  'Please select financial source',
            'nature_of_participant.required'        =>  'Please select Nature of participant',
        ];
        if(strpos($request->training_type_text,'qualification upgrad')!==false){
            $rules=array_merge($rules,
                array('category'       =>  'required',
                'donor_agency'         =>  'required',
                'study_country'        =>  'required',
                'coursemode'           =>  'required',
                'degree'               =>  'required',
                'subject1'             =>  'required',
                'thesis_title'         =>  'required',)
            );
            $customMessages =array_merge($rules,
                array(
                    'category.required'           => 'Please select category',
                    'donor_agency.required'       => 'Please select donor agency',
                    'study_country.required'      => 'Please select country',
                    'coursemode.required'         => 'Please select course mode',
                    'degree.required'             => 'Please select degree',
                    'subject1.required'           => 'Please select subject',
                    'thesis_title.required'       => 'Please mention title',
                )
            );
        }
        if(strpos(strtolower($request->training_type_text),'professional')!==false){
            $rules=array_merge($rules,
                array(
                    'total_hrs'             =>  'required',
                )
            );
            $customMessages =array_merge($rules,
                array(
                    'total_hrs.required'                =>  'Please mention total hrs',
                )
            );
        }
        $this->validate($request, $rules,$customMessages);

        $files = $request->attachments;
        // dd($files);
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'HrDevelopment';
        if($files!=null && $files!=""){
            if(sizeof($files)>0 && !is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            if(sizeof($files)>0){
                foreach($files as $index => $file){
                    $file_name = time().'_' .$file->getClientOriginalName();
                    move_uploaded_file($file,$file_store_path.'/'.$file_name);
                    array_push($attachment_details,
                        array(
                            'path'                    =>  $file_store_path,
                            'original_name'           =>  $file_name,
                            'user_defined_name'       =>  $filenames[$index],
                        )
                    );
                }
            }
        }

        $request['user_id'] = $this->userId();
        $request['attachment_details'] = $attachment_details;
        $response_data= $this->apiService->createData('emis/staff/hrdevelopment/saveprogramFinalDetails', $request->all());//saveprogramDetails
        return $response_data;
    }

    public function loadDraftDetails(){
        $response_data= $this->apiService->listData('emis/staff/hrdevelopment/loadDraftDetails/'.$this->userId());
        return $response_data;
    }
    public function saveprogramFinalDetails(Request $request){
        $rules = [
            'nomination_start_date'             =>  'required | date',
            'nomination_end_date'               =>  'required | date',
            'nature_of_participant'             =>  'required',
            // 'target_group'                      =>  'required',
            // 'role_action_mapp'                  =>  'required',

        ];
        $customMessages = [
            'nomination_start_date.required'              => 'Please select nomination start date',
            'nomination_end_date.required'                => 'Please select nomination end date',
            'nature_of_participant.required'              => 'Please select this field',
            // 'target_group.required'                       => 'Please select this field',
            // 'role_action_mapp.required'                   => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                               =>  $request->id,
            'nomination_start_date'            =>  $request->nomination_start_date,
            'nomination_end_date'              =>  $request->nomination_end_date,
            'nature_of_participant'            =>  $request->nature_of_participant,
            'target_group'                     =>  $request->target_group,
            'org_level'                        =>  $request->org_level,
            'role_action_mapp'                 =>  $request->role_action_mapp,
            'remarks'                          =>  $request->remarks,
            'user_id'                           =>  $this->userId()
        ];
        // dd($request_data);
        $response_data= $this->apiService->createData('emis/staff/hrdevelopment/saveprogramFinalDetails', $request_data);
        return $response_data;
    }

    public function loadprogramDetails(){
        $param=$this->getAccessLevel().'SSS'.$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        $response_data= $this->apiService->listData('emis/staff/hrdevelopment/loadprogramDetails/'.$param);
        return $response_data;
    }

    public function loadDetails($id=""){
        $data =[
            'org'                   =>  $this->getWrkingAgencyId(),
            'dzongkhag'             =>  $this->getUserDzoId(),
            'id'                    =>  $id,
        ];
        $query = http_build_query($data);
        $response_data= $this->apiService->listData('emis/staff/hrdevelopment/loadDetails/'.$query);
        return $response_data;
    }

    public function loadProgramDetailsForNomination(){
        $roles=$this->currentUser()['roles'];
        $roleIds="";
        if($roles!="" && $roles!=null){
            foreach($roles as $role){
                $roleIds.=$role->Id.',';
            }
        }
        $response_data= $this->apiService->listData('emis/staff/hrdevelopment/loadProgramDetailsForNomination/'.$roleIds);
        return $response_data;
    }

    public function saveParticipant(Request $request){
        if($request->partifipant_from!="Excel"){
            $rules = [
                'programId'             =>  'required',
                'participant'           =>  'required',
                'contact'               =>  'required',
                'email'                 =>  'required',
                'nature_of_participant' =>  'required',
            ];
            $customMessages = [
                'programId.required'              => 'Please select nomination start date',
                'participant.required'            => 'Please select nomination end date',
                'contact.required'                => 'Please select this field',
                'email.required'                  => 'This field is required',
                'nature_of_participant.required'  => 'This field is required',
            ];
            $this->validate($request, $rules,$customMessages);
        }

        $files = $request->attachments;
        // dd($files);
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'HrDevelopmentParticipant';
        if($files!=null && $files!=""){
            if(sizeof($files)>0 && !is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            if(sizeof($files)>0){
                foreach($files as $index => $file){
                    $file_name = time().'_' .$file->getClientOriginalName();
                    move_uploaded_file($file,$file_store_path.'/'.$file_name);
                    array_push($attachment_details,
                        array(
                            'path'          =>  $file_store_path,
                            'name'          =>  $file_name,
                        )
                    );
                }
            }
        }
        $request_data =[
            'id'                        =>  $request->id,
            'programId'                 =>  $request->programId,
            'org_id'                    =>  $this->getWrkingAgencyId(),
            'dzo_id'                    =>  $this->getUserDzoId(),
            'participant'               =>  $request->participant,
            'contact'                   =>  $request->contact,
            'email'                     =>  $request->email,
            'nature_of_participant'     =>  $request->nature_of_participant,
            'attachment_details'        =>  $attachment_details,
            'action_type'               =>  $request->action_type,
            'partifipant_from'          =>  $request->partifipant_from,
            'files'                     =>  $files,
            'user_id'                   =>  $this->userId()
        ];
        // dd($request_data);
        $response_data= $this->apiService->createData('emis/staff/hrdevelopment/saveParticipant', $request_data);
        return $response_data;
    }

    public function getParticipantDetails($action_type="",$id=""){
        $data =[
            'org'                 =>  $this->getWrkingAgencyId(),
            'dzongkhag'           =>  $this->getUserDzoId(),
            'program_id'          =>  $id,
            'action_type'         =>  $action_type,
            'accessLevel'         =>  $this->getAccessLevel()
        ];
        $query = http_build_query($data);
        // dd($query);
        $response_data= $this->apiService->listData('emis/staff/hrdevelopment/getParticipantDetails/'.$query);
        return $response_data;
    }
    public function deleteParticipant($id=""){
        $response_data= $this->apiService->listData('emis/staff/hrdevelopment/getParticipantDetailsById/'.$id);
        $docs=json_decode($response_data)->data->document;
        if(sizeof($docs)>0){
            foreach($docs as $doc){
                $full_path=$doc->path.'/'.$doc->original_name;
                if (file_exists($doc->path.'/'.$doc->original_name)){
                    unlink($full_path);
                    $response_data = $this->apiService->deleteData("emis/staff/hrdevelopment/deleteFile", $doc->id);
                }
            }
        }
        $response_data= $this->apiService->listData('emis/staff/hrdevelopment/deleteParticipant/'.$id);
        return $response_data;
    }

    public function submitParticipants(Request $request){
        $request_data =[
            'programId'                 =>  $request->programId,
            'org_id'                    =>  $this->getWrkingAgencyId(),
            'dzo_id'                    =>  $this->getUserDzoId(),
            'remarks'                   =>  $request->remarks,
            'user_id'                   =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/hrdevelopment/submitParticipants', $request_data);
        // dd( $response_data);
        // $workflow_data=[
        //     'db_name'           =>'staff_db',
        //     'table_name'        =>'program_application',
        //     'service_name'      => 'Hr Development',
        //     'application_number'=>json_decode($response_data)->data->app_no,
        //     'screen_id'         =>$request->programId,
        //     'status_id'         =>$request->statusId,
        //     'remarks'           =>$request->remarks,
        //     'user_dzo_id'       =>$this->getUserDzoId(),
        //     'access_level'      =>$this->getAccessLevel(),
        //     'working_agency_id' =>$this->getWrkingAgencyId(),
        //     'action_by'         =>$this->userId(),
        // ];
        // dd($workflow_data);
        //$work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        // dd($work_response_data);
        return $response_data;
    }

    public function updateParticipant(Request $request){
        $request_data =[
            'updatedata'                 =>  $request->participant_list,
            'user_id'                   =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/hrdevelopment/updateParticipant', $request_data);
        return $response_data;
    }

    public function updateapplication(Request $request){
        $request_data =[
            'programId'                 =>  $request->programId,
            'remarks'                   =>  $request->remarks,
            'status'                    =>$request->statusId,
            'user_id'                   =>  $this->userId()
        ];
        $response_data = $this->apiService->createData('emis/staff/hrdevelopment/updateapplication', $request_data);
        $workflow_data=[
            'db_name'           =>'staff_db',
            'table_name'        =>'program_application',
            'service_name'      => 'Hr Development',
            'application_number'=>'NA',
            'screen_id'         =>$request->programId,
            'status_id'         =>$request->statusId,
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        return $response_data;
    }

    public function saveprogramOpenDetail(Request $request){
        $rules = [
            'staff'             =>  'required',
            'from_date'           =>  'required',
            'to_date'               =>  'required',
        ];
        $customMessages = [
            'staff.required'              => 'Please select staff',
            'from_date.required'          => 'Please select start date',
            'to_date.required'            => 'Please select end date',
        ];
        $this->validate($request, $rules,$customMessages);
        $user_id= $this->apiService->listData('system/getuserIdByStaffId/'.$request->staff);
        if(json_decode($user_id)==[] ||$user_id==""){
            return 'This person doesnot have valid user. Please cpntact system administrator for further procedural';
        }else{
            $user_id=json_decode($user_id)[0]->user_id;
        }
        $request['staff_user_id'] = $user_id;
        $request['user_id'] = $this->userId();
        $response_data = $this->apiService->createData('emis/staff/hrdevelopment/saveprogramOpenDetail', $request->all());
        return $response_data;
    }

    public function getprogramOpenDetail(){
        $response_data= $this->apiService->listData('emis/staff/hrdevelopment/getprogramOpenDetail');
        return $response_data;
    }

    public function checkProgramAccess(){
        $response_data= $this->apiService->listData('emis/staff/hrdevelopment/checkProgramAccess/'.$this->userId());
        return $response_data;
    }
}
