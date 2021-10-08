<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\StudentPersonalDetails;
use App\Models\Students\Std_Students;
use App\Models\Students\Student;
use App\Models\Students\StudentClassAllocation;
use App\Models\std_admission_org;
use App\Models\std_admission;
use App\Models\AdmissionRequest;
use App\Models\AdmissionAttachments;
use App\Models\StudentAdmissionSchool;
use App\Models\StudentGuardian;
use App\Models\Students\StudentClassDetails;
use App\Models\Students\ApplicationSequence;
use App\Models\Students\StudentAboard;
use App\Models\Students\StudentGuardianDetails;
use App\Models\SupplementaryStudent;
use Exception;
use PDO;

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
                //taking care of "null" in middle name
                if($request->middle_name == 'null' || $request->middle_name == 'NULL' || $request->middle_name == 'Null'){
                    $request->middle_name = NULL;
                }
                $data =[
                    'OrgOrganizationId'         =>  $request->OrgOrganizationId,
                    'CmnCountryId'              =>  $request->snationality,
                    'CidNo'                     =>  $request->cid_passport,
                    'FirstName'                =>  $request->first_name,
                    'MiddleName'               =>  $request->middle_name,
                    'LastName'                 =>  $request->last_name,
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

                $data =[
                    'StdAdmissionsId'               =>  $response_data->id,
                    'Dzongkhagid'                   =>  $request->Dzongkhagid,
                    'OrgOrganizationId'             =>  $request->OrgOrganizationId,
                    'class_id'                      =>  $request->std_class,
                    'dateOfapply'                   =>  date('Y-m-d'),
                    'Status'                        =>  'Pending',
                    'created_by'                    =>  $request->user_id,
                ];
                $response_data = StudentAdmissionSchool::create($data);
            }
            else{
                $data =[
                    'OrgOrganizationId'         =>  $request->OrgOrganizationId,
                    'CmnCountryId'              =>  $request->snationality,
                    'CidNo'                     =>  $request->cid_passport,
                    'FirstName'                =>  $request->first_name,
                    'MiddleName'               =>  $request->middle_name,
                    'LastName'                 =>  $request->last_name,
                    'DateOfBirth'               =>  $request->dob,
                    'CmnSexId'                  =>  $request->sex_id,
                    'CmnChiwogId'               =>  $request->village_id,
                    'CmnGewogId'                =>  $request->gewog,
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
        $currDetails=std_admission::where('created_by',$request->user_id)->first();
        
        //taking care of "null" in middle name
        if($request->middle_name == 'null' || $request->middle_name == 'NULL' || $request->middle_name == 'Null'){
            $request->middle_name = NULL;
        }

        $data =[
            'CmnCountryId'              =>  $request->snationality,
            'CidNo'                     =>  $request->cid_passport,
            'FirstName'                 =>  $request->first_name,
            'MiddleName'                =>  $request->middle_name,
            'LastName'                  =>  $request->last_name,
            'DateOfBirth'               =>  $request->dob,
            'CmnSexId'                  =>  $request->sex_id,
            'CmnDzoId'                  =>  $request->dzongkhag,
            'CmnGewogId'                =>  $request->gewog,
            'CmnChiwogId'               =>  $request->village_id,
            'Address'                   =>  $request->fulladdress,
            'PhotoPath'                 =>  $request->file_path,
            'DateOfApply'               =>  date('Y-m-d'),
            'created_by'                =>  $request->user_id,
            'created_at'                =>  date('Y-m-d h:i:s'),
        ];
        // dd($data);
        if($currDetails==null || $currDetails==""){
            $response_data = std_admission::create($data);
        }
        else{
            $response_data = std_admission::where('created_by',$request->user_id)->update($data);
            $response_data =std_admission::where('created_by',$request->user_id)->first();
        }
        return $response_data;
    }

    public function saveorgclassDetails(Request $request){
        $response_data =std_admission::where('created_by',$request->user_id)->first();
        if($response_data!=null && $response_data!=""){
            $data =[
                'AdmissionType'              =>  $request->admission_type,
            ];
            $response_data = std_admission::where('created_by',$request->user_id)->update($data);
        }
        $rules = [
            'dzongkhag'                 => 'required',
            'school'                    => 'required',
            'class'                      => 'required',
        ];
        $customMessages = [
            'dzongkhag.required'            => 'This field is required',
            'school.required'            => 'This field is required',
            'class.required'              => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'StdAdmissionsId'               =>  $request->student_id,
            'Dzongkhagid'                   =>  $request->dzongkhag,
            'OrgOrganizationId'             =>  $request->school,
            'class_id'                      =>  $request->class,
            'stream_id'                     =>  $request->stream,
            'dateOfapply'                   =>  date('Y-m-d'),
            'Status'                        =>  'Pending',
            'created_by'                    =>  $request->user_id,
        ];
        $response_data = StudentAdmissionSchool::create($data);
        return $response_data;
    }

    public function savefilanorgclassDetails(Request $request){
        $response_data =std_admission::where('created_by',$request->user_id)->first();
        if($response_data!=null && $response_data!=""){
            $std_data =[
                'Status'                    =>  'Submitted',
                'DateOfApply'               =>  date('Y-m-d'),
            ];
            $response_data = std_admission::where('created_by',$request->user_id)->update($std_data);
        }
        $data =[
            'Status'                        =>  'Submitted',
        ];
        $response_data = StudentAdmissionSchool::where('created_by',$request->user_id)->update($data);
        return $response_data;
    }

    public function getorgclassDetails($id=""){
        $response_data =StudentAdmissionSchool::where('StdAdmissionsId',$id)->get();
        return $response_data;
    }

    public function deleteclassDetails($id=""){
        $action_type=explode('__',$id)[1];
        $record_id=explode('__',$id)[0];
        if($action_type=="Remove"){
            $response_data =StudentAdmissionSchool::where('id',$record_id)->delete();
        }else if($action_type=="Rejected"){
            $data=[
                'student_decision' =>$action_type,
            ];
            $response_data =StudentAdmissionSchool::where('id',$record_id)->update($data);
        }
        else if($action_type=="Accepted"){
            $admission_id=StudentAdmissionSchool::where('id',$record_id)->first()->StdAdmissionsId;
            $data=[
                'student_decision' =>'Rejected',
            ];
            $response_data =StudentAdmissionSchool::where('StdAdmissionsId',$admission_id)->update($data);
            $data=[
                'student_decision' =>$action_type,
            ];
            $response_data =StudentAdmissionSchool::where('id',$record_id)->update($data);
        }
        return $response_data;
    }

    public function saveStudentGardianDetails(Request $request){
        $response_data =std_admission::where('created_by',$request->user_id)->first();
        if($response_data!=""){
            $update_data =[
                'CmnParentsMaritalStatusId'          =>  $request->merital_status,
                'PrimaryContact'                     =>  $request->primary_contact,
            ];
            std_admission::where('created_by',$request->user_id)->update($update_data);

            if($request->father_cid_passport!="" && $request->father_cid_passport!=null){
                $data =[
                    'StdStudentId'                  =>  $response_data->id,
                    'ContactType'                   =>  'Father',
                    'Relationship'                  =>  'Father',
                    'CmnNationalityId'              =>  $request->father_nationality,
                    'CidNo'                         =>  $request->father_cid_passport,
                    'Name'                          =>  $request->father_first_name,
                    'CmnPermanentChiwogId'          =>  $request->father_village_id,
                    'CmnPresentChiwogId'            =>  $request->father_present_village_id,
                    'WorkAddress'                   =>  $request->father_work_address,
                    'ResidenceAddress'              =>  $request->father_residence_address,
                    'CmnOccupationId'               =>  $request->father_occupation,
                    'Email'                         =>  $request->father_email,
                    'ContactNo'                     =>  $request->father_cntct_no,
                    'created_by'                    =>  $request->user_id,
                    'created_at'                    =>  date('Y-m-d h:i:s'),
                ];
                $response_data = StudentGuardian::create($data);
            }
            if($request->mother_cid_passport!="" && $request->mother_cid_passport!=null){
                $data =[
                    'StdStudentId'              =>  $response_data->id,
                    'ContactType'               =>  'Mother',
                    'Relationship'              =>  'Mother',
                    'CmnNationalityId'          =>  $request->mother_nationality,
                    'CidNo'                     =>  $request->mother_cid_passport,
                    'Name'                      =>  $request->mother_first_name,
                    'CmnPermanentChiwogId'      =>  $request->mother_village_id,
                    'CmnPresentChiwogId'        =>  $request->mother_present_village_id,
                    'WorkAddress'               =>  $request->mother_work_address,
                    'ResidenceAddress'          =>  $request->mother_residence_address,
                    'CmnOccupationId'           =>  $request->mother_occupation,
                    'Email'                     =>  $request->mother_email,
                    'ContactNo'                 =>  $request->mother_cntct_no,
                    'created_by'                =>  $request->user_id,
                    'created_at'                =>  date('Y-m-d h:i:s'),
                ];
                $response_data = StudentGuardian::create($data);
            }
            if($request->gardain_cid_passport!="" && $request->gardain_cid_passport!=null){
                $std_admission =[
                    'StdStudentId'                  =>  $response_data->id,
                    'ContactType'                   =>  'Guardian',
                    'Relationship'                  =>  'Guardian',
                    'CmnNationalityId'              =>  $request->gardain_nationality,
                    'CidNo'                         =>  $request->gardain_cid_passport,
                    'Name'                          =>  $request->gardain_first_name,
                    'CmnPermanentChiwogId'          =>  $request->gardain_village_id,
                    'CmnPresentChiwogId'            =>  $request->gardain_present_village_id,
                    'WorkAddress'                   =>  $request->gardain_work_address,
                    'ResidenceAddress'              =>  $request->gardain_residence_address,
                    'CmnOccupationId'               =>  $request->gardain_occupation,
                    'Email'                         =>  $request->gardain_email,
                    'ContactNo'                     =>  $request->gardain_cntct_no,
                    'created_by'                    =>  $request->user_id,
                    'created_at'                    =>  date('Y-m-d h:i:s'),
                ];
                $response_data = StudentGuardian::create($std_admission);
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function getstudentadmissiondetails($user_id=""){
        $response_data =std_admission::where('created_by',$user_id)->first();
        if($response_data!=null && $response_data!=""){
            $gard=StudentGuardian::where('StdStudentId',$response_data->id)->get();
            if($gard!=null && $gard!="" && sizeof($gard)>0){
                $response_data->guardians =$gard;
            }
        } else {
            $response_data =Student::where('student_code',$user_id)->first();
            $gard=StudentGuardian::where('StdStudentId',$response_data->id)->get();
            if($gard!=null && $gard!="" && sizeof($gard)>0){
                $response_data->guardians =$gard;
            }
        }
        return $response_data;
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

        dd('MS');
        $this->validate($request, $rules, $customMessages);
    }

    /**
     * Verify if this function is used. If not, then delete
     * Created by Tshewang to save the details (e.g. scholarship etc) when admitting student
     */

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
                'isSen'              =>  $request->disability,
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
                'isSen'              =>  $request->disability,
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
                'isSen'                =>  $request->disability,
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
            'isSen'                     =>  $request->disability,
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
                $response_data = StudentAdmissionSchool::where('OrgOrganizationId',explode('__',$param)[1])->get();
                if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
                    foreach($response_data as $data){
                        $admission_details =std_admission::where('id',$data['StdAdmissionsId'])->first();
                        if($admission_details==null && $admission_details==""){
                            $admission_details =Student::where('id',$data['StdAdmissionsId'])->first();
                        }
                        $data->admisiondet = $admission_details;
                    }
                }
                // DB::table('std_admissions as s')
                // ->rightjoin('std_admissions_schools as o','s.id','=','o.StdAdmissionsId')
                // ->select('o.id','s.FirstName as first_name', 's.LastName as last_name','s.CmnSexId','o.Status',
                // )->where('o.OrgOrganizationId',explode('__',$param)[1])->get();
                return $response_data;
            }
            else  if(explode('__',$param)[0] == "created"){
                $response_data = DB::table('std_admissions')
                                    ->join('std_admissions_schools', 'std_admissions.id','=', 'std_admissions_schools.StdAdmissionsId')
                                    ->select('std_admissions.*', 'std_admissions_schools.school_decision', 'std_admissions_schools.student_decision',
                                                'std_admissions_schools.id AS StdAdmissionsSchoolsId')
                                    ->where('std_admissions.created_by',explode('__',$param)[1])
                                    ->get();
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
        if(strpos($std_id,'mission')){
            $response_data=std_admission::where('id',explode('_',$std_id)[1])->first();
            if($response_data!="" && $response_data!=null){
                $response_data->parents=StudentGuardian::where('StdStudentId',$response_data->id)->get();
                $response_data->admission_class=StudentAdmissionSchool::where('StdAdmissionsId',$response_data->id)->select('class_id')->first();
            }
        } else if(strpos($std_id,'-')){
            $response_data=Std_Students::where('student_code',explode('-',$std_id)[1])->first();
            if(empty($response_data)){
                $response_data=Std_Students::where('CidNo',explode('-',$std_id)[1])->first();
            }
            if($response_data!="" && $response_data!=null){
                $response_data->parents=StudentGuardianDetails::where('StdStudentId',$response_data->id)->get();
                $response_data->class=DB::table('std_student_class_stream')
                                        ->where('StdStudentId', $response_data->id)
                                        ->first();
                $response_data->admission_class=StudentAdmissionSchool::where('StdAdmissionsId',$response_data->id)->select('class_id')->first();
            }
        } else if(strpos($std_id,'_')){
            $response_data=std_admission::where('id',explode('_',$std_id)[1])->first();
            if($response_data!="" && $response_data!=null){
                $response_data->parents=StudentGuardian::where('StdStudentId',$response_data->id)->get();
                $response_data->admission_class=StudentAdmissionSchool::where('StdAdmissionsId',$response_data->id)->select('class_id')->first();
            }
        }
        else{
            $response_data=Std_Students::where('id',$std_id)->first();
            if($response_data!="" && $response_data!=null){
                $response_data->parents=StudentGuardianDetails::where('StdStudentId',$response_data->id)->get();
                $response_data->admission_class=StudentAdmissionSchool::where('StdAdmissionsId',$response_data->id)->select('class_id')->first();
            }
        }
        if($response_data!=null && $response_data!="" && $response_data->id!=""){
            $response_data->classDetails= StudentClassDetails::where('StdStudentId',$response_data->id)->first();
            $response_data->class=DB::table('std_student_class_stream')
                                        ->where('StdStudentId', $response_data->id)
                                        ->first();
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

    public function getTransferDetails($std_id=""){
        $response_data = DB::table('std_student')
            ->join('std_is_transferred', 'std_student.id', '=', 'std_is_transferred.StdStudentId')
            ->where('std_student.id', $std_id)
            ->get();
        return $this->successResponse($response_data);
    }

    public function getstudentGuardainClassDetails($std_id="",$type=""){
        if($type=="guardian"){
            $response_data=StudentGuardian::where('student_id',$std_id)->get();
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

    public function saveAdmissionRequest(Request $request){
        
        $rules = [
            'dzongkhag'               => 'required',

        ];
        $customMessages = [
            'dzongkhag.required'      => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'StdStudentId'              =>  $request->student_id,
            'dzongkhag'                 =>  $request->dzongkhag,
            'dateOfapply'               =>  $request->dateOfapply,
            'reasons'                   =>  $request->reasons,
            'status'                    =>  $request->status,
            'created_by'                 =>  $request->action_by,
        ];
        
         $application = AdmissionRequest::create($data);
         $lastInsertId = $application->id;

        if($request->attachment_details!=null && $request->attachment_details!=""){
            foreach($request->attachment_details as $att){
                $attach =[
                    'AdmissionRequestId'        =>  $lastInsertId,
                    'fileName'                  =>  $att['original_name'],
                    'filePath'                  =>  $att['path'],
                ];
                AdmissionAttachments::create($attach);
            }
        }

        return $this->successResponse($application, Response::HTTP_CREATED);

    }

    /**
     * Update Admission Request
     */

    public function updateAdmissionRequest(Request $request){
        //
    }

    /**
     * Get the application details
     *
     * For EMIS Portal
     */

    public function getApplicationDetails($type="", $id=""){
        if($type == 'student'){
            $response_data = Student::where ('student_code', $id)->first();
        } else{
            $response_data = std_admission::where ('ApplicationId', $id)->first();
        }
        return $this->successResponse($response_data);
    }

    /**
     * load the application requests for admissions
     *
     * For EMIS Portal
     */

    public function loadAdmissionRequest($std_id=""){
        if($std_id == 0){
            $response_data = DB::table('request_for_admissions')
                                ->join('admission_request_files','request_for_admissions.id','=', 'admission_request_files.AdmissionRequestId')
                                ->join('std_student','std_student.student_code','=', 'request_for_admissions.StdStudentId')
                                ->join('std_student_class_stream','std_student_class_stream.StdStudentId','=', 'std_student.id')
                                ->select('request_for_admissions.*', 'admission_request_files.*', 'std_student_class_stream.OrgClassStreamId',
                                            'std_student.name', 'std_student.student_code', 'std_student.OrgOrganizationId')
                                ->get();
        } else{
            $response_data = DB::table('request_for_admissions')
                                ->join('admission_request_files','request_for_admissions.id','=', 'admission_request_files.AdmissionRequestId')
                                ->join('std_student','std_student.student_code','=', 'request_for_admissions.StdStudentId')
                                ->join('std_student_class_stream','std_student_class_stream.StdStudentId','=', 'std_student.id')
                                ->select('request_for_admissions.*', 'admission_request_files.*', 'std_student_class_stream.OrgClassStreamId',
                                            'std_student.name', 'std_student.student_code', 'std_student.OrgOrganizationId',
                                            'std_student.CmnSexId', 'std_student.DateOfBirth')
                                ->where('request_for_admissions.StdStudentId', $std_id)
                                ->get();
        }
        

        return $this->successResponse($response_data);
    }

    /**
     * Load the Position of the student of the Class X Results for Admission
     */

    public function loadResultPosition($std_code){

        $orgs_applied = DB::table('std_admissions_schools')
                                ->join('std_student','std_student.id','=', 'std_admissions_schools.StdAdmissionsId')
                                ->join('bcsea_bcse','std_student.student_code','=', 'bcsea_bcse.std_regno')
                                ->select('std_admissions_schools.OrgOrganizationId', 'rank')
                                ->where('std_student.student_code', $std_code)
                                ->groupBy('std_admissions_schools.OrgOrganizationId')
                                ->get();
        
        $streams_applied = DB::table('std_admissions_schools')
                                ->join('std_student','std_student.id','=', 'std_admissions_schools.StdAdmissionsId')
                                ->join('bcsea_bcse','std_student.student_code','=', 'bcsea_bcse.std_regno')
                                ->select('stream_id')
                                ->where('std_student.student_code', $std_code)
                                ->groupBy('stream_id')
                                ->get();

        $response_data = (object)[];
        
        foreach($orgs_applied as $key => $value){
            foreach($streams_applied as $k=>$stream){
                $temp = (object)[];
                $temp->strm = $stream->stream_id;
                $stream_check = $this->checkOrgStreamApplication($value->OrgOrganizationId, $stream->stream_id, $std_code);
                if($stream_check){
                    $temp->rank = DB::table('std_admissions_schools')
                                ->join('std_student','std_student.id','=', 'std_admissions_schools.StdAdmissionsId')
                                ->join('bcsea_bcse','std_student.student_code','=', 'bcsea_bcse.std_regno')
                                ->where('std_admissions_schools.stream_id',$stream->stream_id)
                                ->where('std_admissions_schools.OrgOrganizationId',$value->OrgOrganizationId)
                                ->where('bcsea_bcse.rank','<=', $value->rank)
                                ->count();
                    
                } else {
                    $temp->rank = 'NA';
                }
                $orgs_applied[$key]->data[$k] =$temp;
            }
            // $orgs_applied[$key]->data = $streams_applied;
        }

        $response_data = $orgs_applied;

        return $this->successResponse($response_data);
    }

    /**
     * Private function to check whether the student has applied for 
     * a stream in a particular organization
     */

    private function checkOrgStreamApplication($orgId, $streamId, $std_code){
        $response_data = DB::table('std_admissions_schools')
                                ->join('std_student','std_student.id','=', 'std_admissions_schools.StdAdmissionsId')
                                ->select('stream_id')
                                ->where('std_student.student_code', $std_code)
                                ->where('std_admissions_schools.OrgOrganizationId', $orgId)
                                ->where('std_admissions_schools.stream_id', $streamId)
                                ->get();
        if($response_data!=null && $response_data!="" && sizeof($response_data) >0){
            return true;
        } else {
            return false;
        }

    }

    /**
     * Update Student Admission
     */

    public function updateStudentAdmission(Request $request){
        if($request->actionType=="Accepted"){
            $request_data =[
                'school_decision'       =>  $request->actionType,
                'Status'                =>  $request->actionType,
            ];
            $response_data=StudentAdmissionSchool::where('id', $request->id)->update($request_data);
        }else{
            $request_data =[
                'id'                        =>  $request->id,
                'org_id'                    =>  $request->org_id,
                'dzo_id'                    =>  $request->dzo_id,
                'user_id'                   =>  $request->user_id
            ];

            $admission_data = std_admission::where ('id', $request->id)->first();

            $student_data =[
                'OrgOrganizationId'     =>  $request->org_id,
                'CidNo'                 =>  $admission_data->CidNo,
                'student_code'          =>  $admission_data->CidNo,
                'Name'                  =>  $admission_data->first_name.' '.$admission_data->middle_name.' '.$admission_data->last_name,
                'CmnSexId'              =>  $admission_data->CmnSexId,
                'DateOfBirth'           =>  $admission_data->DateOfBirth,
                'CmnCountryId'          =>  $admission_data->CmnCountryId,
                'CmnGewogId'            =>  $admission_data->CmnGewogId,
                'CmnChiwogId'           =>  $admission_data->CmnChiwogId,
                'CmnLanguageId'         =>  $admission_data->CmnLanguageId,
                'IsNewAdmission'        => 1,
                'IsTransferred'         => 0,
                'isSen'                 => 0,
                'IsRejoined'            => 1
            ];

            $response_data = Student::create($student_data);

            $data=[
                'Status' => 'Admitted'
            ];

            $student_class_data=[
                'StdStudentId'          => $response_data->id,
                'OrgClassStreamId'      => $admission_data->class_id,
                'academicYear'          => date('Y')
            ];

            $update_class = StudentClassAllocation::create($student_class_data);

            $update_status = std_admission::where('id',$request->id)->update($data);
        }
        return $this->successResponse($response_data);

    }

    /**
     * Update Student Transfer
     */

    public function updateStudentTransfer(Request $request){
        // $data =[
        //     'id'                        =>  $request->id,
        //     'org_id'                    =>  $request->org_id,
        //     'dzo_id'                    =>  $request->dzo_id,
        //     'user_id'                   =>  $request->user_id
        // ];

        $data =[
            'IsTransferred'                    =>  0,
            'IsRejoined'                       =>  1,
            'OrgOrganizationId'                =>  $request->org_id,
        ];

        $response_data = Student::where('id',$request->id)->update($data);
        return $this->successResponse($response_data);

    }

    /**
     * Get the Qualification Marks for each stream (XI Admission)
     */

    public function loadQualificationMarks(){
        $response_data = DB::table('subject_marks')
                                ->select('streamId', 'marks', 'grade')
                                ->get();

        return $this->successResponse($response_data);

    }

    /**
     * Get the marks obtained by student in class X
     * 
     * Academic Year could be used as another where parameter (for future)
     */

    public function loadStudentMarks($std_code){
        $response_data = DB::table('bcsea_bcse')
                                ->select('std_admissions_schools.OrgOrganizationId', 'rank')
                                ->where('bcsea_bcse.std_regno', $std_code)
                                ->get();
                                
        return $this->successResponse($response_data);
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

        $id = $request->id;

        $data =[
            'id '               => $request->id,
            'StdStudentId '     => $request->student_id,
            'retakeCA'          => $request->retakeCA,
            'AcademicYear'      => date('Y'),
            // 'created_by'        => $request->user_id,
            // 'updated_by',
            // 'created_at',
            // 'updated_at'
        ];

        if( $id != null){
            $response_data = SupplementaryStudent::where('id', $id)->update($data);

        }else{                
            $response_data = SupplementaryStudent::create($data);
         }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}
