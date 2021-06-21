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
    // public $bif_table_name="bifurcations";

    public $service_name="Principal Recuritment";
    // public $service_name_closure="Closure";
    // public $merge_service_name="Merger";
    // public $bif_service_name="Bifurcation";

    public function __construct(EmisService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getpersonbycid($cid){
        $person = json_decode($this->apiService->listData('getcensusdata/'. $cid));
        if ($person->citizenDetailsResponse){
            $response_data = $person->citizenDetailsResponse;
            return  $response_data;
        }else {
            return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        }
    }

    public function savePrincipalApproval(Request $request){
        dd($request);
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
                if($work->screenName==$request->application_for){
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
                // dd($workflow_data);
                 $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
            }
                 return $response_data;
    }

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
        $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));
        // dd($workflowdet);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/staff/staffRecruitmentController/loadPrincipalRecuritmentApplication/'.$appNo));
        // dd($this->apiService->listData('emis/organization/changeDetails/loadChangeDetailForVerification/'.$appNo));
        $service_name=$loadOrganizationDetails->data->establishment_type;//pulled category from existing organization details to match the data for verification
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
        if($loadOrganizationDetails!=null){
            $loadOrganizationDetails->app_stage=$workflowstatus;
            $loadOrganizationDetails->screen_id=$screen_id;
            $loadOrganizationDetails->sequence=$sequence;
        }
        // dd($loadOrganizationDetails);
        // $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }
    
    private function validatePrincipalRecuritmentApprovalFields($request){
        $rules = [
            'paddress'                   =>  'required',
            'email'                      =>  'required',
            'contact_number'             =>  'required'
        ];
        $customMessages = [
            'paddress.required'          => 'Proposed Name is required',
            'email.required'             => 'Initiated By is required',
            'contact_number.required'    => 'Organization is required'
        ];
        $this->validate($request, $rules, $customMessages);

        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }
    private function setPrincipalRecuritmentApprovalFields($request){

        $data =[
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
}
