<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
class StaffLeadershipSerivcesController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function createPost(Request $request){
        $rules = [
            'selection_type'    =>  'required',
            'position_title'    =>  'required',
            'feedback'          =>  'required',
            'interview'         =>  'required',
            'shortlist'         =>  'required',
            'details'           =>  'required',
            'from_date'         =>  'required | date',
            'to_date'           =>  'required | date | after:from_date',
        ];
        $customMessages = [
            'selection_type.required'   => 'This field is required',
            'position_title.required'   => 'This field is required',
            'feedback.required'         => 'This field is required',
            'interview.required'        => 'This field is required',
            'shortlist.required'        => 'This field is required',
            'details.required'          => 'This field is required',
            'from_date.required'        => 'This field is required',
            'to_date.required'          => 'This field is required',
            'to_date.after'             => 'This field cannot be before start date',
        ];
        $this->validate($request, $rules,$customMessages);
        $staff_data =[
            'id'                            =>  $request->id,
            'selection_type'                =>  $request->selection_type,
            'position_title'                =>  $request->position_title,
            'feedback'                      =>  $request->feedback,
            'interview'                     =>  $request->interview,
            'shortlist'                     =>  $request->shortlist,
            'details'                       =>  $request->details,
            'from_date'                     =>  $request->from_date,
            'to_date'                       =>  $request->to_date,
            'document_List'                 =>  $request->document_List,
            'applicant_List'                =>  $request->applicant_List,
            'action_type'                   =>  $request->action_type,
            'user_id'                       =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/createPost', $staff_data);
        return $response_data;
    }

    public function loadAllPosts(){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadAllPosts/'.$this->userId());
        return $response_data;
    }
    public function loadDetials($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadDetials/'.$id);
        return $response_data;
    }

