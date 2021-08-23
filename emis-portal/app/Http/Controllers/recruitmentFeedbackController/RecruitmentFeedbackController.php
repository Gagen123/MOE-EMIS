<?php

namespace App\Http\Controllers\recruitmentFeedbackController;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecruitmentFeedbackController extends Controller{
    public $apiService;
    use AuthUser;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function loadData($param=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadData/'.$param);
        return $response_data;
    }
    public function getapplicationDetailsForFeedback(){
        if(Session::get('User_details')!=null && Session::get('User_details')->id!=""){
            $appNo=$this->apiService->listData('getProtalUserDetails/user_id__'.$this->userId());
            $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/getleadershipDetailsForFeedback/'.json_decode($appNo)->std_id);
            return $response_data;
        }
    }

    public function saveFeedback(Request $request){
        $request_data =[
            'feedback_id'               =>  $request->feedback_id,
            'application_number'        =>  $request->application_number,
            'selection_type_id'         =>  $request->selection_type_id,
            'position_title_id'         =>  $request->position_title_id,
            'questionList'              =>  $request->questionList,
            'user_id'                   =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/saveFeedback', $request_data);
        // $notification_data=[
        //     'notification_appNo'            =>  $request->application_number,
        //     'dzo_id'                        =>  $this->getUserDzoId(),
        //     'working_agency_id'             =>  $this->getWrkingAgencyId(),
        //     'access_level'                  =>  $this->getAccessLevel(),
        //     'action_by'                     =>  $this->userId(),
        // ];
        // $this->apiService->createData('emis/common/visitedNotification', $notification_data);
        return $response_data;
    }
    public function getEmployeeDetials($emp_type="",$emp_id=""){
        $person = json_decode($this->apiService->listData('getEmployeeDetials/'. $emp_type.'/'.$emp_id));
        if($person->data->hasdata){
            $response_data = $person->data->employee[0];
            return  response()->json($response_data);
        }else{
            return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        }
        return  response()->json($person);
    }

    public function getleadershipDetailsByPosition($position=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/getleadershipDetailsByPosition/'.$position);
        return $response_data;
    }

    public function getpostDetails(){
        if(Session::get('User_details')!=null && Session::get('User_details')->id!=""){
            $appNo=$this->apiService->listData('getProtalUserDetails/leadership_id__'.$this->userId());
            $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadPostDetials/'.json_decode($appNo)->vacancyId);
            return $response_data;
        }
    }

    public function submitApplication(Request $request){
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'Leadership_selection_application';
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
        // dd($attachment_details);
        $rules = [
            'post_id'    =>  'required',
            'staff_id'    =>  'required',
        ];
        $customMessages = [
            'post_id.required'   => 'This field is required',
            'staff_id.required'   => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);

        $staff_details=$this->apiService->listData('getProtalUserDetails/staff__'.$this->userId());
        $dzo_list=json_decode($this->apiService->listData('emis/masters/loadGlobalMasters/all_dzongkhag'))->data;
        $user_dzo=$user_dzo=json_decode($staff_details)->emp_Dzongkhag;
        if(strpos('Thromde',json_decode($staff_details)->emp_Dzongkhag)===false){
            $user_dzo=rtrim(json_decode($staff_details)->emp_Dzongkhag, " ");
        }
        $dzoId="";
        foreach($dzo_list as $dz){
            if(strpos($user_dzo,$dz->name)!==false){
                $dzoId=$dz->id;
            }
        }
        $app_data =[
            'id'                            =>  $request->id,
            'post_id'                       =>  $request->post_id,
            'staff_id'                      =>  $this->userId(),
            'dzo_id'                        =>  $dzoId,
            'org_id'                        =>  'External Application',
            'name'                          =>  $request->applicant_name,
            'accessLevel'                   =>  $request->accessLevel,
            'remarks'                       =>  $request->remarks,
            'attachment_details'            =>  $attachment_details,
            'accessLevel'                   =>  'NA',
            'user_id'                       =>  $this->userId()
        ];
        // dd($app_data);
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/submitApplication', $app_data);
        $appNo=json_decode($response_data)->data->application_number;
        if($request->id==""){
            $workflow_data=[
                'db_name'           =>  'staff_database',
                'table_name'        =>  'staff_leadership_application',
                'service_name'      =>  'Leadership Selection',
                'application_number'=>  $appNo,
                'screen_id'         =>  $appNo,
                'status_id'         =>  1,
                'remarks'           =>  $request->remarks,
                'user_dzo_id'       =>  $dzoId,
                'name'              =>  $request->applicant_name,
                'access_level'      =>  'NA',
                'working_agency_id' =>  'External Application',
                'action_by'         =>  $this->userId(),
            ];
            $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
            //Notification data
            // $notification_data=[
            //     'notification_for'              =>  'Leadership Selection',
            //     'notification_appNo'            =>  $appNo,
            //     'notification_message'          =>  '',
            //     'notification_type'             =>  'role',
            //     'notification_access_type'      =>  'all',
            //     'call_back_link'                =>  'tasklist',
            //     'user_role_id'                  =>  config('services.constant.notification_leadership_selection_applicaiton'),
            //     'dzo_id'                        =>  $this->getUserDzoId(),
            //     'working_agency_id'             =>  $this->getWrkingAgencyId(),
            //     'access_level'                  =>  $this->getAccessLevel(),
            //     'action_by'                     =>  $this->userId(),
            // ];
            // $this->apiService->createData('emis/common/insertNotification', $notification_data);
        }
        return $response_data;
    }

}
