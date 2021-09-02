<?php

namespace App\Http\Controllers\organizationApproval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\ApplicationSequence;
use App\Models\DepartmentModel;
use App\Models\establishment\ApplicationAttachments;
use App\Models\establishment\ApplicationClassStream;
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationEstDetailsChange;
use App\Models\establishment\ApplicationEstPrivate;
use App\Models\establishment\ApplicationEstPublic;
use App\Models\establishment\ApplicationNoMeals;
use App\Models\establishment\ApplicationVerification;
use App\Models\establishment\ApplicationVerificationTeam;
use App\Models\establishment\HeadQuaterDetails;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\Masters\ProposedBy;
use App\Models\OrganizationDetails;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrganizationApprovalController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveEstablishment(Request $request){
        $rules = [
            'proposedName'          =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
            'parentSchool'          =>  'required',
            'locationType'         =>  'required',
        ];
        $customMessages = [
            'proposedName.required'         => 'Proposed Name is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            'parentSchool.required'         => 'Parent school is required',
            'locationType.required'        => 'locationType is required',
        ];

        if($request->establishment_type=="Coorporate ECCD"){
            $rules =$rules+ [
                'parentAgency'          =>  'required',
            ];
            $customMessages = $customMessages+[
                'parentAgency.required'         => 'Parent agency is required',
            ];
        }
        if($request->establishment_type=="Public ECCD" || $request->establishment_type=="NGO ECCD"){
            $rules =$rules+ [
                'initiatedBy'          =>  'required',
            ];
            $customMessages = $customMessages+[
                'initiatedBy.required'         => 'Proposed initiated by is required',
            ];
        }
        if($request->establishment_type=="Private ECCD"){
            $rules =$rules+ [
                'proprietorCid'         =>  'required',
                'proprietorName'         =>  'required',
                'proprietorMobile'         =>  'required',
            ];
            $customMessages = $customMessages+[
                'proprietorCid.required'        => 'CID is required',
                'proprietorName.required'        => 'Name is required',
                'proprietorMobile.required'        => 'Mobile number is required',
            ];
        }
        $this->validate($request, $rules, $customMessages);

        //Created application detials for all application type
        $application_details_data = $this->createApplicationDetail($request,'New Establishment');
        if(strpos($request->establishment_type,'Private')!==false){
            $app_Details=ApplicationEstPrivate::where('ApplicationDetailsId',$application_details_data->id)->first();
        }else{
            $app_Details=ApplicationEstPublic::where('ApplicationDetailsId',$application_details_data->id)->first();
        }
        //updated as record is already created by logined users
        if($app_Details!=null && $app_Details!=""){
            if(strpos($request->establishment_type,'ECCD')!==false){
                $_udpate =[
                    'proposedName'                 =>  $request['proposedName'],
                    'coLocatedParent'              =>  $request['coLocatedParent'],
                    'parentSchool'                 =>  $request['parentSchool'],
                ];
                if($request->establishment_type=="Coorporate ECCD"){
                    $_udpate = $_udpate+[
                        'parentAgency'                 =>  $request['parentAgency'],
                        'locationId'                 =>  $request['locationType'],
                    ];
                }
                if($request->establishment_type=="Public ECCD" || $request->establishment_type=="NGO ECCD"){
                    $_udpate = $_udpate+[
                        'initiated_by'               =>  $request['initiatedBy'],
                        'locationId'                 =>  $request['locationType'],
                    ];
                }
                if($request->establishment_type=="Private ECCD"){
                    $_udpate = $_udpate+[
                        'proposedLocation'           =>  $request['locationType'],
                        'proprietorName'             =>  $request['proprietorName'],
                        'proprietorCid'              =>  $request['proprietorCid'],
                        'proprietorPhone'            =>  $request['proprietorPhone'],
                        'proprietorMobile'           =>  $request['proprietorMobile'],
                        'proprietorEmail'            =>  $request['proprietorEmail'],
                    ];
                    ApplicationEstPrivate::where('ApplicationDetailsId',$application_details_data->id)->update($_udpate);
                }else{
                    ApplicationEstPublic::where('ApplicationDetailsId',$application_details_data->id)->update($_udpate);
                }
            }
        }else{
            if(strpos($request->establishment_type,'ECCD')!==false){
                $data =[
                    'ApplicationDetailsId'         =>  $application_details_data->id,
                    'proposedName'                 =>  $request['proposedName'],
                    'coLocatedParent'              =>  $request['coLocatedParent'],
                    'parentSchool'                 =>  $request['parentSchool'],
                    'created_by'                   =>  $request->user_id,
                    'created_at'                   =>  date('Y-m-d h:i:s')
                ];
                if($request->establishment_type=="Coorporate ECCD"){
                    $data = $data+[
                        'parentAgency'                 =>  $request['parentAgency'],
                        'locationId'                   =>  $request['locationType'],
                    ];
                }
                if($request->establishment_type=="Public ECCD" || $request->establishment_type=="NGO ECCD"){
                    $data = $data+[
                        'initiated_by'               =>  $request['initiatedBy'],
                        'locationId'                   =>  $request['locationType'],
                    ];
                }

                if($request->establishment_type=="Private ECCD"){
                    $data = $data+[
                        'proposedLocation'           =>  $request['locationType'],
                        'proprietorName'             =>  $request['proprietorName'],
                        'proprietorCid'              =>  $request['proprietorCid'],
                        'proprietorPhone'            =>  $request['proprietorPhone'],
                        'proprietorMobile'           =>  $request['proprietorMobile'],
                        'proprietorEmail'            =>  $request['proprietorEmail'],
                    ];
                    ApplicationEstPrivate::create($data);
                }else{
                    ApplicationEstPublic::create($data);
                }
            }
        }
        return $application_details_data;
    }

    private function createApplicationDetail($request,$service=""){
        $year=date('Y');
        if(isset($request['year'])){
            $year=$request['year'];
        }
        $data =[
            'establishment_type'   =>  $request['establishment_type'],
            'category'             =>  $request['category'],
            'dzongkhagId'          =>  $request['dzongkhag'],
            'gewogId'              =>  $request['gewog'],
            'chiwogId'             =>  $request['chiwog'],
            'application_type'     =>  $request['application_type'],
            'year'                 =>  $year,
            'status'               =>  $request['status'],
            'remarks'              =>  $request['remarks'],
        ];
        $app_Details=ApplicationDetails::where('created_by',$request->user_id)->where('status','pending')->first();
        //updated as record is already created by logined users
        if($app_Details!=null && $app_Details!=""){
            ApplicationDetails::where('created_by',$request->user_id)->where('status','pending')->update($data);
            $inserted_application_data = ApplicationDetails::where('created_by',$request->user_id)->where('status','pending')->first();
        }else{
            if($request['app_id']!=null && $request['app_id']!="null" || $request['app_id']!=""){
                ApplicationDetails::where('id',$request['app_id'])->update($data);
                $inserted_application_data = ApplicationDetails::where('id',$request['app_id'])->first();
            }
            else{
                $data =$data+[
                    'application_no'       =>  $this->generateApplicationNo($service),
                    'created_by'           =>  $request->user_id,
                    'created_at'           =>  date('Y-m-d h:i:s')
                ];
                $inserted_application_data = ApplicationDetails::create($data);
            }
        }
        return $inserted_application_data;
    }
    private function generateApplicationNo($serviceName=""){
        $last_seq=ApplicationSequence::where('service_name',$serviceName)->first();
        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  $serviceName,
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::where('service_name', $serviceName)->update($app_details);
        }
        $application_no='Estb-';
        if(strpos($serviceName,'Location')!==false){
            $application_no='LC-';
        }
        if(strlen($last_seq)==1){
            $application_no= $application_no.date('Y').date('m').'-000'.$last_seq;
        }
        else if(strlen($last_seq)==2){
            $application_no= $application_no.date('Y').date('m').'-00'.$last_seq;
        }
        else if(strlen($last_seq)==3){
            $application_no= $application_no.date('Y').date('m').'-0'.$last_seq;
        }
        else if(strlen($last_seq)==4){
            $application_no= $application_no.date('Y').date('m').'-'.$last_seq;
        }
        return $application_no;
    }

    public function saveClassStream(Request $request){
        $classStream='';
        $application_details= ApplicationDetails::where('application_no', $request->application_number)->first();
        ApplicationClassStream::where('ApplicationDetailsId', $application_details->id)->delete();
        if($request->class){
            foreach($request->class as $key => $classId){
                $classStream = [
                    'foreignKeyFor'         => 'application_details',
                    'ApplicationDetailsId'  => $application_details->id,
                    'classId'               => $classId,
                ];
                ApplicationClassStream::create($classStream);
            }
        }
        if($request->stream!=null && $request->stream!=""){
            foreach($request->stream as $key2 => $classStreamId){
                $class_stream_data = $this->getClassStreamId($classStreamId);
                foreach($class_stream_data as $v){
                    $classStream = [
                        'foreignKeyFor'         => 'application_details',
                        'ApplicationDetailsId'  => $application_details->id,
                        'classId'               => $v->classId,
                        'streamId'              => $v->streamId,
                    ];
                    ApplicationClassStream::create($classStream);
                }
            }
        }
        $application_details= ApplicationDetails::where('application_no', $request->application_number)->first();
        return $this->successResponse($application_details, Response::HTTP_CREATED);
    }

    /**
     * Get class and stream id based on id
     */
    private function getClassStreamId($id){
        $data = DB::table('class_stream_mappings')
            ->select('classId', 'streamId')
            ->where('id', $id)
            ->get()
            ->toArray();
        return $data;
    }

    public function saveUploadedFiles(Request $request){
        $doc="";
        if($request->attachment_details!=null && $request->attachment_details!=""){
            $application_details=  ApplicationDetails::where('application_no',$request['application_number'])->first();
            foreach($request->attachment_details as $att){
                $attach =[
                    'ApplicationDetailsId'      =>  $application_details->id,
                    'path'                      =>  $att['path'],
                    'user_defined_file_name'    =>  $att['user_defined_name'],
                    'name'                      =>  $att['original_name'],
                    'updoad_type'               =>  'Applicant',
                ];
                $doc = ApplicationAttachments::create($attach);
            }
        }
        if(isset($request['update_type']) && $request['update_type']=="Document Update"){
            $array =[
                'status'                       =>   "Document Updated",
                'remarks'                      =>   $request->remarks,
                'updated_by'                   =>   $request->user_id,
                'updated_at'                   =>   date('Y-m-d h:i:s'),
            ];
            ApplicationDetails::where('application_no', $request->application_number)->update($array);
            $application_details=  ApplicationDetails::where('application_no',$request['application_number'])->first();
        }
        else{
            $array =[
                'status'                       =>   $request->status,
                'applicant_remarks'            =>   $request->remarks,
            ];
            DB::table('application_details')->where('application_no',$request->application_number)->update($array);
            $application_details=  ApplicationDetails::where('application_no',$request['application_number'])->first();
        }
        return $application_details;
    }

    public function loadOrgApplications($user_id="",$type=""){
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('status','<>','pending')->where('establishment_type','like', "%".$type."%")->get());
    }

    public function loadEstbDetailsForVerification($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        $response_data->application_date=date_format(Carbon::parse($response_data->action_date), 'Y-m-d h:i:s');
        $response_data->attachments=ApplicationAttachments::orderBy('created_at','ASC')->where('ApplicationDetailsId',$response_data->id)->get();
        if(strpos($appNo,'LC')===false){
            if($response_data->establishment_type=="Public School" || $response_data->establishment_type=="Public ECCD" || $response_data->establishment_type=="Coorporate ECCD" || $response_data->establishment_type=="NGO ECCD" || $response_data->establishment_type=="Public ECR" ){
                $app_details=ApplicationEstPublic::where('ApplicationDetailsId',$response_data->id)->first();
            }
            if($response_data->establishment_type=="Private School" || $response_data->establishment_type=="Private ECCD"){
                $app_details=ApplicationEstPrivate::where('ApplicationDetailsId',$response_data->id)->first();
            }
            if($app_details->parentSchool!=""){
                $org=OrganizationDetails::where('id',$app_details->parentSchool)->first();
                if($org!=null && $org!=""){
                    $response_data->parent_school=$org->name;
                    if($org->levelId!=null && $org->levelId!=""){
                        $level=Level::where('id',$org->levelId)->first();
                        if($level!=null && $level!=""){
                            $response_data->parent_school=$org->name.' '.$level->name;
                        }
                    }
                }
            }
            if($app_details->locationId!=""){
                $loc=Location::where('id',$app_details->locationId)->first();
                if($loc!=null && $loc!=""){
                    $response_data->location_type=$loc->name;
                }
            }
            if($app_details->initiated_by!=""){
                $proposed=ProposedBy::where('id',$app_details->initiated_by)->first();
                if($proposed!=null && $proposed!=""){
                    $response_data->proposed_initiated=$proposed->name;
                }
            }
            $response_data->org_details=$app_details;
            if(isset($app_details->isFeedingSchool) && $app_details->isFeedingSchool==1){
                $response_data->feeding_modality=ApplicationNoMeals::where('foreignKeyId',$app_details->id)->get();
            }

            $response_data->org_class_stream=
                DB::table('application_class_stream')
                    ->join('classes', 'classes.id', '=', 'application_class_stream.classId')
                    ->select('application_class_stream.*','classes.class')
                    ->where('application_class_stream.ApplicationDetailsId',$response_data->id)
                    ->orderBy('classes.displayOrder')
                    ->get();

            $ver=ApplicationVerification::where('ApplicationDetailsId',$response_data->id)->get();
            if($ver!=null && $ver!="" && sizeof($ver)>0){
                foreach($ver as $v){
                    $department=DepartmentModel::where('id',$v->department_id)->first();
                    if($department!=null && $department!=""){
                        $v->department_name=$department->name;
                    }
                    $division=HeadQuaterDetails::where('id',$v->verifyingAgency)->first();
                    if($division!=null && $division!=""){
                        $v->division_name=$division->agencyName;
                    }
                }
            }
            $response_data->app_verification=$ver;
            if($response_data!=null && $response_data!=""){
                $response_data->app_verification_team=ApplicationVerificationTeam::where('ApplicationVerificationId',$response_data->id)->get();
            }
        }else{ //loading for location change data
            $change_details=ApplicationEstDetailsChange::where('ApplicationDetailsId',$response_data->id)->first();
            if($change_details!=null && $change_details!=""){
                $loc=Location::where('id',$change_details->proposedLocation)->first();
                if($loc!=null && $loc!=""){
                    $response_data->app_location_type=$loc->name;
                }
                $orgDetails=OrganizationDetails::where('id',$change_details->organizationId)->first();
                $response_data->orgDetails=$orgDetails;
                if($orgDetails->parentSchool!=""){
                    $org=OrganizationDetails::where('id',$orgDetails->parentSchool)->first();
                    if($org!=null && $org!=""){
                        $response_data->parent_school=$org->name;
                        if($org->levelId!=null && $org->levelId!=""){
                            $level=Level::where('id',$org->levelId)->first();
                            if($level!=null && $level!=""){
                                $response_data->parent_school=$org->name.' '.$level->name;
                            }
                        }
                    }
                }
                if($orgDetails->locationId!=""){
                    $loc=Location::where('id',$orgDetails->locationId)->first();
                    if($loc!=null && $loc!=""){
                        $response_data->location_type=$loc->name;
                    }
                }
            }
        }
        return $this->successResponse($response_data);
    }

    public function updateNewEstablishmentApplication(Request $request){
        if($request->attachment_details!="" ){
            if(sizeof($request->attachment_details)>0){
                $application_details=  ApplicationDetails::where('application_no',$request->application_number)->first();
                foreach($request->attachment_details as $att){
                    $attach =[
                        'ApplicationDetailsId'      =>  $application_details->id,
                        'path'                      =>  $att['path'],
                        'user_defined_file_name'    =>  $att['user_defined_name'],
                        'name'                      =>  $att['original_name'],
                        'created_by'                =>  $request->user_id,
                        'created_at'                =>  date('Y-m-d h:i:s'),
                        'upload_type'               =>  $request->update_type,
                    ];
                    $doc = ApplicationAttachments::create($attach);
                }
            }
        }
        $status=$request->status;
        if($request->update_type=="Notify_for_Tentative_Date_of_Feasibility_Study"){
            if($request->verifying_agency_list!=null && $request->verifying_agency_list!="" && sizeof($request->verifying_agency_list)>0){
                foreach($request->verifying_agency_list as $dept){
                    $verification =[
                        'type'                        =>   'Initial_Assessment',
                        'ApplicationDetailsId'        =>   $request->id,
                        'department_id'               =>   $dept['department'],
                        'verifyingAgency'             =>   $dept['division'],
                        'tentativeDate'               =>   $request->tentative_date,
                        'remarks'                     =>   $request->remarks,
                        'created_by'                  =>   $request->user_id,
                        'created_by'                  =>   date('Y-m-d h:i:s'),
                    ];
                    $establishment=ApplicationVerification::create($verification);
                }
            }
        }

        if($request->update_type=="Notify_for_Tentative_Date_of_Final_Feasibility_Study"){
            if($request->final_verifying_agency_list!=null && $request->final_verifying_agency_list!="" && sizeof($request->final_verifying_agency_list)>0){
                foreach($request->final_verifying_agency_list as $dept){
                    $verification =[
                        'type'                        =>   'Final_Assessment',
                        'ApplicationDetailsId'        =>   $request->id,
                        'department_id'               =>   $dept['department'],
                        'verifyingAgency'             =>   $dept['division'],
                        'tentativeDate'               =>   $request->final_tentative_date,
                        'remarks'                     =>   $request->remarks,
                        'created_by'                  =>   $request->user_id,
                        'created_by'                  =>   date('Y-m-d h:i:s'),
                    ];
                    $establishment=ApplicationVerification::create($verification);
                }
            }
        }

        $estd =[
            'status'                       =>   $status,
            'updated_by'                   =>   $request->user_id,
            'updated_at'                   =>   date('Y-m-d h:i:s'),
        ];
        if($request->update_type=="Notify_for_Tentative_Date_of_Feasibility_Study"){
            $estd =$estd+[
                'remarks'                      =>   $request->remarks,
            ];
        }
        if($request->update_type=="document_update"){
            $estd =$estd+[
                'document_update_remarks'  =>   $request->remarks,
            ];
        }
        if($request->update_type=="approval_in_principal"){
            $estd =$estd+[
                'approval_in_principal_remarks'  =>   $request->remarks,
            ];
        }
        if($request->update_type=="approval_in_principal_confirm"){
            $estd =$estd+[
                'approval_in_principal_confirm'  =>   $request->remarks,
            ];
        }


        $establishment = ApplicationDetails::where('application_no', $request->application_number)->update($estd);
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    public function updateTeamVerification(Request $request){
        $verification =[
            'ApplicationVerificationId'     => $request->id,
            'type'                          => $request->type,
            'agency'                        => $request['org_id'],
            'teamMember'                    => $request['staff_id'],
            'name'                          => $request['name'],
            'cid'                           => $request['cid'],
            'email'                         => $request['email'],
            'applicationNo'                 => $request['applicationNo'],
            'created_at'                    => date('Y-m-d h:i:s'),
            'created_by'                    => $request->user_id,
        ];
        $establishment=ApplicationVerificationTeam::create($verification);
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    public function loadTeamVerificationList($id=""){
        $response_data= ApplicationVerificationTeam::where('ApplicationVerificationId',$id)->get();
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function saveLocationChange(Request $request){
        $rules = [
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
            'locationType'         =>  'required',
        ];
        $customMessages = [
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            'locationType.required'        => 'locationType is required',
        ];
        $this->validate($request, $rules, $customMessages);

        //Created application detials for all application type
        $application_details_data = $this->createApplicationDetail($request,'Location Change');
        $data =[
            'ApplicationDetailsId'      =>  $application_details_data->id,
            'organizationId'            =>  $request->organizationId,
            'proposedLocation'          =>  $request['locationType'],
            'change_type'               =>  'Location',
            'proposedChange'            =>  'Change in Location',
        ];
        ApplicationEstDetailsChange::create($data);
        return $application_details_data;
    }


}