    public function loadAllPostList(){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadAllPostList/'.$this->getRoleIds('roleIds'));
        return $response_data;
    }
    public function loadPostDetials($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadPostDetials/'.$id);
        return $response_data;
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
        $app_data =[
            'id'                            =>  $request->id,
            'post_id'                       =>  $request->post_id,
            'staff_id'                      =>  $request->staff_id,
            'dzo_id'                        =>  $request->dzo_id,
            'org_id'                        =>  $request->org_id,
            'accessLevel'                   =>  $request->accessLevel,
            'remarks'                       =>  $request->remarks,
            'attachment_details'            =>  $attachment_details,
            'user_id'                       =>  $this->userId()
        ];
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
                'user_dzo_id'       =>  $this->getUserDzoId(),
                'access_level'      =>  $this->getAccessLevel(),
                'working_agency_id' =>  $this->getWrkingAgencyId(),
                'action_by'         =>  $this->userId(),
            ];
            $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
            //Notification data
            $notification_data=[
                'notification_for'              =>  'Leadership Selection',
                'notification_appNo'            =>  $appNo,
                'notification_message'          =>  '',
                'notification_type'             =>  'role',
                'notification_access_type'      =>  'all',
                'call_back_link'                =>  'tasklist',
                'user_role_id'                  =>  config('services.constant.notification_leadership_selection_applicaiton'),
                'dzo_id'                        =>  $this->getUserDzoId(),
                'working_agency_id'             =>  $this->getWrkingAgencyId(),
                'access_level'                  =>  $this->getAccessLevel(),
                'action_by'                     =>  $this->userId(),
            ];
            $this->apiService->createData('emis/common/insertNotification', $notification_data);
        }
        return $response_data;
    }

    public function loadAllApplication(){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadAllApplication/'.$this->userId());
        return $response_data;
    }

    public function loadapplicaitontDetials($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadapplicaitontDetials/'.$id);
        return $response_data;
    }

    public function loadapplicaitontDetialsforVerification($application_number="",$type=""){
        $update_data=[
            'applicationNo'     =>  $application_number,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $this->apiService->createData('emis/common/updateTaskDetails',$update_data);
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadapplicaitontDetialsforVerification/'.$application_number);
        return $response_data;
    }

    public function createLeadershipSelection(Request $request){
        $rules = [
            'selection_type'    =>  'required',
            'position_title'    =>  'required',
            'from_date'         =>  'required | date',
            'to_date'           =>  'required | date | after:from_date',
        ];
        $customMessages = [
            'selection_type.required'   => 'This field is required',
            'position_title.required'   => 'This field is required',
            'from_date.required'        => 'This field is required',
            'to_date.required'          => 'This field is required',
            'to_date.after'             => 'This field cannot be before start date',
        ];
        $this->validate($request, $rules,$customMessages);
        $staff_data =[
            'id'                            =>  $request->id,
            'selection_type'                =>  $request->selection_type,
            'position_title'                =>  $request->position_title,
            'from_date'                     =>  $request->from_date,
            'to_date'                       =>  $request->to_date,
            'details'                       =>  $request->details,
            'nomi_staffList'                =>  $request->nomi_staffList,
            'user_id'                       =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/createLeadershipSelection', $staff_data);
        return $response_data;
    }

    public function loadLeadershipSelection($type="",$id=""){
        if($type=="draft"){
            $id=$this->userId();
        }
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadLeadershipSelection/'.$type.'/'.$id);
        return $response_data;
    }

    public function createNominationForLeadershipSelection(Request $request){
        $rules = [
            'staff_type'            =>  'required',
            'cid'                   =>  'required',
            'name'                  =>  'required',
            'email'                 =>  'email',
        ];
        $customMessages = [
            'staff_type.required'           => 'This field is required',
            'cid.required'                  => 'This field is required',
            'name.required'                 => 'This field is required',
            'email.required'                => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $nomi_data =[
            'id'                            =>  $request->id,
            'leadership_id'                 =>  $request->leadership_id,
            'staff_id'                      =>  $request->staff_id,
            'staff_type'                    =>  $request->staff_type,
            'cid'                           =>  $request->cid,
            'name'                          =>  $request->name,
            'email'                         =>  $request->email,
            'feedback_id'                   =>  $request->feedback_id,
            'nominees_id'                   =>  $request->nominees_id,
            'user_id'                       =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/createNominationForLeadershipSelection', $nomi_data);
        return $response_data;
    }

    public function loadNominationForLeadershipSelection($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadNominationForLeadershipSelection/'.$id);
        return $response_data;
    }

    public function publishleadership(Request $request){
        $staff_data =[
            'id'                            =>  $request->id,
            'user_id'                       =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/publishleadership', $staff_data);
        return $response_data;
    }

    public function loadAllLeadershipSelection(){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadAllLeadershipSelection');
        return $response_data;
    }

    public function getleadershipDetailsForFeedback($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/getleadershipDetailsForFeedback/'.$id);
        return $response_data;
    }

    public function saveData(Request $request){
        $rules = [
            'name'                              =>  'required',
            'status'                            =>  'required',
        ];
        $customMessages = [
            'name.required'                     => 'This field is required',
            'status.required'                   => 'This field is required',
        ];
        if($request->record_type=="Question"){
            $rules = $rules+[
                'category_type_id'              =>  'required',
                'answer_type'                   =>  'required',
            ];
            $customMessages = $customMessages+[
                'category_type_id.required'     => 'This field is required',
                'answer_type.required'          => 'This field is required',
            ];
        }
        $this->validate($request, $rules,$customMessages);

        $nomi_data =[
            'id'                            =>  $request->id,
            'name'                          =>  $request->name,
            'status'                        =>  $request->status,
            'category_type_id'              =>  $request->category_type_id,
            'answer_type'                   =>  $request->answer_type,
            'answer'                        =>  $request->answer,
            'record_type'                   =>  $request->record_type,
            'action_type'                   =>  $request->action_type,
            'user_id'                       =>  $this->userId()
        ];
        // dd($nomi_data);
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/saveData', $nomi_data);
        return $response_data;
    }

    public function loadData($param=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadData/'.$param);
        return $response_data;
    }

    public function loadexistingData($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadexistingData/'.$id);
        return $response_data;
    }

    public function saveFeedbackProviderData(Request $request){
        $rules = [
            'feedback_type'                            =>  'required',
        ];
        $customMessages = [
            'feedback_type.required'                   => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $nomi_data =[
            'application_number'        =>  $request->application_number,
            'partifipant_from'          =>  $request->partifipant_from,
            'email'                     =>  $request->email,
            'contact'                   =>  $request->contact,
            'participant'               =>  $request->participant,
            'positiontitle'             =>  $request->positiontitle,
            'cid'                       =>  $request->cid,
            'name'                      =>  $request->name,
            'department'                =>  $request->department,
            'school'                    =>  $request->school,
            'dzongkhag'                 =>  $request->dzongkhag,
            'feedback_type'             =>  $request->feedback_type,
            'action_type'               =>  $request->action_type,
            'user_id'                   =>  $this->userId()
        ];
        // dd($nomi_data);
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/saveFeedbackProviderData', $nomi_data);
        return $response_data;
    }

    public function getFeedbackProviderData($appNo=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/getFeedbackProviderData/'.$appNo);
        // dd(json_decode($response_data));
        return $response_data;
    }

    public function deleteNomination($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/deleteNomination/'.$id);
        return $response_data;
    }

    public function verifyApproveNotify(Request $request){
        //upload attachments
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'Leadership_selection_verification';
        if($files!=null && $files!=""){
            if(sizeof($files)>0 && !is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            if(sizeof($files)>0){
                foreach($files as $index => $file){
                    $file_name = time().'_' .$file->getClientOriginalName();
                    //move_uploaded_file($file,$file_store_path.'/'.$file_name);
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
        //get feedback provider to send notification
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/getFeedbackProviderData/'.$request->application_number);
        if($request->action_type=="feedback" && $response_data!=null && $response_data!="" && sizeof(json_decode($response_data))>0){
            $feedback_provider=json_decode($response_data);
            $user_id="";
            foreach($feedback_provider as $feed){
                if($feed->partifipant_from=="outofministry"){
                    //$feed['email'] send email notification
                }
                else{
                    $appRole_id=json_decode($this->apiService->listData('system/getRoleDetails/'.$feed->participant));
                    // dd($feed->participant,$appRole_id,$feed->partifipant_from);
                    $user_id=$user_id.$appRole_id[0]->user_id.',';
                }
            }
            $notification_data=[
                'notification_for'              =>  'Leadership Selection',
                'notification_access_type'      =>  'all',
                'notification_message'          =>  '',
                'notification_type'             =>  'user',
                'call_back_link'                =>  'leadership_feedback',
                'user_role_id'                  =>  rtrim($user_id,','),
                'notification_appNo'            =>  $request->application_number,
                'dzo_id'                        =>  $this->getUserDzoId(),
                'working_agency_id'             =>  $this->getWrkingAgencyId(),
                'access_level'                  =>  $this->getAccessLevel(),
                'action_by'                     =>  $this->userId(),
            ];
            // dd($notification_data);
            $notification=$this->apiService->createData('emis/common/updateNextNotification', $notification_data);
        }
        //prepare data for verification, approval and other updates
        $current_status="";
        if($request->action_type=="feedback"){
            $current_status="Notified for Feedback";
        }
        $nomi_data =[
            'id'                        =>  $request->id,
            'application_number'        =>  $request->application_number,
            'application_date'          =>  $request->application_date,
            'feedback'                  =>  $request->feedback,
            'interview'                 =>  $request->interview,
            'shortlist'                 =>  $request->shortlist,
            'details'                   =>  $request->details,
            'aplicant_cid'              =>  $request->aplicant_cid,
            'aplicant_position_title'   =>  $request->aplicant_position_title,
            'aplicant_working_agency'   =>  $request->aplicant_working_agency,
            'aplicant_working_dzo'      =>  $request->aplicant_working_dzo,
            'aplicant_working_gewog'    =>  $request->aplicant_working_gewog,
            'verification_remarks'      =>  $request->verification_remarks,
            'feedback_start_date'       =>  $request->feedback_start_date,
            'feedback_end_date'         =>  $request->feedback_end_date,
            'feedback_details'          =>  $request->feedback_details,
            'current_status'            =>  $current_status,
            'action_type'               =>  $request->action_type,
            'attachment_details'        =>  $attachment_details,
            'user_id'                   =>  $this->userId()
        ];
        // dd($nomi_data);
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/verifyApproveNotify', $nomi_data);
        return $response_data;
    }
    //pull applicaiton detials for feedback
    public function checkforfeedbackLink(){
        if($this->staffId()!=""){
            $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/checkforfeedbackLink/'.$this->staffId() );
            return $response_data;
        }
    }

    public function getFeedbackData($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/getFeedbackData/'.$id);
        return $response_data;
    }

}
