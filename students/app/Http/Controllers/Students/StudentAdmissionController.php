<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\StudentPersonalDetails;
use App\Models\Students\StudentGuardainDetails;
use App\Models\Students\StudentClassDetails;

class StudentAdmissionController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveStudentDetails(Request $request){
        $rules = [
            'snationality'              => 'required',
            'cid_passport'              => 'required',
            'first_name'                => 'required',
            'dob'                       => 'required',
            'sex_id'                    => 'required',
            'mother_tongue'             => 'required',
            
        ];
        $customMessages = [
            'snationality.required'             => 'This field is required',
            'cid_passport.required'             => 'This field is required',
            'first_name.required'               => 'This field is required',
            'dob.required'                      => 'This field is required',
            'sex_id.required'                   => 'This field is required',
            'mother_tongue.required'            => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        if( $request->type=="edit"){
            //caling procedure to insert in audit
            $procid=DB::select("CALL emis_std_detils_audit_proc('".$request->student_id."','".$request->user_id."','personal')");
            $data =[
                'snationality'              =>  $request->snationality,
                'cid_passport'              =>  $request->cid_passport,
                'first_name'                =>  $request->first_name,
                'middle_name'               =>  $request->middle_name,
                'last_name'                 =>  $request->last_name,
                'dob'                       =>  $request->dob,
                'sex_id'                    =>  $request->sex_id,
                'village_id'                =>  $request->village_id, 
                'address'                   =>  $request->fulladdress,
                'mother_tongue'             =>  $request->mother_tongue, 
                'attachments'               =>  $request->attachments, 
            ];
            $response_data = StudentPersonalDetails::where('id',$request->student_id)->update($data);
        } 
        else{
            $data = StudentPersonalDetails::where('cid_passport',$request->cid_passport)->where('status','pending')->where('created_by',$request->user_id)->first();
            if($data==""){
                $data =[
                    'snationality'              =>  $request->snationality,
                    'cid_passport'              =>  $request->cid_passport,
                    'first_name'                =>  $request->first_name,
                    'middle_name'               =>  $request->middle_name,
                    'last_name'                 =>  $request->last_name,
                    'dob'                       =>  $request->dob,
                    'sex_id'                    =>  $request->sex_id,
                    'village_id'                =>  $request->village_id, 
                    'village_id'                =>  $request->village_id, 
                    'address'                   =>  $request->fulladdress,
                    'mother_tongue'             =>  $request->mother_tongue, 
                    'attachments'               =>  $request->attachments, 
                    'created_by'                =>  $request->user_id,
                    'created_at'                =>  date('Y-m-d h:i:s'),
                ];
                $response_data = StudentPersonalDetails::create($data);
            }
            else{
                $data =[
                    'snationality'              =>  $request->snationality,
                    'cid_passport'              =>  $request->cid_passport,
                    'first_name'                =>  $request->first_name,
                    'middle_name'               =>  $request->middle_name,
                    'last_name'                 =>  $request->last_name,
                    'dob'                       =>  $request->dob,
                    'sex_id'                    =>  $request->sex_id,
                    'village_id'                =>  $request->village_id, 
                    'address'                   =>  $request->fulladdress,
                    'mother_tongue'             =>  $request->mother_tongue, 
                    'attachments'               =>  $request->attachments, 
                ];
                $updated_data = StudentPersonalDetails::where('cid_passport',$request->cid_passport)->update($data);
                $response_data = StudentPersonalDetails::where('cid_passport',$request->cid_passport)->where('status','pending')->where('created_by',$request->user_id)->first();
            }
        }
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
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
                'father_fulladdress'                    => 'required',
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
                'father_fulladdress.required'                    => 'This field is required',
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
        // $update_data = StudentPersonalDetails::where('id',$request->student_id)->where('status','pending')->where('created_by',$request->user_id)->first();
        $update_data =[
            'parent_marital_status'     =>  $request->merital_status,
            'primary_contact'           =>  $request->primary_contact,
        ];
        if( $request->type=="edit"){
            
            $procid=DB::select("CALL emis_std_detils_audit_proc('".$request->student_id."','".$request->user_id."','guardain')");
        }
        $updated_data = StudentPersonalDetails::where('id',$request->student_id)->update($update_data);
        $data = StudentGuardainDetails::where('student_id',$request->student_id)->delete();
        if($request->father_cid_passport!="" && $request->father_cid_passport!=null){
            $data =[                
                'student_id'                =>  $request->student_id,
                'contact_type'              =>  'Father',
                'nationality'               =>  $request->father_nationality,
                'cid_passport'              =>  $request->father_cid_passport,
                'name'                      =>  $request->father_first_name,
                'village_id'                =>  $request->father_village_id,
                'address'                   =>  $request->father_fulladdress,
                'present_village_id'        =>  $request->father_present_village_id,
                'work_address'              =>  $request->father_work_address,
                'residence_address'         =>  $request->father_residence_address,
                'occupation'                =>  $request->father_occupation,
                'email'                     =>  $request->father_email,
                'cntct_no'                  =>  $request->father_cntct_no,
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s'),
            ];
            $response_data = StudentGuardainDetails::create($data);
        }
        if($request->mother_cid_passport!="" && $request->mother_cid_passport!=null){
            $data =[                
                'student_id'                =>  $request->student_id,
                'contact_type'              =>  'Mother',
                'nationality'               =>  $request->mother_nationality,
                'cid_passport'              =>  $request->mother_cid_passport,
                'name'                      =>  $request->mother_first_name,
                'village_id'                =>  $request->mother_village_id,
                'address'                   =>  $request->mother_fulladdress,
                'present_village_id'        =>  $request->mother_present_village_id,
                'work_address'              =>  $request->mother_work_address,
                'residence_address'         =>  $request->mother_residence_address,
                'occupation'                =>  $request->mother_occupation,
                'email'                     =>  $request->mother_email,
                'cntct_no'                  =>  $request->mother_cntct_no,
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s'),
            ];
            $response_data = StudentGuardainDetails::create($data);
        }
        if($request->gardain_cid_passport!="" && $request->gardain_cid_passport!=null){
            $data =[                
                'student_id'                =>  $request->student_id,
                'contact_type'              =>  'Guardian',
                'nationality'               =>  $request->gardain_nationality,
                'cid_passport'              =>  $request->gardain_cid_passport,
                'name'                      =>  $request->gardain_first_name,
                'village_id'                =>  $request->gardain_village_id,
                'address'                   =>  $request->gardain_fulladdress,
                'present_village_id'        =>  $request->gardain_present_village_id,
                'work_address'              =>  $request->gardain_work_address,
                'residence_address'         =>  $request->gardain_residence_address,
                'occupation'                =>  $request->gardain_occupation,
                'email'                     =>  $request->gardain_email,
                'cntct_no'                  =>  $request->gardain_cntct_no,
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s'),
            ];
            $response_data = StudentGuardainDetails::create($data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function saveStudentClassDetails(Request $request){
        $rules = [
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
        if( $request->type=="edit"){
            $procid=DB::select("CALL emis_std_detils_audit_proc('".$request->student_id."','".$request->user_id."','classes')");
            $data = StudentClassDetails::where('student_id',$request->student_id)->delete();
        }
        $scholar="";
        $special_benifit="";
        if($request->scholarship!=null && !sizeof($request->scholarship)>0){
            foreach($request->scholarship as $scho){
                $scholar.=$scho.', ';
            }
        }
        
        if($request->special_benifit!=null && !sizeof($request->special_benifit)>0){
            foreach($request->special_benifit as $bn){
                $special_benifit.=$bn.', ';
            }
        }
        
        $data =[
            'student_id'                =>  $request->student_id,
            'dzo_id'                    =>  $request->dzo_id,
            'org_id'                    =>  $request->org_id,
            'class_stream_id'           =>  $request->class_stream_id,
            'section'                   =>  $request->section,
            'student_type'              =>  $request->student_type,
            'no_meals'                  =>  $request->no_meals,
            'scholarship'               =>  $scholar,
            'special_benifit'           =>  $special_benifit,
            'disability'                =>  $request->disability,
            'user_id'                   =>  $request->user_id,
        ];
        $response_data = StudentClassDetails::create($data);
        $update_data =[
            'status'     =>  'created',
        ];
        $updated_data = StudentPersonalDetails::where('id',$request->student_id)->update($update_data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadStudentList($param=""){
        if(strpos($param,'SSS')){
            $access_level=explode('SSS',$param)[0];
            if($access_level=="Ministry"){
                $response_data=StudentPersonalDetails::all();
            }
            if($access_level=="Dzongkhag"){
                $response_data = DB::table('std_class_detils as c')
                ->join('std_personal_detils as p', 'p.id', '=', 'c.student_id')
                ->select('p.id','p.snationality', 'p.cid_passport','p.first_name',
                'p.middle_name','p.last_name','p.dob','p.sex_id','p.village_id','p.address',
                'p.mother_tongue','p.attachments','p.parent_marital_status','p.primary_contact', 'p.status','p.created_by','p.created_at','p.updated_by', 'p.updated_at'
                )->where('c.dzo_id', explode('SSS',$param)[1])->get();
            }
            if($access_level=="Org"){
                $response_data = DB::table('std_class_detils as c')
                ->join('std_personal_detils as p', 'p.id', '=', 'c.student_id')
                ->select('p.id','p.snationality', 'p.cid_passport','p.first_name',
                'p.middle_name','p.last_name','p.dob','p.sex_id','p.village_id','p.address',
                'p.mother_tongue','p.attachments','p.parent_marital_status','p.primary_contact', 'p.status','p.created_by','p.created_at','c.updated_by', 'c.updated_at'
                )->where('c.org_id', explode('SSS',$param)[2])->get();
            }
        }
        else{
            parse_str($param,$output); //revert query string to array and stored to $output
            $response_data = DB::table('std_class_detils as c')
                ->join('std_personal_detils as p', 'p.id', '=', 'c.student_id')
                ->select('p.id','p.snationality', 'p.cid_passport','p.first_name',
                'p.middle_name','p.last_name','p.dob','p.sex_id','p.village_id','p.address',
                'p.mother_tongue','p.attachments','p.parent_marital_status','p.primary_contact', 'p.status','p.created_by','p.created_at','p.updated_by', 'p.updated_at'
                );
            if($output['section']!=""){
                $response_data=$response_data->where('c.section', $output['section'])->get();
            }
            else if($output['class']!=""){
                $response_data=$response_data->where('c.class_stream_id', $output['class'])->get();
            }
            else{
                $response_data=$response_data->where('c.org_id', $output['org'])->get();
            }
        }
        return $this->successResponse($response_data);
    }
    
    public function getStudentDetails($std_id=""){
        $response_data=StudentPersonalDetails::where('id',$std_id)->first();
        return $this->successResponse($response_data);
    }
    public function getstudentGuardainClassDetails($std_id="",$type=""){
        if($type=="guardian"){
            $response_data=StudentGuardainDetails::where('student_id',$std_id)->get();
        }  
        if($type=="class"){
            $response_data=StudentClassDetails::where('student_id',$std_id)->first();
        }  
        return $this->successResponse($response_data);
    }
    
}
