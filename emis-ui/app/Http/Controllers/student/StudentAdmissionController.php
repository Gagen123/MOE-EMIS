<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentAdmissionController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentDetails(Request $request){
        $rules = [
            'snationality'              => 'required',
            'cid_passport'              => 'required',
            'first_name'                => 'required',
            'dob'                       => 'required',
            'sex_id'                    => 'required',
            'mother_tongue'             => 'required',
            'std_class'                 => 'required'
        ];
        $customMessages = [
            'snationality.required'             => 'This field is required',
            'cid_passport.required'             => 'This field is required',
            'first_name.required'               => 'This field is required',
            'dob.required'                      => 'This field is required',
            'sex_id.required'                   => 'This field is required',
            'mother_tongue.required'            => 'This field is required',
            'std_class.required'                => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $file = $request->attachments;
        $path="";
        $file_store_path=config('services.constant.file_stored_base_path').'studentPhotoes';
        if($file!=null && $file!="" && $file!="undefined"){
            if(!is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            $file_name = time().'_' .$file->getClientOriginalName();
            move_uploaded_file($file,$file_store_path.'/'.$file_name);
            $path=$file_store_path.'/'.$file_name;
        }

        $data =[
            'snationality'              =>  $request->snationality,
            'std_class'                 =>  $request->std_class,
            'admission_no'              =>  $request->admission_no,
            'student_id'                =>  $request->student_id,
            'cid_passport'              =>  $request->cid_passport,
            'first_name'                =>  $request->first_name,
            'middle_name'               =>  $request->middle_name,
            'last_name'                 =>  $request->last_name,
            'dob'                       =>  $request->dob,
            'sex_id'                    =>  $request->sex_id,
            'dzongkhag'                 =>  $request->dzongkhag,
            'gewog'                     =>  $request->gewog,
            'village_id'                =>  $request->village_id,
            'fulladdress'               =>  $request->fulladdress,
            'mother_tongue'             =>  $request->mother_tongue,
            'type'                      =>  $request->type,
            'attachments'               =>  $path,
            'OrgOrganizationId'         =>  $this->getWrkingAgencyId(),
            'Dzongkhagid'               =>  $this->getUserDzoId(),
            'user_id'                   =>  $this->userId()
        ];
        // dd($data);
        //changed the route link to saveAdmissionStudentDetails from saveStudentDetails
        $response_data= $this->apiService->createData('emis/students/admission/saveAdmissionStudentDetails', $data);
        return $response_data;
    }

    public function saveStudentGardianDetails(Request $request){
        $rules = [
            'merital_status'                        => 'required',
            'primary_contact'                       => 'required',
        ];
        $customMessages = [
            'merital_status.required'             => 'This field is required',
            'primary_contact.required'            => 'This field is required',
        ];
        if($request->primary_contact == 'Father'){
            $additional_rules = [
                'father_nationality'                    => 'required',
                'father_cid_passport'                   => 'required',
                'father_first_name'                     => 'required',
                //'father_fulladdress'                    => 'required',
                'father_present_dzongkhag'              => 'required',
                'father_present_gewog'                  => 'required',
                'father_present_village_id'             => 'required',
                'father_work_address'                   => 'required',
                'father_residence_address'              => 'required',
                'father_occupation'                     => 'required',
                'father_email'                          => 'required',
                'father_cntct_no'                       => 'required',
            ];
            $rules = $rules + $additional_rules;

            $additional_message = [
                'father_nationality.required'                    => 'This field is required',
                'father_cid_passport.required'                   => 'This field is required',
                'father_first_name.required'                     => 'This field is required',
                //'father_fulladdress.required'                    => 'This field is required',
                'father_present_dzongkhag.required'              => 'This field is required',
                'father_present_gewog.required'                  => 'This field is required',
                'father_present_village_id.required'             => 'This field is required',
                'father_work_address.required'                   => 'This field is required',
                'father_residence_address.required'              => 'This field is required',
                'father_occupation.required'                     => 'This field is required',
                'father_email.required'                          => 'This field is required',
                'father_cntct_no.required'                       => 'This field is required',
            ];
            $customMessages = $customMessages + $additional_message;
            if($request->father_nationality == 'Bhutanese'){
                $additional_rules = [
                    'father_dzongkhag'                      => 'required',
                    'father_gewog'                          => 'required',
                    'father_village_id'                     => 'required',
                ];
                $rules = $rules + $additional_rules;

                $additional_message = [
                    'father_dzongkhag.required'                      => 'This field is required',
                    'father_gewog.required'                          => 'This field is required',
                    'father_village_id.required'                     => 'This field is required',
                ];
                $customMessages = $customMessages + $additional_message;
            }
        }
        if($request->primary_contact == 'Mother'){
            $additional_rules = [
                'mother_nationality'                    => 'required',
                'mother_cid_passport'                   => 'required',
                'mother_first_name'                     => 'required',
                'mother_fulladdress'                    => 'required',
                'mother_present_dzongkhag'              => 'required',
                'mother_present_gewog'                  => 'required',
                'mother_present_village_id'             => 'required',
                'mother_work_address'                   => 'required',
                'mother_residence_address'              => 'required',
                'mother_occupation'                     => 'required',
                'mother_email'                          => 'required',
                'mother_cntct_no'                       => 'required',
            ];
            $rules = $rules + $additional_rules;
            $additional_message = [
                'mother_nationality.required'                    => 'This field is required',
                'mother_cid_passport.required'                   => 'This field is required',
                'mother_first_name.required'                     => 'This field is required',
                'mother_dob.required'                            => 'This field is required',
                'mother_sex_id.required'                         => 'This field is required',
                'mother_fulladdress.required'                    => 'This field is required',
                'mother_present_dzongkhag.required'              => 'This field is required',
                'mother_present_gewog.required'                  => 'This field is required',
                'mother_present_village_id.required'             => 'This field is required',
                'mother_work_address.required'                   => 'This field is required',
                'mother_residence_address.required'              => 'This field is required',
                'mother_occupation.required'                     => 'This field is required',
                'mother_email.required'                          => 'This field is required',
                'mother_cntct_no.required'                       => 'This field is required',
            ];
            $customMessages = $customMessages + $additional_message;
            if($request->mother_nationality == 'Bhutanese'){
                $additional_rules = [
                    'mother_dzongkhag'                      => 'required',
                    'mother_gewog'                          => 'required',
                    'mother_village_id'                     => 'required',
                ];
                $rules = $rules + $additional_rules;

                $additional_message = [
                    'mother_dzongkhag.required'                      => 'This field is required',
                    'mother_gewog.required'                          => 'This field is required',
                    'mother_village_id.required'                     => 'This field is required',
                ];
                $customMessages = $customMessages + $additional_message;
            }
        }
        if($request->primary_contact == 'Others'){
            $additional_rules = [
                'gardain_nationality'                   => 'required',
                'gardain_cid_passport'                  => 'required',
                'gardain_first_name'                    => 'required',
                'gardain_fulladdress'                   => 'required',
                'gardain_present_dzongkhag'             => 'required',
                'gardain_present_gewog'                 => 'required',
                'gardain_present_village_id'            => 'required',
                'gardain_work_address'                  => 'required',
                'gardain_residence_address'             => 'required',
                'gardain_occupation'                    => 'required',
                'gardain_email'                         => 'required',
                'gardain_cntct_no'                      => 'required',
            ];
            $rules = $rules + $additional_rules;
            $additional_message = [
                'gardain_nationality.required'                    => 'This field is required',
                'gardain_cid_passport.required'                   => 'This field is required',
                'gardain_first_name.required'                     => 'This field is required',
                'gardain_fulladdress.required'                    => 'This field is required',
                'gardain_present_dzongkhag.required'              => 'This field is required',
                'gardain_present_gewog.required'                  => 'This field is required',
                'gardain_present_village_id.required'             => 'This field is required',
                'gardain_work_address.required'                   => 'This field is required',
                'gardain_residence_address.required'              => 'This field is required',
                'gardain_occupation.required'                     => 'This field is required',
                'gardain_email.required'                          => 'This field is required',
                'gardain_cntct_no.required'                       => 'This field is required',
            ];
            $customMessages = $customMessages + $additional_message;
            if($request->mother_nationality == 'Bhutanese'){
                $additional_rules = [
                    'gardain_dzongkhag'                      => 'required',
                    'gardain_gewog'                          => 'required',
                    'gardain_village_id'                     => 'required',
                ];
                $rules = $rules + $additional_rules;

                $additional_message = [
                    'gardain_dzongkhag.required'                      => 'This field is required',
                    'gardain_gewog.required'                          => 'This field is required',
                    'gardain_village_id.required'                     => 'This field is required',
                ];
                $customMessages = $customMessages + $additional_message;
            }
        }

        $this->validate($request, $rules, $customMessages);
        $data =[
            'merital_status'            =>  $request->merital_status,
            'primary_contact'           =>  $request->primary_contact,
            'student_id'                =>  $request->student_id,
            'type'                      =>  $request->type,
            'father_nationality'               =>  $request->father_nationality,
            'father_cid_passport'              =>  $request->father_cid_passport,
            'father_first_name'                =>  $request->father_first_name,
            'father_dzongkhag'                 =>  $request->father_dzongkhag,
            'father_gewog'                     =>  $request->father_gewog,
            'father_village_id'                =>  $request->father_village_id,
            'father_fulladdress'               =>  $request->father_fulladdress,
            'father_present_dzongkhag'         =>  $request->father_present_dzongkhag,
            'father_present_gewog'             =>  $request->father_present_gewog,
            'father_present_village_id'        =>  $request->father_present_village_id,
            'father_work_address'              =>  $request->father_work_address,
            'father_residence_address'         =>  $request->father_residence_address,
            'father_occupation'                =>  $request->father_occupation,
            'father_email'                     =>  $request->father_email,
            'father_cntct_no'                  =>  $request->father_cntct_no,

            'mother_nationality'               =>  $request->mother_nationality,
            'mother_cid_passport'              =>  $request->mother_cid_passport,
            'mother_first_name'                =>  $request->mother_first_name,
            'mother_dzongkhag'                 =>  $request->mother_dzongkhag,
            'mother_gewog'                     =>  $request->mother_gewog,
            'mother_village_id'                =>  $request->mother_village_id,
            'mother_fulladdress'               =>  $request->mother_fulladdress,
            'mother_present_dzongkhag'         =>  $request->mother_present_dzongkhag,
            'mother_present_gewog'             =>  $request->mother_present_gewog,
            'mother_present_village_id'        =>  $request->mother_present_village_id,
            'mother_work_address'              =>  $request->mother_work_address,
            'mother_residence_address'         =>  $request->mother_residence_address,
            'mother_occupation'                =>  $request->mother_occupation,
            'mother_email'                     =>  $request->mother_email,
            'mother_cntct_no'                  =>  $request->mother_cntct_no,

            'gardain_nationality'               =>  $request->gardain_nationality,
            'gardain_cid_passport'              =>  $request->gardain_cid_passport,
            'gardain_first_name'                =>  $request->gardain_first_name,
            'gardain_dzongkhag'                 =>  $request->gardain_dzongkhag,
            'gardain_gewog'                     =>  $request->gardain_gewog,
            'gardain_village_id'                =>  $request->gardain_village_id,
            'gardain_fulladdress'               =>  $request->gardain_fulladdress,
            'gardain_present_dzongkhag'         =>  $request->gardain_present_dzongkhag,
            'gardain_present_gewog'             =>  $request->gardain_present_gewog,
            'gardain_present_village_id'        =>  $request->gardain_present_village_id,
            'gardain_work_address'              =>  $request->gardain_work_address,
            'gardain_residence_address'         =>  $request->gardain_residence_address,
            'gardain_occupation'                =>  $request->gardain_occupation,
            'gardain_email'                     =>  $request->gardain_email,
            'gardain_cntct_no'                  =>  $request->gardain_cntct_no,
            'user_id'                           =>  $this->userId()
        ];
        // dd($data);
        $response_data= $this->apiService->createData('emis/students/admission/saveStudentGardianDetails', $data);
        return $response_data;
    }

    /**
     * Save details of studen when admitting student to school
     */

    public function saveAdmitStudent(Request $request){
        $rules = [
            'class'                             => 'required',
            'student_type'                      => 'required',
            'disability'                        => 'required',
        ];
        $customMessages = [
            'class.required'                    => 'This field is required',
            'student_type.required'             => 'This field is required',
            'disability.required'               => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $request['OrgOrganizationId'] = $this->getWrkingAgencyId();
        $data = $request->all();
        $response_data= json_decode($this->apiService->createData('emis/students/admission/saveAdmitStudent', $data));

        //added by tshewang to update in portal user to student
        if(isset($response_data->FirstName) && $response_data->FirstName!=null){
            $response=$this->apiService->createData('emis/students/admission/updatePortalUser', $response_data);
        }
        return $response_data;
    }

    /**
     * Cross check and delete if not used
     * Was initially written by Tshewang
     */

    public function saveStudentClassDetails(Request $request){
        $rules = [
            'class'                             => 'required',
            'student_type'                      => 'required',
            'no_meals'                          => 'required',
            'disability'                        => 'required',
        ];
        $customMessages = [
            'class.required'                    => 'This field is required',
            'student_type.required'             => 'This field is required',
            'no_meals.required'                 => 'This field is required',
            'disability.required'               => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);
        $data =[
            'student_id'                =>  $request->student_id,
            'type'                      =>  $request->type,
            //org id and dzo id is pulled form the user who is currently loged in. cannot add record other then org user.
            'org_id'                    =>  $this->getWrkingAgencyId(),
            'dzo_id'                    =>  $this->getUserDzoId(),
            'class_stream_id'           =>  $request->class_stream_id,
            'section'                   =>  $request->section,
            'student_type'              =>  $request->student_type,
            'no_meals'                  =>  $request->no_meals,
            'meal_type'                 =>  $request->meal_type,
            'feeding_type'              =>  $request->feeding_type,
            'scholarship'               =>  $request->scholarship,
            'special_benifit'           =>  $request->special_benifit,
            'disability'                =>  $request->disability,
            'user_id'                   =>  $this->userId()
        ];
        // dd($data);
        $response_data= $this->apiService->createData('emis/students/admission/saveStudentClassDetails', $data);
        return $response_data;
    }

    public function loadStudentList($param=""){
        if($param=="session"){
            $param=$this->getAccessLevel().'SSS'.$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        }
        if($param=="admission"){
            $param=$param.'__'.$this->getWrkingAgencyId();
        }
        if($param=="created"){
            $param=$param.'__'.$this->userId();
        }
        $student_list = $this->apiService->listData('emis/students/admission/loadStudentList/'.$param);
        return $student_list;
    }

    /**
     * to load the list of students for admission from the portal
     */

    public function loadStudentAdmissionList(){
        $org_id = $this->getWrkingAgencyId();
        $student_list = $this->apiService->listData('emis/students/admission/loadStudentList/'.$org_id);
        return $student_list;
    }

    /**
     * Update Student Decision by  the school admin
     * the function name used is the same as the one used in portal
    */

    public function deleteclassDetails($id=""){
        $response_data= $this->apiService->listData('emis/students/admission/deleteclassDetails/'.$id);
        return $response_data;
    }

    public function loadStudentListwithsearch(Request $request){
        $rules = [
            'dzongkhag'                 => 'required',
            'org'                       => 'required',
            'class'                     => 'required',
        ];
        $customMessages = [
            'dzongkhag.required'                => 'Please select dzongkhag',
            'org.required'                      => 'Please select school',
            'class.required'                    => 'Please select class',
        ];
        $this->validate($request, $rules, $customMessages);
        $section="";
        $clas="";
        if($request->section!=""){
            $section=$request->section;
        }
        if($request->stream!=""){
            $clas=$request->stream;
        }
        else{
            $clas=$request->class;
        }
        $data =[
            'dzongkhag'             =>  $request->dzongkhag,
            'org'                   =>  $request->org,
            'class'                 =>  $clas,
            'section'               =>  $section,
        ];
        $query = http_build_query($data);
        $student_list = $this->apiService->listData('emis/students/admission/loadStudentList/'.$query);
        return $student_list;
    }

    /**
     * Saving the Details of the transfer students
     *
     * The WEB BFF Route used is the same used by the portal
     */

    public function saveNewTransferStudent(Request $request){
        $rules = [
            'student_id'                 => 'required',
            'class'                      => 'required',

        ];
        $customMessages = [
            'student_id.required'         => 'This field is required',
            'class.required'              => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $request['user_id']=$this->userId();
        $request['school']=$this->getWrkingAgencyId();
        $request['dzongkhag']=$this->getUserDzoId();
        $request['dateOfapply']=date('Y-m-d');

        $data = $request->all();

        $response_data= $this->apiService->createData('emis/students/admission/saveorgclassDetails', $data);
        return $response_data;
    }

    /**
     * Validate the CID of a student to ensure that duplicate CID is not being entered
     */

    public function getstudentdetailsbyCid($cid){
        $response = $this->apiService->listData('emis/students/admission/getstudentdetailsbyCid/'.$cid);
        return $response;
    }

    public function getStudentDetails($std_id=""){
        $student_list = $this->apiService->listData('emis/students/admission/getStudentDetails/'.$std_id);
        return $student_list;
    }

    public function getTransferDetails($std_id=""){
        $student_list = $this->apiService->listData('emis/students/admission/getTransferDetails/'.$std_id);
        return $student_list;
    }

    public function getstudentGuardainClassDetails($std_id="",$type=""){
        $student_list = $this->apiService->listData('emis/students/admission/getstudentGuardainClassDetails/'.$std_id.'/'.$type);
        return $student_list;
    }

    public function savedetailsEnrolledStd(Request $request){
        $rules = [
            'class'                             => 'required',
            'student_type'                      => 'required',
            'no_meals'                          => 'required',
            'disability'                        => 'required',
        ];
        $customMessages = [
            'class.required'                    => 'This field is required',
            'student_type.required'             => 'This field is required',
            'no_meals.required'                 => 'This field is required',
            'disability.required'               => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);
        $data =[
            'student_id'                =>  $request->student_id,
            'type'                      =>  $request->type,
            //org id and dzo id is pulled form the user who is currently loged in. cannot add record other then org user.
            'org_id'                    =>  $this->getWrkingAgencyId(),
            'dzo_id'                    =>  $this->getUserDzoId(),
            'class_stream_id'           =>  $request->class_stream_id,
            'section'                   =>  $request->section,
            'student_type'              =>  $request->student_type,
            'no_meals'                  =>  $request->no_meals,
            'meal_type'                 =>  $request->meal_type,
            'feeding_type'              =>  $request->feeding_type,
            'scholarship'               =>  $request->scholarship,
            'special_benifit'           =>  $request->special_benifit,
            'disability'                =>  $request->disability,
            'user_id'                   =>  $this->userId()
        ];
        // dd($data);
        $response_data= $this->apiService->createData('emis/students/admission/saveStudentClassDetails', $data);
        return $response_data;
    }

    public function studentAdmissionupdate(Request $request){
        $data =[
            'status'                    =>  $request->status,
            'id'                        =>  $request->id,
            'type'                      =>  $request->type,
            'action_type'               =>  $request->action_type,
            'remarks'                   =>  $request->remarks,
            'org_id'                    =>  $this->getWrkingAgencyId(),
            'dzo_id'                    =>  $this->getUserDzoId(),
            'user_id'                   =>  $this->userId()
        ];
        // dd($data);
        $response_data= $this->apiService->createData('emis/students/admission/studentAdmissionupdate', $data);
        return $response_data;
    }

    /**
     * Admit New Student
     */

    public function updateStudentAdmission(Request $request){
        $data =[
            'id'                        =>  $request->id,
            'actionType'                =>  $request->actionType,
            'org_id'                    =>  $this->getWrkingAgencyId(),
            'dzo_id'                    =>  $this->getUserDzoId(),
            'user_id'                   =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/students/admission/updateStudentAdmission', $data);
        return $response_data;
    }

    /**
     * Admit Transfer Student
     */

    public function updateStudentTransfer(Request $request){
        $data =[
            'id'                        =>  $request->id,
            'org_id'                    =>  $this->getWrkingAgencyId(),
            'dzo_id'                    =>  $this->getUserDzoId(),
            'user_id'                   =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/students/admission/updateStudentTransfer', $data);
        return $response_data;
    }

    /**
     * Supplementary Student
     */

    public function saveSupplementaryStudent(Request $request){
        $rules = [
            'student_id'                 => 'required',
            'retakeCA'                      => 'required',

        ];
        $customMessages = [
            'student_id.required'         => 'This field is required',
            'retakeCA.required'              => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $data = $request->all();

        $response_data= $this->apiService->createData('emis/students/admission/saveSupplementaryStudent', $data);
        return $response_data;
    }


}
