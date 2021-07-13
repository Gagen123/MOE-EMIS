<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\StudentPersonalDetails;
use App\Models\Students\Std_Students;
use App\Models\std_admission_org;
use App\Models\std_admission;
use App\Models\requestForAdmission;
use App\Models\Students\StudentGuardainDetails;
use App\Models\Students\StudentClassDetails;
use App\Models\Students\ApplicationSequence;
use App\Models\Students\StudentAboard;
use Exception;

class StudentAdmissionController extends Controller
{
    use ApiResponser;
    public $database="student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     *  In the save student details, Std_Student model was used by Tshewang
     *  std_admissions replaces Std_Student model to insert in Admissions table
     */

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
        if($request->type=="edit"){
            //caling procedure to insert in audit
            //$procid=DB::select("CALL emis_std_detils_audit_proc('".$request->student_id."','".$request->user_id."','personal')");
            $data =[
                'OrgOrganizationId'         =>  $request->OrgOrganizationId,
                'CmnCountryId'              =>  $request->snationality,
                'CidNo'                     =>  $request->cid_passport,
                'first_name'                =>  $request->first_name,
                'middle_name'               =>  $request->middle_name,
                'last_name'                 =>  $request->last_name,
                'DateOfBirth'               =>  $request->dob,
                'CmnSexId'                  =>  $request->sex_id,
                'CmnChiwogId'               =>  $request->village_id,
                'CmnGewogId'                =>  $request->gewog,
                'class_id'                  =>  $request->std_class,
                'IsNewAdmission'            =>  1,
                'Address'                   =>  $request->fulladdress,
                'CmnLanguageId'             =>  $request->mother_tongue,
                'PhotoPath'                 =>  $request->attachments,
                'Status'                    =>  $request->status,
            ];
            $response_data = std_admission::where('id',$request->student_id)->update($data);
        }
        else if($request->type=="update_transfer"){
            //keep history
            $data =[
                'OrgOrganizationId'         =>  $request->OrgOrganizationId,
                'CmnCountryId'              =>  $request->snationality,
                'CidNo'                     =>  $request->cid_passport,
                'first_name'                =>  $request->first_name,
                'middle_name'               =>  $request->middle_name,
                'last_name'                 =>  $request->last_name,
                'DateOfBirth'               =>  $request->dob,
                'CmnSexId'                  =>  $request->sex_id,
                'CmnChiwogId'               =>  $request->village_id,
                'CmnGewogId'                =>  $request->gewog,
                'class_id'                  =>  $request->std_class,
                'IsNewAdmission'            =>  1,
                'Address'                   =>  $request->fulladdress,
                'CmnLanguageId'             =>  $request->mother_tongue,
                'PhotoPath'                 =>  $request->attachments,
                'Status'                    =>  $request->status,
            ];
            $updated_data = std_admission::where('id',$request->student_id)->update($data);
            $response_data = std_admission::where('id',$request->student_id)->first();
        }
        else{
            $data = std_admission::where('CidNo',$request->cid_passport)->where('status','pending')->where('created_by',$request->user_id)->first();
            // dd($data);
            if($data=="" || $data==NULL){
                $data =[
                    'OrgOrganizationId'         =>  $request->OrgOrganizationId,
                    'CmnCountryId'              =>  $request->snationality,
                    'CidNo'                     =>  $request->cid_passport,
                    'first_name'                =>  $request->first_name,
                    'middle_name'               =>  $request->middle_name,
                    'last_name'                 =>  $request->last_name,
                    'DateOfBirth'               =>  $request->dob,
                    'CmnSexId'                  =>  $request->sex_id,
                    'CmnChiwogId'               =>  $request->village_id,
                    'CmnGewogId'                =>  $request->gewog,
                    'class_id'                  =>  $request->std_class,
                    'IsNewAdmission'            =>  1,
                    'Address'                   =>  $request->fulladdress,
                    'CmnLanguageId'             =>  $request->mother_tongue,
                    'PhotoPath'                 =>  $request->attachments,
                    'Status'                    =>  $request->status,
                    'created_by'                =>  $request->user_id,
                    'created_at'                =>  date('Y-m-d h:i:s'),
                    'dateOfapply'               =>  date('Y-m-d'),
                ];
                $response_data = std_admission::create($data);
            }
            else{
                $data =[
                    'OrgOrganizationId'         =>  $request->OrgOrganizationId,
                    'CmnCountryId'              =>  $request->snationality,
                    'CidNo'                     =>  $request->cid_passport,
                    'first_name'                =>  $request->first_name,
                    'middle_name'               =>  $request->middle_name,
                    'last_name'                 =>  $request->last_name,
                    'DateOfBirth'               =>  $request->dob,
                    'CmnSexId'                  =>  $request->sex_id,
                    'CmnChiwogId'               =>  $request->village_id,
                    'CmnGewogId'                =>  $request->gewog,
                    'class_id'                  =>  $request->std_class,
                    'IsNewAdmission'            =>  1,
                    'Address'                   =>  $request->fulladdress,
                    'CmnLanguageId'             =>  $request->mother_tongue,
                    'PhotoPath'                 =>  $request->attachments,
                    'Status'                    =>  $request->status,
                ];

                $updated_data = std_admission::where('CidNo',$request->cid_passport)->update($data);
                $response_data = std_admission::where('CidNo',$request->cid_passport)->where('status','pending')->where('created_by',$request->user_id)->first();
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    //function for student portal to saved student details
    public function saveStudentDetailsFromPortal(Request $request){
        $rules = [
            'snationality'              => 'required',
            'cid_passport'              => 'required',
            'first_name'                => 'required',
            'dob'                       => 'required',
            'sex_id'                    => 'required',

        ];
        $customMessages = [
            'snationality.required'             => 'This field is required',
            'cid_passport.required'             => 'This field is required',
            'first_name.required'               => 'This field is required',
            'dob.required'                      => 'This field is required',
            'sex_id.required'                   => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'application_id'            =>  $request->application_id,
            'snationality'              =>  $request->snationality,
            'student_id'                =>  $request->student_id,
            'CidNo'                     =>  $request->cid_passport,
            'first_name'                =>  $request->first_name,
            'middle_name'               =>  $request->middle_name,
            'last_name'                 =>  $request->last_name,
            'DateOfBirth'               =>  $request->dob,
            'CmnSexId'                  =>  $request->sex_id,
            'dzongkhag'                 =>  $request->dzongkhag,
            'CmnGewogId'                =>  $request->gewog,
            'village_id'                =>  $request->village_id,
            // 'village_id'                =>  $request->s_dzongkhag,
            'OrgOrganizationId'         =>  $request->s_school,
            'class_id'                  =>  $request->s_class,
            'address'                   =>  $request->fulladdress,
            'attachments'               =>  $request->attachments,
            'student_type'              =>  $request->type,
            'Status'                    =>  $request->Status,
            'dateOfapply'               =>  date('Y-m-d'),
            'IsNewAdmission'            =>  1,

        ];
        $response_data = std_admission::create($data);

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
        $update_data =[
            'CmnParentsMaritalStatusId'     =>  $request->merital_status,
            'PrimaryContact'           =>  $request->primary_contact,
        ];

        // $updated_data = Std_Students::where('id',$request->student_id)->update($update_data);
        //
        // Ask Tshewang why the delete before inserting
        //$data = StudentGuardainDetails::where('student_id',$request->student_id)->delete();
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
            $std_admission =[
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
            $response_data = StudentGuardainDetails::create($std_admission);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    //this funtion used for student portal for saving details of enrolled students
    public function  savedetailsEnrolledStd(Request $request){
        $rules = [
            'dateOfapply'               => 'required',
        ];
        $customMessages = [
            'dateOfapply.required'        => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
                $data =[
                        'snationality'                   => $request->snationality,
                        'OrgOrganizationId'              =>  $request->OrgOrganizationId,
                        'CidNo'                          =>  $request->cid_passport,
                        'CmnSexId'                       =>  $request->gender,
                        'first_name'                     =>  $request->Name,
                        'student_type'                   =>  $request->student_type,
                        'dzongkhag'                      =>  $request->dzongkhag,
                        // 'school'                         =>  $request->school,
                        'class_id'                       =>  $request->class,
                        'stream_id'                      =>  $request->stream,
                        'dateOfapply'                    =>  $request->dateOfapply,
                        'Remarks'                        =>  $request->remarks,
                        'Status'                         =>  $request->status,
                ];
            $std_admin_data = std_admission::create($data);
            $std_data=[
                'std_admission_id'               => $std_admin_data->id,
                'OrgOrganizationId'              =>  $request->OrgOrganizationId,
                'dateOfapply'                    =>  $request->date_of_application,
                'Status'                         =>  $request->status,
                'Remarks'                        =>  $request->remarks,
                'std_decission'                  =>  $request->std_decission,
            ];
            $response_data2 = std_admission_org::create($std_data);
            return $this->successResponse($response_data2, Response::HTTP_CREATED);
        }

    public function acceptApplication(Request $request){
            $id=$request->id;
            $update_data=[
                'Student_Decision' =>$request->type,
                'Status'           =>  $request->type,
            ];
            $response_data=std_admission::where('id',$id)->update($update_data);
            return $response_data;
        }

    public function  savedetailsNotEnrolledStd(Request $request){
        $rules = [
            'dateOfapply'               => 'required',
        ];
        $customMessages = [
            'dateOfapply.required'        => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);
            $data =[
                'OrgOrganizationId'          =>  $request->OrgOrganizationId,
                'cid_passport'               =>  $request->cid_passport,
                'gender'                     =>  $request->gender,
                'Name'                       =>  $request->Name,
                'student_type'               =>  $request->student_type,
                'dzongkhag'                  =>  $request->dzongkhag,
                'school'                     =>  $request->school,
                'class'                      =>  $request->class,
                'stream'                     =>  $request->stream,
                'dateOfapply'                =>  $request->dateOfapply,
                'remarks'                    =>  $request->remarks,
            ];
            $response_data = std_admission::create($data);
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
        $scholar="";
        $special_benifit="";
        // if($request->scholarship!=null && !sizeof($request->scholarship)>0){
        //     foreach($request->scholarship as $scho){
        //         $scholar.=$scho.', ';
        //     }
        // }

        // if($request->special_benifit!=null && !sizeof($request->special_benifit)>0){
        //     foreach($request->special_benifit as $bn){
        //         $special_benifit.=$bn.', ';
        //     }
        // }
        if( $request->type=="edit"){
            $data =[
                'Dzo_Id'                    =>  $request->dzo_id,
                'Org_Id'                    =>  $request->org_id,
                'OrgClassId'                =>  $request->class_stream_id,
                'OrgClassSectionId'         =>  $request->section,
                'StdStudentTypeId'          =>  $request->student_type,
                'NoOfMeals'                 =>  $request->no_meals,
                'IsSenStudent'              =>  $request->disability,
                'Meal_Type'                 =>  $request->meal_type,
                'Feeding_Type'              =>  $request->feeding_type,
                'scholarship'               =>  $scholar,
                'special_benifit'           =>  $special_benifit,
                'updated_by'                =>  $request->user_id,
                'updated_at'                =>  date('Y-m-d h:i:s'),
            ];
            $response_data = StudentClassDetails::where('StdStudentId',$request->student_id,)->update($data);
        }
        else if($request->type=="transfer_update"){
            $data =[
                'Dzo_Id'                    =>  $request->dzo_id,
                'Org_Id'                    =>  $request->org_id,
                'OrgClassId'                =>  $request->class_stream_id,
                'OrgClassSectionId'         =>  $request->section,
                'StdStudentTypeId'          =>  $request->student_type,
                'NoOfMeals'                 =>  $request->no_meals,
                'IsSenStudent'              =>  $request->disability,
                'Meal_Type'                 =>  $request->meal_type,
                'Feeding_Type'              =>  $request->feeding_type,
                'scholarship'               =>  $scholar,
                'special_benifit'           =>  $special_benifit,
                'updated_by'                =>  $request->user_id,
                'updated_at'                =>  date('Y-m-d h:i:s'),
            ];
            $response_data = StudentClassDetails::where('StdStudentId',$request->student_id,)->update($data);

            $data =[
                'IsTransferred'                    =>  0,
                'IsRejoined'                       =>  1,
            ];
            $response_data = Std_Students::where('id',$request->student_id,)->update($data);
        }
        else{
            $last_seq=ApplicationSequence::where('service_name','Student Admission')->first();
            if($last_seq==null || $last_seq==""){
                $last_seq=1;
                $app_details = [
                    'service_name'                  =>  'Student Admission',
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::create($app_details);
            }
            else{
                $last_seq=$last_seq->last_sequence+1;
                $app_details = [
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::where('service_name', 'Student Admission')->update($app_details);
            }
            $appNo='201.00005.11.';
            if(strlen($last_seq)==1){
                $appNo= $appNo.'000000'.$last_seq;
            }
            else if(strlen($last_seq)==2){
                $appNo= $appNo.'00000'.$last_seq;
            }
            else if(strlen($last_seq)==3){
                $appNo= $appNo.'0000'.$last_seq;
            }
            else if(strlen($last_seq)==4){
                $appNo= $appNo.'000'.$last_seq;
            }
            else if(strlen($last_seq)==5){
                $appNo= $appNo.'00'.$last_seq;
            }
            else if(strlen($last_seq)==6){
                $appNo= $appNo.'0'.$last_seq;
            }
            else if(strlen($last_seq)==7){
                $appNo= $appNo.$last_seq;
            }
            $data =[
                'StdStudentId'              =>  $request->student_id,
                'StudentCode'               =>$appNo,
                'Dzo_Id'                    =>  $request->dzo_id,
                'Org_Id'                    =>  $request->org_id,
                'OrgClassId'                =>  $request->class_stream_id,
                'OrgClassSectionId'                   =>  $request->section,
                'StdStudentTypeId'              =>  $request->student_type,
                'NoOfMeals'                  =>  $request->no_meals,
                'IsSenStudent'                =>  $request->disability,
                'Meal_Type'                 =>  $request->meal_type,
                'Feeding_Type'              =>  $request->feeding_type,
                'scholarship'               =>  $scholar,
                'special_benifit'           =>  $special_benifit,
                'created_by'                   =>  $request->user_id,
            ];
            $response_data = StudentClassDetails::create($data);
        }
        // $update_data =[
        //     'student_code'=>$appNo,
        //     'status'     =>  'created',
        // ];
        // $updated_data = StudentPersonalDetails::where('id',$request->student_id)->update($update_data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function studentAdmissionupdate(Request $request){
        $data =[
            'Remarks'                   =>  $request->remarks,
            'School_decision'           =>  $request->status,
            'Status'                    =>  $request->status,
            'updated_by'                =>  $request->user_id,
            'updated_at'                =>  date('Y-m-d h:i:s'),
        ];
        $response_data = std_admission::where('id',$request->id,)->update($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }


    public function updateAdmissionStd(Request $request){
        $data =[
            'Dzo_Id'                    =>  $request->dzo_id,
            'Org_Id'                    =>  $request->org_id,
            'OrgClassId'                =>  $request->class_stream_id,
            'OrgClassSectionId'         =>  $request->section,
            'StdStudentTypeId'          =>  $request->student_type,
            'NoOfMeals'                 =>  $request->no_meals,
            'IsSenStudent'              =>  $request->disability,
            'Meal_Type'                 =>  $request->meal_type,
            'Feeding_Type'              =>  $request->feeding_type,
            'updated_by'                =>  $request->user_id,
            'updated_at'                =>  date('Y-m-d h:i:s'),
        ];
        $response_data = StudentClassDetails::where('StdStudentId',$request->student_id,)->update($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
        // $last_seq=ApplicationSequence::where('service_name','Student Admission')->first();
        //     if($last_seq==null || $last_seq==""){
        //         $last_seq=1;
        //         $app_details = [
        //             'service_name'                  =>  'Student Admission',
        //             'last_sequence'                 =>  $last_seq,
        //         ];
        //         ApplicationSequence::create($app_details);
        //     }
        //     else{
        //         $last_seq=$last_seq->last_sequence+1;
        //         $app_details = [
        //             'last_sequence'                 =>  $last_seq,
        //         ];
        //         ApplicationSequence::where('service_name', 'Student Admission')->update($app_details);
        //     }
        //     $appNo='201.00005.11.';
        //     if(strlen($last_seq)==1){
        //         $appNo= $appNo.'000000'.$last_seq;
        //     }
        //     else if(strlen($last_seq)==2){
        //         $appNo= $appNo.'00000'.$last_seq;
        //     }
        //     else if(strlen($last_seq)==3){
        //         $appNo= $appNo.'0000'.$last_seq;
        //     }
        //     else if(strlen($last_seq)==4){
        //         $appNo= $appNo.'000'.$last_seq;
        //     }
        //     else if(strlen($last_seq)==5){
        //         $appNo= $appNo.'00'.$last_seq;
        //     }
        //     else if(strlen($last_seq)==6){
        //         $appNo= $appNo.'0'.$last_seq;
        //     }
        //     else if(strlen($last_seq)==7){
        //         $appNo= $appNo.$last_seq;
        //     }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadStudentList($param=""){
        if(strpos($param,'SSS')){
            $access_level=explode('SSS',$param)[0];
            if($access_level=="Ministry"){
                $response_data=Std_Students::where('IsNewAdmission',1)->get();
            }
            if($access_level=="Dzongkhag"){
                $response_data = DB::table('std_student as p')
                ->select('p.id','p.CmnCountryId', 'p.CidNo','p.Name','p.Address',
                'p.DateOfBirth','p.CmnSexId','p.CmnChiwogId','p.CmnLanguageId',
                'p.PhotoPath','p.CmnParentsMaritalStatusId','p.PrimaryContact',
                 'p.Status','p.created_by','p.created_at','p.updated_by', 'p.updated_at'
                )->where('p.OrgOrganizationId', explode('SSS',$param)[1])->get();
            }
            if($access_level=="Org"){
                $response_data = DB::table('std_student as p')
                ->select('p.id','p.CmnCountryId', 'p.CidNo','p.Name','p.Address',
                'p.DateOfBirth','p.CmnSexId','p.CmnChiwogId','p.CmnLanguageId',
                'p.PhotoPath','p.CmnParentsMaritalStatusId','p.PrimaryContact',
                 'p.Status','p.created_by','p.created_at','p.updated_by', 'p.updated_at'
                )->where('p.OrgOrganizationId', explode('SSS',$param)[2])->get();
            }
        }
        else if($param=="transfered"){
            $response_data=Std_Students::where('IsTransferred',1)->get();
        }

        else if(strpos($param,'__')){
            if(explode('__',$param)[0] == "admission"){
                dd(explode('__',$param)[1]);
                $response_data = DB::table('std_admissions')->where('OrgOrganizationId',explode('__',$param)[1])->get();
                return $response_data;
            }
            else  if(explode('__',$param)[0] == "created"){
                $response_data = DB::table('std_admissions')->where('created_by',explode('__',$param)[1])->get();
                return $response_data;
            }else{
                $response_data="";
            }
        }
        else{
            parse_str($param,$output); //revert query string to array and stored to $output
            $response_data = DB::table('std_student_school_detail as c')
                ->join('std_student as p', 'p.id', '=', 'c.StdStudentId')
                ->select('p.id','p.CmnCountryId', 'p.CidNo','p.Name','p.Address',
                'p.DateOfBirth','p.CmnSexId','p.CmnChiwogId','p.CmnLanguageId',
                'p.PhotoPath','p.CmnParentsMaritalStatusId','p.PrimaryContact',
                 'p.Status','p.created_by','p.created_at','p.updated_by', 'p.updated_at'
                );
            if($output['section']!=""){
                $response_data=$response_data->where('c.OrgClassSectionId', $output['section'])->where('IsNewAdmission',1)->get();
            }
            else if($output['class']!=""){
                $response_data=$response_data->where('c.OrgClassId', $output['class'])->where('IsNewAdmission',1)->get();
            }
            else{
                $response_data=$response_data->where('c.Org_Id', $output['org'])->where('IsNewAdmission',1)->get();
            }
        }
        return $this->successResponse($response_data);
    }


    /**
     * load the list of students who have applied for admission
     */
    public function loadStudentAdmissionList($org_id=""){
        $records = DB::table('std_admissions')
            ->where('OrgOrganizationId', $org_id)
            ->get();
    }

    public function getStudentDetails($std_id=""){
        if(strpos($std_id,'_')){
            $response_data=std_admission::where('id',explode('_',$std_id)[1])->first();
            if($response_data!=""){
                $response_data->parents=StudentGuardainDetails::where('student_id',$response_data->id)->get();
            }
        }
        else{
            $response_data=Std_Students::where('id',$std_id)->first();
        }
        if($response_data!=null && $response_data!="" && $response_data->id!=""){
            $response_data->classDetails= StudentClassDetails::where('StdStudentId',$response_data->id)->first();
        }
        return $this->successResponse($response_data);
    }
    public function getAllStudentCid(){
        $response_data=Std_Students::select('CidNo')->get();
        return $this->successResponse($response_data);
    }

    //getting student details std_student table using cid number
    public function getstudentdetailsbyCid($cid){
        $response_data = std_admission::where ('CidNo', $cid)->first();
        if($response_data==""){
            $response_data1=Std_Students::where('CidNo',$cid)->first();
            return $this->successResponse($response_data1);
        }
        return $this->successResponse($response_data);

    }

    public function getstudentGuardainClassDetails($std_id="",$type=""){
        if($type=="guardian"){
            $response_data=StudentGuardainDetails::where('student_id',$std_id)->get();
        }
        if($type=="class"){
            $response_data=StudentClassDetails::where('StdStudentId',$std_id)->first();
        }
        return $this->successResponse($response_data);
    }

    public function getEnrolledStudents($std_id=""){
        $response_data=std_admission::where('id',$std_id)->first();
        return $this->successResponse($response_data);

    }

    public function applicationListsbyCid($cid){
        $response_data = DB::table('std_admissions')
            ->where('CidNo', $cid)
            ->get();
            // ->where('CidNo', $cid)
            // ->where(function($query) {
            // $query->where('Status', 'pending');
            // })->get();
        return $this->successResponse($response_data);


    }

    public function savedrequestadmission(Request $request){
        // dd($request);
        $rules = [
            'dateOfapply'               => 'required',

        ];
        $customMessages = [
            'dateOfapply.required'      => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'dzongkhag'                  =>  $request->dzongkhag,
            'school'                     =>  $request->school,
            'class'                      =>  $request->class,
            'stream'                     =>  $request->stream,
            'dateOfapply'                =>  $request->dateOfapply,
            'reasons'                    =>  $request->reasons,
            'snationality'               =>  $request->snationality,
        ];
        // dd($data);
         $response_data = requestForAdmission::create($data);
         return $this->successResponse($response_data, Response::HTTP_CREATED);

    }

    /**
     * Get the application details
     *
     * For EMIS Portal
     */

    public function getApplicationDetails($id=""){
        $response_data = std_admission::where ('id', $id)->first();
        return $this->successResponse($response_data);
    }

}
