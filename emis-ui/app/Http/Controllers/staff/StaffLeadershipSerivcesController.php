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
            'details'           =>  'required',
            'from_date'         =>  'required | date',
            'to_date'           =>  'required | date | after:from_date',
        ];
        $customMessages = [
            'selection_type.required'   => 'This field is required',
            'position_title.required'   => 'This field is required',
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
    public function loadPostDetials($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadPostDetials/'.$this->getRoleIds('roleIds'));
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
    public function checkforfeedbackLink(){
        if($this->staffId()!=""){
            $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/checkforfeedbackLink/'.$this->staffId() );
            return $response_data;
        }
    }
    public function getleadershipDetailsForFeedback($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/getleadershipDetailsForFeedback/'.$id);
        return $response_data;
    }
}
