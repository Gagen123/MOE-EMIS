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
                            'saveapplication_number'     =>  $request->applicationNo,
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
            dd($response_data,$workflowdet,$request->application_for);
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
