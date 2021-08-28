<?php

namespace App\Http\Controllers\staff;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffApprovalController extends Controller
{
    public $apiService;
    use AuthUser;
    use ServiceHelper;
    public $database_name="staff_db";
    public $table_name="application_details";
    public $service_name="Principal Recuritment";
    public $service_name_expa="Expatriate Recuritment";
    public function __construct(EmisService $apiService)
        {
            $this->apiService = $apiService;
        }

    //Method to pull user information from census through cid number
    public function getpersonbycid($cid){
        $person = json_decode($this->apiService->listData('getCensusdata/'. $cid));
        if ($person->citizenDetailsResponse){
            $response_data = $person->citizenDetailsResponse;
            return  $response_data;
        }else {
            return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        }
    }

    public function savePrincipalApproval(Request $request){
        $this->service_name = $request['application_for'];
        //File Upload
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').$request['application_type'];
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
                            'path'                   =>  $file_store_path,
                            'original_name'          =>  $file_name,
                            'user_defined_name'      =>  $filenames[$index],
                            'saveapplication_number' =>  $request->applicationNo,
                        )
                    );
                }
            }
        }
        $request['attachment_details'] = $attachment_details;
        $principalApproval_data="";
        $validation ="";
        switch($request['application_type']){
            case "principal_recruitment" : {
                    $validation = $this->validatePrincipalRecuritmentApprovalFields($request);
                    $principalApproval_data = $this->setPrincipalRecuritmentApprovalFields($request);
                    break;
                }
                default : {
                    break;
                }
            }
            $rules = $validation['rules'];
            $customMessages = $validation['messages'];

            $this->validate($request, $rules, $customMessages);
            $principalApproval_data=$principalApproval_data+[
                'attachment_details'            =>   $attachment_details,
            ];
            $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
            //  dd($workflowdet,$request->application_for);
            $screen_id="";
            $status="";
            $app_role="";
            $screen_name="";
            foreach($workflowdet as $work){
                if(strtolower($work->screenName)==strtolower($request->application_for)){
                    $screen_id=$work->SysSubModuleId;
                    $status=$work->Sequence;
                    $app_role=$work->SysRoleId;
                    $screen_name=$work->screenName;
                }
            }

            if($screen_id==null || $screen_id==""){
                return 'No Screen';
            }
            $response_data= $this->apiService->createData('emis/staff/staffRecruitmentController/savePrincipalApproval', $principalApproval_data);
            if($request->action_type!="edit"){
                $workflow_data=[
                    'db_name'           =>$this->database_name,
                    'table_name'        =>$this->table_name,
                    'service_name'      =>$screen_name,//screen name
                    'application_number'=>json_decode($response_data)->application_no,
                    'name'              =>$request['application_for'],
                    'screen_id'         =>$screen_id,
                    'status_id'         =>$status,
                    'remarks'           =>null,
                    'app_role_id'       => $app_role,
                    'user_dzo_id'       =>$this->getUserDzoId(),
                    'access_level'      =>$this->getAccessLevel(),
                    'working_agency_id' =>$this->getWrkingAgencyId(),
                    'action_by'         =>$this->userId(),
                ];
                 $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
            }
                 return $response_data;
    }

    //Loading the principal recuritment application details
    public function loadPrincipalRecuritmentApplication($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data);

        // $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $workflowstatus="";
        $screen_id="";
        $sequence="";
        $workflowstatus="";
        // dd(json_decode($updated_data)->data->screen_id);
        $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));
        // dd($workflowdet);
        $PrincipalApprovalDetails = json_decode($this->apiService->listData('emis/staff/staffRecruitmentController/loadPrincipalRecuritmentApplication/'.$appNo));
        // dd($this->apiService->listData('emis/organization/changeDetails/loadChangeDetailForVerification/'.$appNo));
        $service_name=$PrincipalApprovalDetails->data->application_for;//pulled category from existing organization details to match the data for verification
        // dd($service_name,$workflowdet);
        foreach($workflowdet as $work){
            //check with screen name and then type of organization
            // dd(strtolower($work->screenName),$work->Establishment_type,$service_name);
            if($work->Sequence!=1 && $work->screenName==$service_name){
                $workflowstatus=$work->Status_Name;
                $screen_id=$work->SysSubModuleId;
                $sequence=$work->Sequence;
            }
        }
        if($PrincipalApprovalDetails!=null){
            $PrincipalApprovalDetails->app_stage=$workflowstatus;
            $PrincipalApprovalDetails->screen_id=$screen_id;
            $PrincipalApprovalDetails->sequence=$sequence;
        }
        // dd($PrincipalApprovalDetails);
        // $PrincipalApprovalDetails->app_stage=$workflowstatus;
        return json_encode($PrincipalApprovalDetails);
    }

    //updating the principal application during the approval process
    public function updatePrincipalApproval(Request $request){
        $org_status='Verified';
        $work_status=$request->sequence;
        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
        }
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$request->application_for,
            'application_number'=>$request->application_no,
            'screen_id'         =>$request->screen_id,//pulled while loading details for verification
            'status_id'         =>$work_status,//pulled while loading details for verification
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'ChangeVerification';
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
                            'path'                   =>  $file_store_path,
                            'original_name'          =>  $file_name,
                            'user_defined_name'      =>  $filenames[$index],
                            'saveapplication_number' =>  $request->application_no,
                        )
                    );
                }
            }
        }
        $data =[
            'status'                        =>   $org_status,
            'application_number'            =>   $request->application_no,
            'remarks'                       =>   $request->remarks,
            'attachment_details'            =>   $attachment_details,
            'user_id'                       =>   $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffRecruitmentController/updatePrincipalApproval', $data);
        return ($response_data);
    }

    //updating the expatriate recuritment during the approval process
    public function UpdateExpatriateRecuritment(Request $request){
        $org_status='Verified';
        $work_status=$request->sequence;
        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
        }
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$request->application_for,
            'application_number'=>$request->application_no,
            'screen_id'         =>$request->screen_id,//pulled while loading details for verification
            'status_id'         =>$work_status,//pulled while loading details for verification
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'ChangeVerification';
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
                            'path'                   =>  $file_store_path,
                            'original_name'          =>  $file_name,
                            'user_defined_name'      =>  $filenames[$index],
                            'saveapplication_number' =>  $request->application_no,
                        )
                    );
                }
            }
        }
        $data =[
            'status'                        =>   $org_status,
            'application_number'            =>   $request->application_no,
            'remarks'                       =>   $request->remarks,
            'attachment_details'            =>   $attachment_details,
            'user_id'                       =>   $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffRecruitmentController/UpdateExpatriateRecuritment', $data);
        return ($response_data);
    }

    private function validatePrincipalRecuritmentApprovalFields($request){
        $rules = [
            'cid'                        =>  'required',
            'paddress'                   =>  'required',
            'email'                      =>  'required',
            'contact_number'             =>  'required'
        ];
        $customMessages = [
            'cid.required'               => 'Please enter Cid Number',
            'paddress.required'          => 'Present address is required',
            'email.required'             => 'Email address is required',
            'contact_number.required'    => 'Contact Number is required'
        ];
        $this->validate($request, $rules, $customMessages);

        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }
    private function setPrincipalRecuritmentApprovalFields($request){
        $data =[
            'cid'                       =>  $request['cid'],
            'organizationId'            =>  $request['organizationId'],
            'name'                      =>  $request['name'],
            'dob'                       =>  $request['dob'],
            'dzongkhag'                 =>  $request['dzongkhag'],
            'gewog'                     =>  $request['gewog'],
            'village'                   =>  $request['village'],
            'paddress'                  =>  $request['paddress'],
            'email'                     =>  $request['email'],
            'contact_number'            =>  $request['contact_number'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];

        return $data;
    }

    //Method to save the Expatriate recuritment
    public function saveExpatriateRecuritment(Request $request){
        $this->service_name = $request['application_for'];
        //File Upload
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').$request['application_type'];
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
                            'path'                   =>  $file_store_path,
                            'original_name'          =>  $file_name,
                            'user_defined_name'      =>  $filenames[$index],
                            'saveapplication_number' =>  $request->applicationNo,
                        )
                    );
                }
            }
        }
        $request['attachment_details'] = $attachment_details;
        $Expatriate_data="";
        $validation="";
            switch($request['application_type']){
                case "principal_recruitment" : {
                        $validation = $this->validatePrincipalRecuritmentApprovalFields($request);
                        $Expatriate_data = $this->setExpatriateRecuritmentFields($request);
                        break;
                    }
                    default : {
                        break;
                    }
                }
                $rules = $validation['rules'];
                $customMessages = $validation['messages'];

                $this->validate($request, $rules, $customMessages);
                $Expatriate_data=$Expatriate_data+[
                    'attachment_details'            =>   $attachment_details,
                ];
            $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
            $screen_id="";
            $status="";
            $app_role="";
            $screen_name="";
            foreach($workflowdet as $work){
                if(strtolower($work->screenName)==strtolower($request->application_for)){
                    $screen_id=$work->SysSubModuleId;
                    $status=$work->Sequence;
                    $app_role=$work->SysRoleId;
                    $screen_name=$work->screenName;
                }
            }
            if($screen_id==null || $screen_id==""){
                return 'No Screen';
            }
            $response_data= $this->apiService->createData('emis/staff/staffRecruitmentController/saveExpatriateRecuritment', $Expatriate_data);
           
            if($request->action_type!="edit"){
                $workflow_data=[
                    'db_name'           =>$this->database_name,
                    'table_name'        =>$this->table_name,
                    'service_name'      =>$screen_name,//screen name
                    'application_number'=>json_decode($response_data)->application_no,
                    'name'              =>$request['application_for'],
                    'screen_id'         =>$screen_id,
                    'status_id'         =>$status,
                    'remarks'           =>null,
                    'app_role_id'       => $app_role,
                    'user_dzo_id'       =>$this->getUserDzoId(),
                    'access_level'      =>$this->getAccessLevel(),
                    'working_agency_id' =>$this->getWrkingAgencyId(),
                    'action_by'         =>$this->userId(),
                ];
                 $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
            }
                 return $response_data;
    }

    private function setExpatriateRecuritmentFields($request){
        $data =[
            'passport'                  =>  $request['passport'],
            'name'                      =>  $request['name'],
            'dob'                       =>  $request['dob'],
            'country'                   =>  $request['country'],
            'address'                   =>  $request['address'],
            'email'                     =>  $request['email'],
            'contact_number'            =>  $request['contact_number'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];

        return $data;
    }

    private function validateExpatriateRecuritmentFields($request){
        $rules = [
            'passport'                   =>  'required',
            'name'                       =>  'required',
            'dob'                        =>  'required',
            'country'                    =>  'required',
            'address'                    =>  'required',
            'email'                      =>  'required',
            'contact_number'             =>  'required'
        ];
        $customMessages = [
            'passport.required'          => 'Passport/Emigration is required',
            'name.required'              => 'Name is required',
            'dob.required'               => 'Date of Birth is required',
            'country.required'           => 'Country is required',
            'address.required'           => 'Your Address is required',
            'email.required'             => 'Email Address is required',
            'contact_number.required'    => 'Contact Number is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }
    
    public function loadPrincipalApprovalApplication($type=""){
        $loadPrincipalApprovalApplication = $this->apiService->listData('emis/staff/staffRecruitmentController/loadPrincipalApprovalApplication/'.$this->userId().'/'.$type );
        return $loadPrincipalApprovalApplication;
    }

    public function loadExpatriateApprovalApplication($type=""){
        $loadExpatriateApprovalApplication = $this->apiService->listData('emis/staff/staffRecruitmentController/loadExpatriateApprovalApplication/'.$this->userId().'/'.$type );
        return $loadExpatriateApprovalApplication;
    }

    public function loadPrincipalApplicationDetials($appNo=""){
        $loadPrincipalApplicationDetials = $this->apiService->listData('emis/staff/staffRecruitmentController/loadPrincipalApplicationDetials/'.$appNo );
        return $loadPrincipalApplicationDetials;
    }
    public function loadPrincipalAttachmentDetials($id=""){
        $loadPrincipalAttachmentDetials = $this->apiService->listData('emis/staff/staffRecruitmentController/loadPrincipalAttachmentDetials/'.$id );
        return $loadPrincipalAttachmentDetials;
    }
}
