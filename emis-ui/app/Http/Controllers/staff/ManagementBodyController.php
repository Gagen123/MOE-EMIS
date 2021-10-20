<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
class ManagementBodyController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveManagementBody(Request $request){
        $rules = [
            'body_type'                =>  'required',
            'from_date'                =>  'required',
            'to_date'                  =>  'required',
        ];
        $customMessages = [
            'body_type.required'      => 'This field is required',
            'from_date.required'      => 'This field is required',
            'to_date.required'        => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'managementdocument';
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
                            'application_number'     =>  $request->applicationNo,
                        )
                    );
                }
            }
        }
        $mgmn_details =[
            'id'                            =>  $request->id,
            'type'                          =>  $request->type,
            'body_type'                     =>  $request->body_type,
            'from_date'                     =>  $request->from_date,
            'to_date'                       =>  $request->to_date,
            'org'                           =>  $this->getWrkingAgencyId(),
            'dzongkhag'                     =>  $this->getUserDzoId(),
            'remarks'                       =>  $request->remarks,
            'attachment_details'            =>  $attachment_details,
            'user_id'                       =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/managementBody/saveManagementBody', $mgmn_details);
        return $response_data;
    }


    public function saveManagementBodyComposition(Request $request){
        $rules = [
            'nonstaffname'  =>  'required',
            'designation'   =>  'required',
            'phone'         =>  'required',
        ];
        $customMessages = [
            'nonstaffname.required' => 'This field is required',
            'designation.required'  => 'This field is required',
            'phone.required'        => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $mgmn_details =[
            'management_id'   =>$request->management_id,
            'emptye'          =>$request->emptye,
            'nonstaffname'    =>$request->nonstaffname,
            'designation'     =>$request->designation,
            'phone'           =>$request->phone,
            'email'           =>$request->email,
            'address'         =>$request->address,
            'fromdate'        =>$request->fromdate,
            'todate'          =>$request->todate,
            'org'             =>$this->getWrkingAgencyId(),
            'dzongkhag'       =>$this->getUserDzoId(),
            'user_id'         =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/managementBody/saveManagementBodyComposition', $mgmn_details);
        return $response_data;
    }

    public function saveManagementMeeting(Request $request){
        $rules = [
            'meeting_date'   =>'required',
            'start_time'     =>'required',
            'end_time'       =>'required',
            'venue'          =>'required',
        ];
        $customMessages = [
            'meeting_date.required' =>'This field is required',
            'start_time.required'   =>'This field is required',
            'end_time.required'     =>'This field is required',
            'venue.required'        =>'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);

        $meeting_data =[
            'id'            => $request->id,
            'meeting_date'  => $request->meeting_date,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'venue'         => $request->venue,
            'members'       => $request->met_members,
            'created_by'    => $this->userId(),
        ];
        $response_data= $this->apiService->createData('emis/staff/managementBody/saveManagementMeeting', $meeting_data);
        return $response_data;
    }

    public function saveResolutions(Request $request){
        // $rules = [
        //     'minutes'   =>'required',
        // ];
        // $customMessages = [
        //     'minutes.required' =>'This field is required',
        // ];
        // $this->validate($request, $rules,$customMessages);

        // foreach($request->minutesas $_data){
        //     dd($data);
        //     $obj->created_by = $this->userId();
        // }

        // dd($request->minutes);

        $meeting_data =[
            'minutes'     => $request->minutes, //hass array of reslution
            'created_by'  => $this->userId(),
        ];
        $response_data= $this->apiService->createData('emis/staff/managementBody/saveResolutions', $meeting_data);
        return $response_data;

    }

    public function loadCurrentMeeting(){
        $response_data= $this->apiService->listData('emis/staff/managementBody/loadCurrentMeeting/'.$this->userId());
        return $response_data;
    }

    public function loadManagementBodyComposition($id=""){
        $response_data= $this->apiService->listData('emis/staff/managementBody/loadManagementBodyComposition/'.$id);
        return $response_data;
    }
    public function deleteManagementBodyComposition($id="",$itemId=""){
        $response_data= $this->apiService->listData('emis/staff/managementBody/deleteManagementBodyComposition/'.$id.'/'.$itemId);
        return $response_data;
    }

    public function updateManagementBody(Request $request){
        $mgmn_details =[
            'id'      =>  $request->id,
        ];
        $response_data= $this->apiService->createData('emis/staff/managementBody/updateManagementBody', $mgmn_details);
        return $response_data;
    }

    public function loadcreatedManagementBodyComposition(){
        $param=$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        $response_data= $this->apiService->listData('emis/staff/managementBody/loadcreatedManagementBodyComposition/'.$param);
        return $response_data;
    }

    public function loadcurrentbaord($id="",$itemId=""){
        $response_data= $this->apiService->listData('emis/staff/managementBody/loadcurrentbaord/'.$id);
        return $response_data;
    }


}
