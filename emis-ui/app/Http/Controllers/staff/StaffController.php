<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StaffController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function getEmployeeDetials($emp_type="",$emp_id=""){
        $person = json_decode($this->apiService->listData('getEmployeeDetials/'. $emp_type.'/'.$emp_id));
        // dd($person->data->hasdata);
        if($person->data->hasdata){
            $response_data = $person->data->employee[0];
            return  response()->json($response_data);
        }else{
            return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        }
        return  response()->json($person);
    }
    public function savePersonalDetails(Request $request){
        $rules = [
            'emp_type'              =>  'required',
            'cid_work_permit'       =>  'required',
            'name'                  =>  'required',
            'sex_id'                =>  'required',
            'dob'                   =>  'required',
            'contact_number'        =>  'required',
            'email'                 =>  'required',
            'position_title'        =>  'required',
            // 'working_agency_id'     =>  'required',
            // 'currier_stage'         =>  'required',
        ];

        $customMessages = [
            'cid_work_permit.required'      => 'This field is required',
            'name.required'                 => 'This field is required',
            'sex_id.required'               => 'This field is required',
            'dob.required'                  => 'This field is required',
            'contact_number.required'       => 'This field is required',
            'email.required'                => 'This field is required',
            'position_title.required'       => 'This field is required',
            // 'working_agency_id.required'    => 'This field is required',
            // 'currier_stage.required'        => 'This field is required',
        ];
        if($request->isteaching){
            $rules= $rules+['comp_sub'              =>  'required',
                            'elective_sub1'         =>  'required'];
            $customMessages= $customMessages+[
                'comp_sub.required'              =>  'This field is required',
                'elective_sub1.required'         =>  'This field is required'];
        }
        if($request->emp_type=="Regular" || $request->emp_type=="Volunteer"){
            $rules=array_merge($rules,
                array('marital_status'        =>  'required',
                'emp_file_code'         =>  'required',)
            );
            $customMessages =array_merge($customMessages,
                array('marital_status.required'       => 'This field is required',
                'emp_file_code.required'        => 'This field is required',
                )
            );
        }
        $this->validate($request, $rules,$customMessages);
        $personal_details =[
            'personal_id'       =>  $request->personal_id,
            'emp_type'          =>  $request->emp_type,
            'cid_work_permit'   =>  $request->cid_work_permit,
            'emp_id'            =>  $request->emp_id,
            'name'              =>  $request->name,
            'organization_type' =>  $request->organization_type,
            'sex_id'            =>  $request->sex_id,
            'marital_status'    =>  $request->marital_status,
            'dob'               =>  $request->dob,
            'country_id'        =>  $request->country_id,
            'p_dzongkhag'       =>  $request->p_dzongkhag,
            'p_gewog'           =>  $request->p_gewog,
            'p_village_id'      =>  $request->p_village_id,
            'dzo_id'            =>  $request->dzongkhag,
            'geowg_id'          =>  $request->gewog,
            'village_id'        =>  $request->village_id,
            'address'           =>  $request->address,
            'contact_number'    =>  $request->contact_number,
            'email'             =>  $request->email,
            'alternative_email' =>  $request->alternative_email,
            'remarks'           =>  $request->remarks,
            'position_title'    =>  $request->position_title,
            'working_agency_id' =>  $request->working_agency_id,
            'comp_sub'          =>  $request->comp_sub,
            'elective_sub1'     =>  $request->elective_sub1,
            'elective_sub2'     =>  $request->elective_sub2,
            'initial_appointment_date' =>  $request->initial_appointment_date,
            'currier_stage'     =>  $request->currier_stage,
            'emp_file_code'     =>  $request->emp_file_code,
            'status'            =>  $request->status,
            'user_id'           =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/savePersonalDetails', $personal_details);
        return $response_data;
    }
    public function loaddraftpersonalDetails(Request $request,$type=""){
        $response_data= $this->apiService->listData('emis/staff/loaddraftpersonalDetails/'.$type.'/'.$this->userId());
        return $response_data;
    }
    public function checkThisCid($cid=""){
        $response_data= $this->apiService->listData('emis/staff/checkThisCid/'.$cid);
        return $response_data;
    }

    public function savequalificationDetails(Request $request){
        $rules = [
            'description'      =>  'required',
            'qualification'    =>  'required',
            'coursemode'       =>  'required',
            'coursetitle'      =>  'required',
            'firstsub'         =>  'required',
            'country'          =>  'required',
            'startdate'        =>  'required',
            'enddate'          =>  'required'
        ];
        $customMessages = [
            'description.required'        => 'This field is required',
            'qualification.required'      => 'This field is required',
            'coursemode.required'         => 'This field is required',
            'coursetitle.required'        => 'This field is required',
            'firstsub.required'           => 'This field is required',
            'country.required'            => 'Country field is required',
            'startdate.required'          => 'This field is required',
            'enddate.required'            => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);

        $qualification_details =[
            'personal_id'                       =>  $request->personal_id,
            'qualification_id'                  =>  $request->qualification_id,
            'action_type'                       =>  $request->action_type,
            'description'                       =>  $request->description,
            'qualification'                     =>  $request->qualification,
            'coursemode'                        =>  $request->coursemode,
            'coursetitle'                       =>  $request->coursetitle,
            'firstsub'                          =>  $request->firstsub,
            'secondsub'                         =>  $request->secondsub,
            'country'                           =>  $request->country,
            'startdate'                         =>  $request->startdate,
            'enddate'                           =>  $request->enddate,
            'status'                            =>  $request->status,
            'user_id'                           =>  $this->userId()
        ];
        // dd($qualification_details);
        $response_data= $this->apiService->createData('emis/staff/savequalificationDetails', $qualification_details);
        return $response_data;
    }

    public function loadQualification($staff_id=""){
        $response_data= $this->apiService->listData('emis/staff/loadQualification/'.$staff_id.'/'.$this->userId());
        return $response_data;
    }
    public function loadStaffQualification($staff_id=""){
        $response_data= $this->apiService->listData('emis/staff/loadStaffQualification/'.$staff_id);
        return $response_data;
    }

    public function savenominationDetails(Request $request){
        $rules = [
            'nomi_cid'          =>  'required',
            'nomi_name'         =>  'required',
            'nomi_desig'        =>  'required',
            'nomi_address'      =>  'required',
            'nomi_contact'      =>  'required',
            'nomi_email'        =>  'required',
            'nomi_relation'     =>  'required',
        ];
        $customMessages = [
            'nomi_name.required'            => 'This field is required',
            'nomi_cid.required'             => 'This field is required',
            'nomi_desig.required'           => 'This field is required',
            'nomi_address.required'         => 'This field is required',
            'nomi_email.required'           => 'This field is required',
            'nomi_relation.required'        => 'Country field is required',
        ];
        $this->validate($request, $rules,$customMessages);

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'familyRelationship';
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

        $nomination_details =[
            'personal_id'                       =>  $request->personal_id,
            'nomination_id'                     =>  $request->nomination_id,
            'action_type'                       =>  $request->action_type,
            'nomi_cid'                          =>  $request->nomi_cid,
            'nomi_name'                         =>  $request->nomi_name,
            'nomi_desig'                        =>  $request->nomi_desig,
            'nomi_address'                      =>  $request->nomi_address,
            'nomi_contact'                      =>  $request->nomi_contact,
            'nomi_email'                        =>  $request->nomi_email,
            'nomi_relation'                     =>  $request->nomi_relation,
            'isnominee'                         =>  $request->isnominee,
            'attachment_details'                =>  $attachment_details,
            'nomi_percentage'                   =>  $request->nomi_percentage,
            'status'                            =>  $request->status,
            'user_id'                           =>  $this->userId()
        ];
        // dd($nomination_details);
        $response_data= $this->apiService->createData('emis/staff/savenominationDetails', $nomination_details);
        return $response_data;
    }

    public function loadNominations($staff_id=""){
        $response_data= $this->apiService->listData('emis/staff/loadNominations/'.$staff_id.'/'.$this->userId());
        return $response_data;
    }
    public function loadStaffNomination($staff_id=""){
        $response_data= $this->apiService->listData('emis/staff/loadStaffNomination/'.$staff_id);
        return $response_data;
    }


    public function updatefinalstaffDetails(Request $request){
        $staff_details =[
            'personal_id'                       =>  $request->personal_id,
            'nomination_id'                     =>  $request->nomination_id,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/updatefinalstaffDetails', $staff_details);
        return $response_data;
    }
    public function updatefinalPrivatestaffDetails(Request $request){
        $staff_details =[
            'personal_id'                       =>  $request->personal_id,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/updatefinalPrivatestaffDetails', $staff_details);
        return $response_data;
    }

    // public function loadAllStaff($type=""){
    //     $response_data= $this->apiService->listData('emis/staff/loadAllStaff/'.$type);
    //     return $response_data;
    // }
    public function saveTransferWindow(Request $request){
        $rules = [
            'year'                  =>  'required  ',
            'from_date'             =>  'required | date',
            'to_date'               =>  'required | date | after:from_date',
        ];
        $customMessages = [
            'year.required'                     => 'Current Year is required',
            'from_date.required'                => 'Please select from date',
            'to_date.required'                  => 'Please select to date',
        ];
        $this->validate($request, $rules,$customMessages);
        $transfer_window_details =[
            'id'                                =>  $request->id,
            'year'                              =>  $request->year,
            'from_date'                         =>  $request->from_date,
            'to_date'                           =>  $request->to_date,
            'action_type'                       =>  $request->action_type,
            'remarks'                           =>  $request->remarks,
            'status'                            =>  $request->status,
            'user_id'                           =>  $this->userId()
        ];
        // dd($transfer_window_details);
        $response_data= $this->apiService->createData('emis/staff/transfer/saveTransferWindow', $transfer_window_details);
        return $response_data;
    }

    public function loadTransferWindow(){
        $response_data= $this->apiService->listData('emis/staff/transfer/loadTransferWindow');
        return $response_data;
    }
    // public function loadStaff($type=""){
    //     $param="";
    //     if($type=="workingagency"){
    //         $param=$this->getWrkingAgencyId();
    //     }
    //     if($type=="dzongkhagwise"){
    //         $param=$this->getUserDzoId();
    //     }
    //     $response_data= $this->apiService->listData('emis/staff/loadStaff/'.$type.'/'.$param);
    //     return $response_data;
    // }
}
