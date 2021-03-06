<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helper\EmisService;
use App\Traits\AuthUser;
use Illuminate\Http\Response;

class NotenrolledController extends Controller
{
    public $apiService;
    use AuthUser;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    
    // public $database="student_db";
    public function getStudentDetailsFromPortal($id=""){
        $response_data= $this->apiService->listData('emis/students/admission/getstudentadmissiondetails/'.$this->userId());
        return $response_data;
    }

    public function saveStudentDetailsFromPortal(Request $request){
        // dd($request);
        $rules = [
            'snationality'                    => 'required',
            'cid_passport'                    => 'required',
            'first_name'                      => 'required',
            'dob'                             => 'required',
            'sex_id'                          => 'required',

        ];
        $customMessages = [
            'snationality.required'            => 'This field is required',
            'cid_passport.required'            => 'This field is required',
            'first_name.required'              => 'This field is required',
            'dob.required'                     => 'This field is required',
            'sex_id.required'                  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $file = $request->attachments;
        $path="";
        $file_store_path=config('services.constant.file_stored_base_path').'studentPhotoes';
        if($file!=null && $file!="" && $file!="undefined"){
            if(!is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            $file_name = $this->userId().'_' .$file->getClientOriginalName();
            if (!file_exists($file_store_path.'/'.$file_name)){
                move_uploaded_file($file,$file_store_path.'/'.$file_name);
            }
            $path=$file_store_path.'/'.$file_name;
        }
        $request['user_id']=$this->userId();
        $request['file_path']= $path;
        $data = $request->all();
        // dd($data);
        $response_data= $this->apiService->createData('emis/students/admission/saveStudentDetailsFromPortal', $data);
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
        $response_data= $this->apiService->createData('emis/students/admission/saveStudentGardianDetails', $data);
        return $response_data;
    }


    public function getstudentdetails($std_id=""){
        $response_data= $this->apiService->listData('emis/students/admission/getStudentDetails/'.$std_id);
        return $response_data;
    }


    public function getstudentdetailsbyCid($cid=""){
        $response_data= $this->apiService->listData('emis/students/admission/getstudentdetailsbyCid/'.$cid);
        return $response_data;
    }

    public function loadSchoolList($dzoId="",$type=""){
        $response_data= $this->apiService->getListData('emis/common_services/loadOrgList/admission_dzongkhagwise__'.$type.'/'.$dzoId);
        return $response_data;
    }

    public function loadProjection($classId=""){
        $response_data= $this->apiService->getListData('emis/common_services/loadProjection/'.$classId);
        return $response_data;
    }

    public function getAllStudentCid(){
        // dd("dsdsad");
        $response_data= $this->apiService->listData('emis/students/admission/getAllStudentCid/');
        return $response_data;
    }

    public function saveorgclassDetails(Request $request){
        $rules = [
            'dzongkhag'                    => 'required',
            'school'                    => 'required',
            'class'                      => 'required',

        ];
        $customMessages = [
            'dzongkhag.required'            => 'This field is required',
            'school.required'            => 'This field is required',
            'class.required'              => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id']=$this->userId();
        $data = $request->all();
        $response_data= $this->apiService->createData('emis/students/admission/saveorgclassDetails', $data);
        return $response_data;
    }

    public function savefilanorgclassDetails(Request $request){
        $request['user_id']=$this->userId();
        $data = $request->all();
        $response_data= $this->apiService->createData('emis/students/admission/savefilanorgclassDetails', $data);
        return $response_data;
    }

    public function getorgclassDetails($id=""){
        $response_data= $this->apiService->listData('emis/students/admission/getorgclassDetails/'.$id);
        return $response_data;
    }

    public function deleteclassDetails($id=""){
        $response_data= $this->apiService->listData('emis/students/admission/deleteclassDetails/'.$id);
        return $response_data;
    }
}
