<?php

namespace App\Http\Controllers\staff;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Models\staff\DocumentDetails;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\PersonalDetails;
use App\Models\staff\QualificationDetails;
use App\Models\staff\TransferApplication;
use App\Models\staff\Nomination;
use App\Models\staff\StaffHistory;
use App\Models\staff_leadership\LeadershipApplication;
use App\Models\staff_leadership\LeadershipDetails;
use App\Models\staff_masters\ChildGroup;
use App\Models\staff_masters\ChildGroupPosition;
use App\Models\staff_masters\CourseMode as Staff_mastersCourseMode;
use App\Models\staff_masters\DonerAgency;
use App\Models\staff_masters\Institute;
use App\Models\staff_masters\MaritalStatus;
use App\Models\staff_masters\PositionLevel;
use App\Models\staff_masters\PositionTitle;
use App\Models\staff_masters\ProjectDonerAgency;
use App\Models\staff_masters\Qualification;
use App\Models\staff_masters\QualificationDescription;
use App\Models\staff_masters\QualificationLevel;
use App\Models\staff_masters\QualificationType;
use App\Models\staff_masters\StaffSubMajorGrop;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function savePersonalDetails(Request $request){
        $response_data=[];
        if($request->personal_id==""){
            $rules = [
                'emp_type'              =>  'required',
                'cid_work_permit'       =>  'required|unique:stf_staff',
                'name'                  =>  'required',
                'sex_id'                =>  'required',
                'dob'                   =>  'required',
                'contact_number'        =>  'required',
                'email'                 =>  'required |unique:stf_staff',
                'position_title'        =>  'required',
                'working_agency_id'     =>  'required',
                // 'currier_stage'         =>  'required',
            ];
            if($request->emp_type=="Regular" || $request->emp_type=="Volunteer"){
                $rules=array_merge($rules,
                    array('marital_status'        =>  'required',
                    'emp_file_code'         =>  'required',)
                );
            }
            if($request->isteaching){
                $rules= $rules+['comp_sub'              =>  'required',
                                'elective_sub1'         =>  'required'];
            }
            $this->validate($request, $rules);
        }

        $sen=0;
        if($request->issen=="Yes"){
            $sen=1;
        }
        $data =[
            'emp_type_id'           =>  $request->emp_type,
            'cid_work_permit'       =>  $request->cid_work_permit,
            'contract_category'     =>  $request->contract_category,
            'emp_id'                =>  $request->emp_id,
            'name'                  =>  $request->name,
            'sex_id'                =>  $request->sex_id,
            'dob'                   =>  Carbon::parse($request->dob)->format('Y-m-d'),
            'is_sen'                =>  $sen,
            'merital_status'        =>  $request->marital_status,
            'country_id'            =>  $request->country_id,
            'org_level'             =>  $request->organization_type,
            'p_dzongkhag'           =>  $request->p_dzongkhag,
            'p_gewog'               =>  $request->p_gewog,
            'p_village'             =>  $request->p_village_id,
            'dzo_id'                =>  $request->dzongkhag,
            'geowg_id'              =>  $request->gewog,
            'village_id'            =>  $request->village_id,
            'address'               =>  $request->address,
            'contact_no'            =>  $request->contact_number,
            'email'                 =>  $request->email,
            'alternative_email'     =>  $request->alternative_email,
            'position_title_id'     =>  $request->position_title,
            'position_sub_level_id' =>  $request->position_sub_level,
            'working_agency_id'     =>  $request->working_agency_id,
            'comp_sub_id'           =>  $request->comp_sub[0],
            'elective_sub_id1'      =>  $request->elective_sub1,
            'elective_sub_id2'      =>  $request->elective_sub2,
            'initial_appointment_date' =>  Carbon::parse($request->initial_appointment_date)->format('Y-m-d'),
            'cureer_stagge_id'      =>  $request->currier_stage,
            'employee_code'         =>  $request->emp_file_code,
            'remarks'               =>  $request->remarks,
            'status'                =>  $request->status,
        ];
        // dd($data);
        if($request->status=="Pending"){
            $data=array_merge($data,
                array('created_by'            =>  $request->user_id,
                      'created_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->status=="Created"){
            $data=array_merge($data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }

        if($request->personal_id==""){
            $response_data = PersonalDetails::create($data);
            // $curr_data=[
            //     'staff_id'              =>  $response_data->id,
            //     'currier_stage'         =>  $request->currier_stage,
            //     'remarks'               =>  $request->remarks,
            //     'created_by'            =>  $request->user_id,
            //     'created_at'            =>  date('Y-m-d h:i:s'),
            // ];
            // CareerStage::create($curr_data);
        }
        else{
            $act_det = PersonalDetails::where ('id', $request->personal_id)->firstOrFail();
            $act_det->fill($data);
            $response_data=$act_det->save();
            // $curr_data=[
            //     'currier_stage'         =>  $request->currier_stage,
            //     'remarks'               =>  $request->remarks,
            // ];
            // CareerStage::where('staff_id',$request->personal_id)->update($curr_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loaddraftpersonalDetails(Request $request,$type="",$user_id=""){
        if($type=="Private"){
            return $this->successResponse(PersonalDetails::where('created_by',$user_id)->where('status','Pending')->where('emp_type_id',$type)->first());
        }
        else{
            $emp_type=['1','2','3'];
            return $this->successResponse(PersonalDetails::where('created_by',$user_id)->where('status','Pending')->wherein('emp_type_id',$emp_type)->first());
        }
    }

    public function checkThisCid($cid=""){
        return $this->successResponse(PersonalDetails::where('cid_work_permit',$cid)->first());
    }

    public function savequalificationDetails(Request $request){
        $response_data=[];
        $rules = [
            'description'      =>  'required',
            'doner_agency'     =>  'required',
            'field'            =>  'required',
            'degree'           =>  'required',
            'coursemode'       =>  'required',
            'coursetitle'      =>  'required',
            'firstsub'         =>  'required',
            'country'          =>  'required',
            'startdate'        =>  'required',
            'enddate'          =>  'required'
        ];
        $customMessages = [
            'description.required'        => 'This field is required',
            'doner_agency.required'       => 'This field is required',
            'field.required'              => 'This field is required',
            'degree.required'             => 'This field is required',
            'coursemode.required'         => 'This field is required',
            'coursetitle.required'        => 'This field is required',
            'firstsub.required'           => 'This field is required',
            'country.required'            => 'Country field is required',
            'startdate.required'          => 'This field is required',
            'enddate.required'            => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'personal_id'           =>  $request->personal_id,
            'category'              =>  $request->description,
            'doner_id'              =>  $request->doner_agency,
            'project_doner_id'      =>  $request->project_doner_agency,
            'field_id'              =>  $request->field,
            'degree_id'             =>  $request->degree,
            'first_subject'         =>  $request->firstsub,
            'second_subject'        =>  $request->secondsub,
            'coursemode'            =>  $request->coursemode,
            'coursetitle'           =>  $request->coursetitle,
            'country'               =>  $request->country,
            'institute_id'          =>  $request->institute,
            'startdate'             =>  $request->startdate,
            'enddate'               =>  $request->enddate,
            'status'                =>  $request->status,
            'remarks'               =>  $request->remarks,

        ];
        if($request->status=="Pending"){
            $data=array_merge($data,
                array('created_by'            =>  $request->user_id,
                      'created_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->status=="Created"){
            $data=array_merge($data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->action_type=="add"){
            $response_data = QualificationDetails::create($data);
        }
        else if($request->action_type=="edit"){
            $act_det = QualificationDetails::where ('id', $request->qualification_id)->firstOrFail();
            $act_det->fill($data);
            $response_data=$act_det->save();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadQualification($staff_id="",$user_id=""){
        return $this->successResponse(QualificationDetails::where('created_by',$user_id)->where('personal_id',$staff_id)->where('status','Pending')->get());
    }
    public function loadStaffQualification($staff_id=""){
        $qualification=QualificationDetails::where('personal_id',$staff_id)->get();
        if($qualification!=null && $qualification!="" && sizeof($qualification)>0){
            foreach($qualification as $qua){
                $category=QualificationDescription::where('id',$qua->category)->first();
                if($category!=null && $category!=""){
                    $qua->categoryname=$category->name;
                }
                $doner=DonerAgency::where('id',$qua->doner_id)->first();
                if($doner!=null && $doner!=""){
                    $qua->doneragencyname=$doner->name;
                }
                $projectdoner=ProjectDonerAgency::where('id',$qua->project_doner_id)->first();
                if($projectdoner!=null && $projectdoner!=""){
                    $qua->projectdoneragencyname=$projectdoner->name;
                }
                $field=QualificationType::where('id',$qua->field_id)->first();
                if($field!=null && $field!=""){
                    $qua->fieldname=$field->name;
                }
                $degree=QualificationLevel::where('id',$qua->degree_id)->first();
                if($degree!=null && $degree!=""){
                    $qua->degreename=$degree->name;
                }
                $sub1=Qualification::where('id',$qua->first_subject)->first();
                if($sub1!=null && $sub1!=""){
                    $qua->sub1name=$sub1->name;
                }
                $sub2=Qualification::where('id',$qua->second_subject)->first();
                if($sub2!=null && $sub2!=""){
                    $qua->sub2name=$sub2->name;
                }
                $coursemode=Staff_mastersCourseMode::where('id',$qua->coursemode)->first();
                if($coursemode!=null && $coursemode!=""){
                    $qua->coursemodename=$coursemode->name;
                }
                $institute=Institute::where('id',$qua->institute_id)->first();
                if($institute!=null && $institute!=""){
                    $qua->institutename=$institute->name;
                }
            }
        }

        return $this->successResponse($qualification);
    }

    public function savenominationDetails(Request $request){
        $response_data=[];
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
            'nomi_relation.required'        => 'Relationship field is required',
        ];
        $this->validate($request, $rules,$customMessages);

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
            'nomi_percentage'                   =>  $request->nomi_percentage,
            'status'                            =>  $request->status,
        ];
        if($request->status==null || $request->status=="Pending"){
            $nomination_details=array_merge($nomination_details,
                array('created_by'            =>  $request->user_id,
                      'created_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->status=="Created"){
            $nomination_details=array_merge($nomination_details,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->action_type=="add"){
            $response_data = Nomination::create($nomination_details);
        }
        else if($request->action_type=="edit"){
            $act_det = Nomination::where ('id', $request->nomination_id)->firstOrFail();
            $act_det->fill($nomination_details);
            $response_data=$act_det->save();
            $response_data = Nomination::where ('id', $request->nomination_id)->first();
        }
        // dd($request->attachment_details);
        if($request->attachment_details!=null){
            foreach($request->attachment_details as $att){
                $doc_data =[
                    'parent_id'                        =>  $response_data->id,
                    'attachment_for'                   =>  'Family Relationship',
                    'path'                             =>  $att['path'],
                    'original_name'                    =>  $att['original_name'],
                    'user_defined_name'                =>  $att['user_defined_name'],
                ];
                DocumentDetails::create($doc_data);
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function updateStaffDetails(Request $request){
        $response_data="";
        if($request->action_type=="Leadership Update"){
            $applicant_det   = LeadershipApplication::where('id',$request->id)->first();
            $staff_detials=PersonalDetails::where('id',$applicant_det->staff_id)->first();
            $history_data=[
                'record_id'                    =>$staff_detials->id,
                'position_title_id'            =>$staff_detials->position_title_id,
                'inserted_at'                  =>date('Y-m-d h:i:s'),
                'remarks'                      =>$request->record_remarks,
                'inserted_by'                  =>$request->user_id,
                'inserted_for'                 =>'Leadership Selection',
                'inserted_application_no'      =>$applicant_det->application_number,
            ];
            StaffHistory::create($history_data);
            $post_details=LeadershipDetails::where('id',$applicant_det->leadership_id)->first();
            $update_data=[
                'position_title_id'            =>$post_details->position_title,
            ];
            PersonalDetails::where('id',$applicant_det->staff_id)->update($update_data);
            $app_update_data=[
                'effective_date'            =>$post_details->effective_date,
                'reported_date'             =>date('Y-m-d'),
                'status'                    =>  'Reported',
                'updated_by'                =>  $request->user_id,
                'updated_at'                =>  date('Y-m-d h:i:s')
            ];
            $response_data=LeadershipApplication::where('id',$request->id)->update($app_update_data);
        }
        //updating and doing backup for staff transfer
        if($request->action_type=="TransferReport Update"){
            $applicant_det  = TransferApplication::where('id',$request->id)->first();
            $staff_detials=PersonalDetails::where('id',$applicant_det->staff_id)->first();
            $history_data=[
                'id'                           =>$staff_detials->id,
                'name'                         =>$staff_detials->name,
                'cid_work_permit'              =>$staff_detials->cid_work_permit,
                'dzo_id'                       =>$staff_detials->dzo_id,
                'geowg_id'                     =>$staff_detials->geowg_id,
                'village_id'                   =>$staff_detials->village_id,
                'position_title_id'            =>$staff_detials->position_title_id,
                'working_agency_id'            =>$staff_detials->working_agency_id,
                'inserted_at'                  =>date('Y-m-d h:i:s'),
                'inserted_by'                  =>$request->user_id,
                'inserted_for'                 =>'Transfer Application',
                'inserted_application_no'      =>$request->application_number,
            ];
            StaffHistory::create($history_data);
            $final_data =[
                'id'                           =>  $request->id,
                'dzongkhagApproved'            =>  $request->dzongkhagApproved,
                'effective_date'               =>  $request->effective_date,
                'remarks'                      =>  $request->remarks,
                'updated_by'                   =>  $request->user_id,
                'updated_at'                   =>  date('Y-m-d h:i:s'),
                'preference_school'            =>  $request->preference_school,
                'status'                       => 'Reported'
            ];
            $response_data=TransferApplication::where('id', $request->id)->update($final_data);
            $update_data=[
                'dzo_id'                       =>$request->dzongkhagApproved,
                'working_agency_id'            =>$request->preference_school,
            ];
            PersonalDetails::where('id',$applicant_det->staff_id)->update($update_data);
            return $this->successResponse($response_data, Response::HTTP_CREATED);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadNominations($staff_id="",$user_id=""){
        $nomineeDetails=Nomination::where('created_by',$user_id)->where('personal_id',$staff_id)->where('status','Pending')->get();
        if($nomineeDetails!=null & $nomineeDetails!="" && sizeof($nomineeDetails)>0){
            foreach($nomineeDetails as $nom){
                $nom->attachment=DocumentDetails::where('parent_id',$nom['id'])->get();
            }
        }
        return $this->successResponse($nomineeDetails);
    }

    public function loadStaffNomination($staff_id=""){
        $nomineeDetails=Nomination::where('personal_id',$staff_id)->where('status','Created')->get();
        if($nomineeDetails!=null & $nomineeDetails!="" && sizeof($nomineeDetails)>0){
            foreach($nomineeDetails as $nom){
                $nom->attachment=DocumentDetails::where('parent_id',$nom['id'])->get();
            }
        }
        return $this->successResponse($nomineeDetails);
    }

    public function updatefinalstaffDetails(Request $request){
        $response_data=[];
        $final_details =[
            'status'           =>  'Created',
            'created_by'       =>  $request->user_id,
            'created_at'       =>  date('Y-m-d h:i:s')
        ];
        $act_det = PersonalDetails::where('id', $request->personal_id)->firstOrFail();
        $act_det->fill($final_details);
        $response_data=$act_det->save();

        QualificationDetails::where('personal_id', '=',$request->personal_id)->where('status', 'Pending')
        ->update($final_details);

        $act_det = Nomination::where ('personal_id', $request->personal_id)->where('status', 'Pending')
        ->update($final_details);

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function updatefinalPrivatestaffDetails(Request $request){
        $response_data=[];
        $final_details =[
            'status'           =>  'Created',
            'created_by'       =>  $request->user_id,
            'created_at'       =>  date('Y-m-d h:i:s')
        ];
        $act_det = PersonalDetails::where('id', $request->personal_id)->firstOrFail();
        $act_det->fill($final_details);
        $response_data=$act_det->save();

        QualificationDetails::where('personal_id', '=',$request->personal_id)->where('status', 'Pending')
        ->update($final_details);

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    // public function loadAllStaff($type=""){
    //     if(strpos($type,',')){
    //         $emp_type=[];
    //         foreach(explode(',',$type) as $emp){
    //             array_push($emp_type,$emp);
    //         }
    //         return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->get());
    //     }
    //     else{
    //         return $this->successResponse(PersonalDetails::where('emp_type_id',$type)->where('status','Created')->get());
    //     }
    // }

    public function getEmisUsers($empId=""){
        if(strlen($empId)==11){
            return $this->successResponse(PersonalDetails::where('cid_work_permit',$empId)->where('status','Created')->first());
        }
        else{
            return $this->successResponse(PersonalDetails::where('emp_id',$empId)->where('status','Created')->first());
        }
    }

    // public function loadStaff($type="",$param=""){
    //     if($type=="workingagency"){
    //         return $this->successResponse(PersonalDetails::where('working_agency_id',$param)->get());
    //     }
    //     else if($type=="dzongkhagwise"){
    //         return $this->successResponse(PersonalDetails::where('dzo_id',$param)->get());
    //     }
    //     else{
    //         return $this->successResponse(PersonalDetails::all());
    //     }
    //     return $this->successResponse(PersonalDetails::all());
    // }

    public function load_staff_details_by_id($id=""){
        return $this->successResponse(PersonalDetails::where('id',$id)->first());
    }
	public function getLoginUser($orgId){
        $user = DB::select('SELECT t1.id AS stf_staff_id, t1.employee_code, t1.working_agency_id, t1.name,t2.name AS position FROM stf_staff t1 JOIN master_stf_position_title t2 ON t1.position_title_id = t2.id where t1.working_agency_id = ?', [$orgId]);
        return $this->successResponse($user);
    }

    public function viewStaffProfile($id=""){
        $staff_det=PersonalDetails::where('id',$id)->first();
        if($staff_det!=null && $staff_det!=""){
            $merital=MaritalStatus::where('id',$staff_det->merital_status)->first();
            if($merital!=null && $merital!=""){
                $staff_det->maritalstatus=$merital->name;
            }
            // $position=PositionTitle::where('id',$staff_det->position_title_id)->first();
            // if($position!=null && $position!=""){
            //     $staff_det->position_title_name=$position->name;
            // } //commented by tshewang

            //mapping of the position tile, superstructure and childgroup
            $positions=ChildGroupPosition::where('id', $staff_det->position_title_id)->first();
            if($positions!=null && $positions!=""){
                //get position title from mapping
                $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                if($posi!=null && $posi!=""){
                    $staff_det->position_title_name=$posi->name;
                    //get position level from position title
                    $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                    if($posiLev!=null && $posiLev!=""){
                        $staff_det->positionlevel=$posiLev->name;
                    }
                }

                //to get MOG, used for eding staff details
                $child=ChildGroup::where('id',$positions->child_group_id)->first();
                if($child!=null && $child!=""){
                    $staff_det->childgroup=$child->name;
                    //to get MOG, used for eding staff details to identify teacher in school
                    $submajorgrp=StaffSubMajorGrop::where('id', $child->sub_group_id)->first();
                    if($submajorgrp!=null && $submajorgrp!=""){
                        $staff_det->subgroup=$submajorgrp->name;
                    }
                }
            }
        }
        return $this->successResponse($staff_det);
    }
    //functions created by chilliquest
    public function getStaffName($Id){
        return $this->successResponse(DB::select("SELECT id AS stf_staff_id,name FROM stf_staff WHERE id = ?",[$Id]));
    }
    public function getPrincipal($orgId){
        return $this->successResponse(DB::select("SELECT id AS stf_staff_id,name FROM stf_staff  WHERE working_agency_id = ?  AND isPrincipal = 1",[$orgId]));
    }
    public function getStaffsName(Request $request){
        $staffs = DB::table('stf_staff')
            ->selectRaw('id AS stf_staff_id,name')
            ->whereIn('id',explode(",",$request['stf_staff_ids']))
            ->get();
        return $this->successResponse($staffs);
    }


}
