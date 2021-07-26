<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class TransferController extends Controller{
    public $apiService;
    use AuthUser;
    public $database_name="staff_db";
    public $table_name="transfer_application";
    // public $service_name="Transfer";
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function getcurrentTransferWindowDetails($id=""){
        $response_data= $this->apiService->listData('emis/staff/transfer/getcurrentTransferWindowDetails/'.$id);
        return $response_data;
    }

    public function submitIntialapplicantDetails(Request $request){
        $rules = [
            'staff_id'              =>  'required  ',
            'reason_id'             =>  'required',
        ];
        $customMessages = [
            'staff_id.required'     => 'Please select applicant',
            'reason_id.required'    => 'Please select transfer reason',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'record_type_id'                    =>  $request->type_id,
            'staff_id'                          =>  $request->staff_id,
            'transferType'                      =>  $request->transferType,
            'transferwindow_id'                 =>  $request->transferwindow_id,
            'reason_id'                         =>  $request->reason_id,
            'description'                       =>  $request->description,
            'status'                            =>  $request->status,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/submitIntialapplicantDetails', $request_data);
        return $response_data;
    }
    public function getDraftDetails(){
        $response_data= $this->apiService->listData('emis/staff/transfer/getDraftDetails/'.$this->userId());
        return $response_data;
    }
    public function submitFinalapplicantDetails(Request $request){
        $service_name = $request->service_name;
        $rules = [
            'transferType'              =>  'required  ',
        ];
        $customMessages = [
            'transferType.required'     => 'Please select this',
        ];
        $this->validate($request, $rules,$customMessages);
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'Transfer';
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
                            'path'              =>  $file_store_path,
                            'original_name'     =>  $file_name,
                            'user_defined_name' =>  $filenames[$index],
                        )
                    );
                }
            }
        }
        $request_data =[
            'id'                                =>  $request->id,
            'record_type_id'                    =>  $request->type_id,
            'transferType'                      =>  $request->transferType,
            'preference_dzongkhag1'             =>  $request->preference_dzongkhag1,
            'preference_dzongkhag2'             =>  $request->preference_dzongkhag2,
            'preference_dzongkhag3'             =>  $request->preference_dzongkhag3,
            'dzongkhag_id'                      =>  $this->getUserDzoId(),
            'preference_school1'                =>  $request->preference_school1,
            'preference_school2'                =>  $request->preference_school2,
            'preference_school3'                =>  $request->preference_school3,
            'attachment_details'                =>  $attachment_details,
            'user_id'                           =>  $this->userId(),
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/submitFinalapplicantDetails', $request_data);
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$request->service_name,
            'application_number'=>  json_decode($response_data)->data->aplication_number,
            'screen_id'         =>  json_decode($response_data)->data->aplication_number,
            'status_id'         =>  1,
            'app_role_id'       => $this->getRoleIds('roleIds'),
            'record_type_id'    => json_decode($response_data)->data->transfer_type_id,
            'remarks'           =>null,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        return $work_response_data;
    }

    public function loadtrainsferDetails($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=json_decode($this->apiService->createData('emis/common/updateTaskDetails',$update_data));
        $loadTransferDetails = json_decode($this->apiService->listData('emis/staff/transfer/loadtrainsferDetails/'.$appNo));
        $response_data= json_decode($this->apiService->listData('emis/staff/transfer/getTransferConfigDetails/'.$this->getRoleIds('roleIds')));
        if($response_data!=null){
            foreach($response_data as $work){
                if($loadTransferDetails->data->transfer_type_id==$work->transfer_type_id && $updated_data->data->status_id==$work->sequence){
                    if($work->authority_type_id==10){
                        $loadTransferDetails->data->app_seq_no=$work->authority_type_id;
                    }
                    else{
                        $loadTransferDetails->data->app_seq_no=$work->sequence;
                    }
                }
            }
        }
        return json_encode($loadTransferDetails);
    }
    public function updateTransferApplication(Request $request){
        $org_status='Verified';
        $work_status=$request->status_id+1;
        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
            $work_status=10;
        }
        if($request->actiontype=="forward"){
            $org_status="Forwarded";
            $work_status=9;
        }
        if($request->actiontype=="report"){
            $org_status="Joined";
            $work_status=8;
        }
        if($request->transferType == "intra_transfer"){
            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>"intra transfer",
                'preference_school' =>$request->preference_school,
                'application_number'=>$request->application_no,
                'screen_id'         =>$request->application_no,
                'status_id'         =>$work_status,
                'remarks'           =>$request->remarks,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
                'dzongkhagApproved' =>$request->userDzongkhag, 
            ];
            $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        }
        if($request->transferType == "inter_transfer"){
            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>"inter transfer",
                'preference_school' =>$request->preference_school,
                'application_number'=>$request->application_no,
                'screen_id'         =>$request->application_no,
                'status_id'         =>$work_status,
                'remarks'           =>$request->remarks,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
                'dzongkhagApproved' =>$request->userDzongkhag, 
            ];
            $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        }
    
        // $files = $request->attachments;
        // $filenames = $request->attachmentname;
        // $remarks = $request->remarks;
        // $attachment_details=[];
        // $file_store_path=config('services.constant.file_stored_base_path').'transferVerification';
        // if($files!=null && $files!=""){
        //     if(sizeof($files)>0 && !is_dir($file_store_path)){
        //         mkdir($file_store_path,0777,TRUE);
        //     }
        //     if(sizeof($files)>0){
        //         foreach($files as $index => $file){
        //             $file_name = time().'_' .$file->getClientOriginalName();
        //             move_uploaded_file($file,$file_store_path.'/'.$file_name);
        //             array_push($attachment_details,
        //                 array(
        //                     'path'                   =>  $file_store_path,
        //                     'original_name'          =>  $file_name,
        //                     'user_defined_name'      =>  $filenames[$index],
        //                     'saveapplication_number' =>  $request->application_no,
        //                 )
        //             );
        //         }
        //     }
        // }
        if($request->transferType=='intra_transfer'){
            $data =[
                'id'                            =>  $request->id,
                'status'                        =>  $org_status,
                'staff_id'                      =>  $request->staff_id,
                'application_number'            =>  $request->application_no,
                'remarks'                       =>  $request->remarks,
                'transferType'                  =>  $request->transferType,
                'current_status'                =>  $request->actiontype,
                'status_id'                     =>  $work_status,
                'service_name'                  =>  "intra transfer",
                'preference_school'             =>$request->preference_school,
                'dzongkhagApproved'             =>$request->userDzongkhag,
                'schoolApproved'                =>$request->schoolApproved,
                // 'attachment_details'            =>   $attachment_details,
                'user_id'                       =>  $this->userId()
            ];
            
            $response_data= $this->apiService->createData('emis/staff/transfer/updateTransferApplication', $data);
        }
        else if($request->transferType=='inter_transfer'){
            $data =[
                'id'                            =>  $request->id,
                'status'                        =>  $org_status,
                'staff_id'                      =>  $request->staff_id,
                'application_number'            =>  $request->application_no,
                'remarks'                       =>  $request->remarks,
                'preference_school'             =>$request->preference_school,
                'transferType'                  =>  $request->transferType,
                'current_status'                =>  $request->actiontype,
                'status_id'                     =>  $work_status,
                'service_name'                  =>  "inter transfer",
                'dzongkhagApproved'             =>$request->userDzongkhag,
                // 'attachment_details'            =>   $attachment_details,
                'user_id'                       =>   $this->userId()
            ];
            $response_data= $this->apiService->createData('emis/staff/transfer/updateTransferApplication', $data);
        }
        return $response_data;
    }
    public function LoadSchoolByDzoId($type="",$parent_id=""){
        $parent_id =$this->getUserDzoId();
        $type = "userdzongkhagwise";
        $response_data = $this->apiService->listData('emis/common_services/loadOrgList/'.$type.'/'.$parent_id);

        return $response_data;
    }
    public function loadtransferDetails($type=""){
        $userId=$this->userId();
        $response_data = $this->apiService->listData('emis/staff/transfer/loadtransferDetails/'.$type.'/'.$userId);
        return $response_data;
    }
    public function loadApplicationDetails($id=""){
        $response_data = $this->apiService->listData('emis/staff/transfer/loadApplicationDetails/'.$id);
        return $response_data;
        

    }
    public function getapplicatName($id=""){
        $response_data = $this->apiService->listData('emis/staff/transfer/getapplicatName/'.$id);
        return $response_data;
    }
    public function LoadApplicationDetailsByUserId($user_id=""){
        $response_data = $this->apiService->listData('emis/staff/transfer/LoadApplicationDetailsByUserId/'.$user_id);
        return $response_data;
    }

    public function SaveTransferAppeal(Request $request){
        $rules = [
            'description'              =>  'required  ',
        ];
        $customMessages = [
            'description.required'     => 'Please mention the reasons for transfer appeal ',
        ];
        $this->validate($request, $rules,$customMessages);
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'TransferAppeal';
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
                            'path'              =>  $file_store_path,
                            'original_name'     =>  $file_name,
                            'user_defined_name' =>  $filenames[$index],
                        )
                    );
                }
            }
        }
        $request_data =[
            'id'                                =>  $request->id,
            'transferType'                      =>  $request->transferType,
            'name'                              =>  $request->name,
            'description'                       =>  $request->description,
            'attachment_details'                =>  $attachment_details,
            'user_id'                           =>  $request->user_id,
            'status'                            =>  $request->status,
        ];
        dd($request_data);
        $response_data= $this->apiService->createData('emis/staff/transfer/SaveTransferAppeal', $request_data);
       
    }
}
