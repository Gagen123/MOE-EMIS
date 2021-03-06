<?php
namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\staff\TransferWindow;
use App\Models\staff\StaffHistory;
use App\Models\staff_services\StaffAppeal;
use App\Models\staff\PersonalDetails;
use App\Models\staff\TransferApplication;
use App\Models\staff\ApplicationSequence;
use App\Models\staff\TransPrefenreces;
use App\Models\staff\DocumentDetails;
use App\Models\staff_masters\TransferConfig;
use App\Models\staff_masters\TransferConfigDetails;

class TransferController extends Controller{
    use ApiResponser;
    public $database="staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function getcurrentTransferWindowDetails($id=""){
        return $id;
            // return $this->successResponse(TransferWindow::where('from_date','<=',date('Y-m-d'))->where('to_date','>=',date('Y-m-d'))->first());
            return $this->successResponse(TransferWindow::where('id',$id)->first());
    }

    public function submitIntialapplicantDetails(Request $request){
        $rules = [
            'name'                  =>  'required  ',
            'reason_id'             =>  'required',
        ];
        $customMessages = [
            'name.required'         => 'Please select applicant',
            'reason_id.required'    => 'Please select transfer reason',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'transfer_type_id'                  =>  $request->record_type_id,
            'transfer_window_id'                =>  $request->transferwindow_id,
            'applicant_name'                    =>  $request->name,
            'staff_id'                          =>  $request->staff_id,
            'transferType'                      =>  $request->transferType,
            'transfer_reason_id'                =>  $request->reason_id,
            'description'                       =>  $request->description,
            'status'                            =>  $request->status,
            'created_by'                        =>  $request->user_id,
            'user_dzo_id'                       =>  $request->user_dzo_id,
            'created_at'                        =>  date('Y-m-d h:i:s'),
        ];
        if($request->id=="" || $request->id==null){
            try{
            $response_data = TransferApplication::create($request_data);
            }
            catch(\Illuminate\Database\QueryException $ex){
                dd($ex);
            }

        }
        else{
            $act_det = TransferApplication::where ('id', $request->id)->first();
            $act_det->fill($request_data);
            $act_det->save();
            $response_data = TransferApplication::where ('id', $request->id)->first();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function getDraftDetails($user_id=""){
        $response_data=TransferApplication::where('created_by',$user_id)->where('status','pending')->first();
        return $this->successResponse($response_data);
    }


    public function submitFinalapplicantDetails(Request $request){
        $rules = [
            'transferType'              =>  'required  ',
        ];
        $customMessages = [
            'transferType.required'     => 'Please select this',
        ];
        $this->validate($request, $rules,$customMessages);

        $last_seq=ApplicationSequence::where('service_name','Transfer')->first();
        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Transfer',
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::where('service_name', 'Transfer')->update($app_details);
        }

        $application_no='TR-';
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
        $app_data=[
            'aplication_number'     =>  $application_no,
            'submitterroleid'       => $request->submitterroleid,
            'status'                =>  'Submitted'
        ];
        TransferApplication::where('id', $request->id)->update($app_data);
        if($request->preference_dzongkhag1!=""){
        $request_data =[
            'transfer_application_id'       =>  $request->id,
            'transfer_type_id'              =>  $request->record_type_id,
            'transferType'                  =>  $request->transferType,
            'dzongkhag_id'                  =>  $request->preference_dzongkhag1,
            'subject_id'                    =>  $request->spSubject,
            'preference'                    =>  1,
            'created_by'                    =>  $request->user_id,
            'created_at'                    =>  date('Y-m-d h:i:s'),
        ];
        TransPrefenreces::create($request_data);
    }
        if($request->preference_dzongkhag2!=""){
            $request_data =[
                'transfer_application_id'       =>  $request->id,
                'transfer_type_id'              =>  $request->record_type_id,
                'transferType'                  =>  $request->transferType,
                'dzongkhag_id'                  =>  $request->preference_dzongkhag2,
                'subject_id'                    =>  $request->optional1sub,
                'preference'                    =>  2,
                'created_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s'),
            ];

            TransPrefenreces::create($request_data);
        }
        if($request->preference_dzongkhag3!=""){
            $request_data =[
                'transfer_application_id'       =>  $request->id,
                'transfer_type_id'              =>  $request->record_type_id,
                'transferType'                  =>  $request->transferType,
                'dzongkhag_id'                  =>  $request->preference_dzongkhag3,
                'subject_id'                    =>  $request->optional2sub,
                'preference'                    =>  3,
                'created_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::create($request_data);
        }
        if($request->preference_school1!=""){
            $request_data =[
                'transfer_application_id'       =>  $request->id,
                'record_type_id'                =>  $request->record_type_id,
                'transferType'                  =>  $request->transferType,
                'dzongkhag_id'                  =>  $request->dzongkhag_id,
                'school_id'                     =>  $request->preference_school1,
                'subject_id'                    =>  $request->spSubject,
                'preference'                    =>  1,
                'created_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::create($request_data);
        }
        if($request->preference_school2!=""){
            $request_data =[
                'transfer_application_id'       =>  $request->id,
                'transfer_type_id'              =>  $request->record_type_id,
                'transferType'                  =>  $request->transferType,
                'dzongkhag_id'                  =>  $request->dzongkhag_id,
                'school_id'                     =>  $request->preference_school2,
                'subject_id'                    =>  $request->optional1sub,
                'preference'                    =>  2,
                'created_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::create($request_data);
        }
        if($request->preference_school3!=""){
            $request_data =[
                'transfer_application_id'       =>  $request->id,
                'transfer_type_id'              =>  $request->record_type_id,
                'transferType'                  =>  $request->transferType,
                'dzongkhag_id'                  =>  $request->dzongkhag_id,
                'school_id'                     =>  $request->preference_school3,
                'subject_id'                    =>  $request->optional2sub,
                'preference'                    =>  3,
                'created_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::create($request_data);
        }
        if($request->attachment_details!=null && $request->attachment_details!=""){
            foreach($request->attachment_details as $att){
                $doc_data =[
                    'parent_id'                        =>  $request->id,
                    'attachment_for'                   =>  'Transfer',
                    'path'                             =>  $att['path'],
                    'original_name'                    =>  $att['original_name'],
                    'user_defined_name'                =>  $att['user_defined_name'],
                ];
                $doc = DocumentDetails::create($doc_data);
            }
        }
        $response_data = TransferApplication::where ('id', $request->id)->first();
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }


    public function UpdatedApplicantDetails(Request $request){
        $request_data1 =[
            'description'                         =>  $request->description,
            'transfer_reason_id'                  =>  $request->reason_id,
            'withdrawn_remarks'                   =>  $request->remarks,
        ];
        TransferApplication::where('aplication_number', $request->application_number)->update($request_data1);
        $response_data = TransferApplication::where ('aplication_number', $request->application_number)->first();

        //updating the dzongkhag
        if($request->preference_dzongkhag1!=""){
            $request_data =[
                'dzongkhag_id'                  =>  $request->preference_dzongkhag1,
                'subject_id'                    =>  $request->spSubject,
                'preference'                    =>  1,
                'created_at'                    =>date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::where('transfer_application_id', $response_data->id)->where('preference',1)->update($request_data);
        }
        if($request->preference_dzongkhag2!=""){
                $request_data =[
                    'dzongkhag_id'                  =>  $request->preference_dzongkhag2,
                    'subject_id'                    =>  $request->optional1sub,
                    'preference'                    =>  2,
                    'created_at'                    =>date('Y-m-d h:i:s'),
                ];
            TransPrefenreces::where('transfer_application_id', $response_data->id)->where('preference',2)->update($request_data);
        }
        if($request->preference_dzongkhag3!=""){
                $request_data =[
                    'dzongkhag_id'                  =>  $request->preference_dzongkhag3,
                    'subject_id'                    =>  $request->optional2sub,
                    'preference'                    =>  3,
                    'created_at'                    =>date('Y-m-d h:i:s'),
                ];
            TransPrefenreces::where('transfer_application_id', $response_data->id)->where('preference',3)->update($request_data);
        }
        //updating the school details
        if($request->preference_school1!=""){
            $request_data =[
                'school_id'                     =>$request->preference_school1,
                'subject_id'                    =>  $request->spSubject,
                'preference'                    =>  1,
                'created_at'                    =>date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::where('transfer_application_id', $response_data->id)->where('preference',1)->update($request_data);
        }
        if($request->preference_school2!=""){
            $request_data =[

                'school_id'                     =>$request->preference_school2,
                'subject_id'                    =>  $request->optional2sub,
                'preference'                    =>  2,
                'created_at'                    =>date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::where('transfer_application_id', $response_data->id)->where('preference',2)->update($request_data);

        }
        if($request->preference_school3!=""){
            $request_data =[

                'school_id'                     =>  $request->preference_school3,
                'subject_id'                    =>  $request->optional2sub,
                'preference'                    =>  3,
                'created_at'                    =>date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::where('transfer_application_id', $response_data->id)->where('preference',3)->update($request_data);

        }
      //This is for the updating the withdraw status
         if($request->withdraw == "true"){
                $status =[
                    'status'        =>  'withdrawn'
                ];
                TransferApplication::where('aplication_number', $request->application_number)->update($status);

            }
            //updating the attachment
         if($request->attachment_details!=null && $request->attachment_details!=""){
            foreach($request->attachment_details as $att){
                $doc_data =[
                    'parent_id'                        =>  $request->id,
                    'attachment_for'                   =>  'Transfer',
                    'path'                             =>  $att['path'],
                    'original_name'                    =>  $att['original_name'],
                    'user_defined_name'                =>  $att['user_defined_name'],
                ];
                $response_data=DocumentDetails::create($doc_data);
            }
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    public function getIntialAppointmentDate($cid){
        $response_data=DB::table('stf_staff AS t')
        ->select('t.initial_appointment_date')
        ->where('t.cid_work_permit',$cid)
        ->get();
        return $response_data;
    }
    public function loadtrainsferDetails($appNo=""){
        $response_data=TransferApplication::where('aplication_number',$appNo)->first();
        if($response_data!="" && $response_data!=null){
            $response_data->documents=DocumentDetails::where('parent_id',$response_data->id)->get();
        }
        $response_data->preferences=TransPrefenreces::where('transfer_application_id',$response_data->id)->get();
            return $this->successResponse($response_data);
        }
    public function loadTransferAppealDetail($appNo){
        $response_data=DB::table('staff_appeals AS t1')
        ->select('t1.transferType','t1.name','t1.application_no','t1.description','t1.status','t1.remarks','t1.created_at')
        ->where('t1.application_no',$appNo)
        ->get();
        return $response_data;
    }

    public function loadAppealattachementDetails($appNo=""){
        $response_data=StaffAppeal::where('application_no',$appNo)->first();
        if($response_data!="" && $response_data!=null){
            $response_data->documents=DocumentDetails::where('parent_id',$response_data->id)->get();
        }
        // $response_data->preferences=TransPrefenreces::where('transfer_application_id',$response_data->id)->get();
                return $this->successResponse($response_data);
        }

    public function updateTransferApplication(Request $request){
            $extra_data =[
                'id'                           =>  $request->id,
                'status'                       =>  $request->status,
                'status_id'                    =>  $request->status_id,
                'dzongkhagApproved'            =>  $request->dzongkhagApproved,
                'preference_school'            =>  $request->preference_school,
                'updated_by'                   =>  $request->user_id,
                'updated_at'                   =>  date('Y-m-d h:i:s'),
                'aplication_number'            =>  $request->application_number,
            ];
            $response_data=TransferApplication::where('id', $request->id)->update($extra_data);
            return $response_data;
    }
    public function getTransferConfigDetails($role_ids=""){
        $result_data="";
        if(strpos( $role_ids,',')){
            $role_ids=explode(',',$role_ids);
            $roles="";
            foreach($role_ids as $role){
                $roles.="'$role',";
            }
            $roles=rtrim($roles,',');
            $result_data="SELECT l.transfer_type_id,l.submitter_role_id,d.role_id,d.sequence,d.authority_type_id FROM master_staff_transfer_config l
            LEFT JOIN master_staff_transfer_config_details d ON l.id=d.transfer_config_id
            WHERE d.role_id IN(".$roles.")";
        }

        else if(strpos( $role_ids,'__')){
            $role_ids=explode('__',$role_ids);
            $roles="";
            foreach($role_ids as $role){
                $roles.="'$role'__";
            }
            $roles=rtrim($roles,'__');
            $result_data="SELECT l.transfer_type_id,l.submitter_role_id,d.role_id,d.sequence,d.authority_type_id FROM master_staff_transfer_config l
            LEFT JOIN master_staff_transfer_config_details d ON l.id=d.transfer_config_id;
            WHERE d.sequence IN(".$roles.")";
        }

        else{
            $result_data="SELECT l.transfer_type_id,l.submitter_role_id,d.role_id,d.sequence,d.authority_type_id FROM master_staff_transfer_config l
            LEFT JOIN master_staff_transfer_config_details d ON l.id=d.transfer_config_id
            WHERE d.role_id ='".$role_ids."'";
        }

        return DB::select($result_data);
    }

    public function getAppVeriTransferConfigDetails($transfer_type_id="",$app_role_id="",$role_id=""){
        $response_data=TransferConfig::with('transferDetails')->where('transfer_type_id',$transfer_type_id)->where('submitter_role_id',$app_role_id)
        ->select('id','transfer_type_id')->first();

        if($response_data!=null && $response_data!=""){
            //done for single role onle
            if(strpos( $role_id,',')){
                $role_ids=explode(',',$role_id);
                $currenttransferConfigDetails=TransferConfigDetails::where('transfer_config_id',$response_data->id)->wherein('role_id',$role_ids)
                ->select('sequence')->first();
            }
            else{
                $currenttransferConfigDetails=TransferConfigDetails::where('transfer_config_id',$response_data->id)->where('role_id',$role_id)
                ->select('sequence')->first();
            }

            $nxtTransferConfigDetails= TransferConfigDetails::where('transfer_config_id',$response_data->id)->where('sequence',$currenttransferConfigDetails->sequence+1)
            ->select('id','sequence','authority_type_id','role_id')->first();
            if($response_data!=null && $response_data!=""){
                return $nxtTransferConfigDetails;
            }else{
                return null;
            }
        }
        else{
            return null;
        }
    }
    public function saveTransferWindow(Request $request){
        $response_data=[];
        $rules = [
            'from_date'                         =>  'required',
            'to_date'                           =>  'required | date | after:from_date',
        ];
        $customMessages = [
            'from_date.required'                => 'Please select from date',
            'to_date.required'                  => 'Please select to date',
        ];
        if($request->action_type=="add"){
            $rules=array_merge($rules,
                array(
                'year'                              =>  'required |unique:stf_transfer_window',)
            );
            $customMessages=array_merge($customMessages,
                array(
                    'year.required'                     => 'Current Year is required',
                    'year.unique'                       => 'Current Year is already recorded',
                )
            );
        }
        $this->validate($request, $rules,$customMessages);

        $data =[
            'year'                              =>  $request->year,
            'from_date'                         =>  $request->from_date,
            'to_date'                           =>  $request->to_date,
            'remarks'                           =>  $request->remarks,
            'status'                            =>  $request->status,
        ];
        if($request->action_type=="add"){
            $data=array_merge($data,
                array('created_by'            =>  $request->user_id,
                      'created_at'            =>  date('Y-m-d h:i:s')
                )
            );
            $response_data = TransferWindow::create($data);
        }
        else if($request->action_type=="edit"){
            $data=array_merge($data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
            $act_det = TransferWindow::where ('id', $request->id)->firstOrFail();
            $act_det->fill($data);
            $response_data=$act_det->save();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    public function reportingTransfer($type= "",$dzoId=""){
        if(strpos($type,"__")!==false){
            $response_data=TransferApplication::where ('dzongkhagApproved', $dzoId)->where('status',explode('__',$type)[0])->orwhere('status',explode('__',$type)[1])->get();
         return$response_data;

        }
    }
    public function loadtransferDetails($type= "",$userId="",$dzoId=""){
        if($type=="Dzongkhag"){
            $response_data=TransferApplication::where ('user_dzo_id',$dzoId)->whereIn('status',['Approved','Rejected'])->get();
        }
        else if($type=="Ministry"){
            $response_data=TransferApplication::whereIn('status',['Approved','Rejected'])->get();
        }
        else if($type=="intra_transfer") {
            $response_data=TransferApplication::where('transferType','Intra Transfer')->where('created_by',$userId)->get();
        }
        else if($type=="inter_transfer") {
            $response_data=TransferApplication::where('transferType','Inter Transfer')->where('created_by',$userId)->get();
        }
        else{
            $response_data=TransferApplication::where('created_by',$userId)->get();
        }
         return $response_data;
    }

    public function loadApplicationDetails($id=""){
        $response_data=TransferApplication::where ('id', $id)->first();
        return$response_data;
   }

   public function LoadTransferAppealDetails($user_id=""){
    $response_data=StaffAppeal::where ('user_id', $user_id)->get();
    return$response_data;
}
   public function getapplicatName($id=""){
        $response_data=PersonalDetails::where ('id', $id)->first();
        return$response_data;
    }

    public function getSubmitterId($type_id="",$role_id=""){
        $response_data=TransferConfig::where('transfer_type_id',$type_id)->where('submitter_role_id',$role_id)
        ->select('submitter_role_id')->first();
        return $response_data;
    }

    public function getTransferTypeName($type_id){
        // return $type_id;
        $response_data=DB::table('master_transfer_type AS t')
        ->select('t.name AS transferType')
        ->where('t.id',$type_id)
        ->get();
        return $response_data;

    }
    public function checkEligibilityForTransfer($type_id="",$role_id=""){
        $response_data="";
        if(strpos($role_id,',')){
            $role_id=explode(',',$role_id);
            $response_data=TransferConfig::where('transfer_type_id',$type_id)->where('submitter_role_id',$role_id)
                ->select('id','transfer_type_id')->first();

        }
        else{
            $response_data=TransferConfig::where('transfer_type_id',$type_id)->where('submitter_role_id',$role_id)
                ->select('id','transfer_type_id')->first();
        }
        if($response_data!=null && $response_data!=""){
            $det=DB::table('master_staff_transfer_config_details')
            ->where('transfer_config_id',$response_data->id)
            ->get();
            $submitted_to='NA';
            if($det!=null && $det!="" && sizeof($det)>0){
                $count = 0;
                $cong_seq=0;
                foreach($det as $d){
                    $count++;
                    if($count==1){
                        $cong_seq=$d->sequence;
                        $submitted_to=$d->role_id;
                    }
                    if($d->sequence<$cong_seq){
                        $cong_seq=$d->sequence;
                        $submitted_to=$d->role_id;
                    }
                }
            }

            $response_data->submitted_to=$submitted_to;

        }
        else{
            return null;
        }
        return $this->successResponse($response_data->submitted_to);
    }

    public function getNextApprovalRoleIdForTransfer($type_id="",$submitterRoleId="",$currentRoleId=""){
        $response_data=DB::table('master_staff_transfer_config AS t')
        ->where('t.transfer_type_id',$type_id)->where('t.submitter_role_id',$submitterRoleId)
        ->get();
        if($response_data!=null && $response_data!=""){
            if(strpos( $currentRoleId,',')){
                $role_ids=explode(',',$currentRoleId);
                $currentTransferConfigDetails=DB::table('master_staff_transfer_config_details AS t1')
                ->where('t1.transfer_config_id',$response_data[0]->id)
                ->wherein('t1.role_id', $role_ids)
                ->select('t1.sequence')
                ->get();
            }
            else{
                $currentTransferConfigDetails=DB::table('master_staff_transfer_config_details AS t1')
                ->where('t1.transfer_config_id',$response_data[0]->id)
                ->where('t1.role_id',$currentRoleId)
                ->select('t1.sequence')
                ->get();
            }

            $nextTransferConfigDetails=DB::table('master_staff_transfer_config_details AS t1')
            ->where('t1.transfer_config_id',$response_data[0]->id)
            ->where('t1.sequence',$currentTransferConfigDetails[0]->sequence+1)
            ->select('t1.id','t1.sequence','t1.authority_type_id','t1.role_id')
            ->get();
            if($response_data!=null && $response_data!=""){
                return $nextTransferConfigDetails;
            }else{
                return null;
            }
        }
        else{
            return null;
        }

    }

    public function LoadApplicationDetailsByUserId($param="",$user_id=""){
        $response_data=TransferApplication::where('created_by', $user_id)->Where('status',$param)->orWhere('status','Rejected')->orWhere('status','Verified')->orWhere('status','Assigned School')->orWhere('status','Submitted')->get();;
        return $response_data;
    }

    public function loadPreference($id=""){
        $response_data=TransPrefenreces::where ('transfer_application_id', $id)->get();
        return$response_data;
    }

    public function SaveTransferAppeal(Request $request){
     if($request->id==""){
        $last_seq=ApplicationSequence::where('service_name','transfer appeal')->first();
        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'transfer appeal',
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::where('service_name', 'transfer appeal')->update($app_details);
        }
        $application_no='TRA-';
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
        $request_data =[
            'id'                                =>  $request->id,
            'record_type_id'                    =>  $request->record_type_id,
            'transferType'                      =>  $request->transferType,
            'name'                              =>  $request->name,
            'aplication_number'                 =>  $request->aplication_number,
            'application_no'                    =>  $application_no,
            'description'                       =>  $request->description,
            'user_id'                           =>  $request->user_id,
            'status'                            =>  $request->status,
            'status_id'                         => '1',
            'org_id'                            =>  $request->working_agency_id,
        ];
        $response_data=TransferApplication::where('created_by',$request->user_id)->where('aplication_number',$request->aplication_number)->first();
        if($response_data!=null || $response_data!=""){
            if($response_data->status=="Rejected" || $response_data->status=="Submitted" || $response_data->status=="Approved" || $response_data->status=="Verified" || $response_data->status=="Assigned School"){
                $response_data = StaffAppeal::create($request_data);
            }
        }
        if($request->attachment_details!=null && $request->attachment_details!=""){
            foreach($request->attachment_details as $att){
                $doc_data =[
                    'parent_id'                        =>  $response_data->id,
                    'attachment_for'                   =>  'Transfer Appeal',
                    'path'                             =>  $att['path'],
                    'original_name'                    =>  $att['original_name'],
                    'user_defined_name'                =>  $att['user_defined_name'],
                ];
                $response_data = DocumentDetails::create($doc_data);
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    else{
        $response_data=TransferApplication::where('created_by',$request->user_id)->where('aplication_number',$request->aplication_number)->first();
        if($request->attachment_details!=null && $request->attachment_details!=""){
            foreach($request->attachment_details as $att){
                $doc_data =[
                    'parent_id'                        =>  $response_data->id,
                    'attachment_for'                   =>  'Transfer Appeal',
                    'path'                             =>  $att['path'],
                    'original_name'                    =>  $att['original_name'],
                    'user_defined_name'                =>  $att['user_defined_name'],
                ];
                $response_data = DocumentDetails::create($doc_data);
            }
        }
        if($request->withdraw =="true"){
            $status =[
                'status'                            =>  'withdrawn',
                'updated_at'                        =>  date('Y-m-d h:i:s'),
                'remarks'                           =>  $request->remarks,
            ];
            $response_data=StaffAppeal::where('id', $request->id)->update($status);
        }
        else{
            $request_data=[
            'id'                                =>  $request->id,
            'updated_at'                        =>  date('Y-m-d h:i:s'),
            'remarks'                           =>  $request->remarks,
            'record_type_id'                    =>  $request->record_type_id,
            'transferType'                      =>  $request->transferType,
            'description'                       =>  $request->description,
        ];
            $response_data=StaffAppeal::where('id', $request->id)->update($request_data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);

    }
  }
  public function UpdateTransferAppeal(Request $request){
    $request_data =[
        'remarks'                               => $request->remarks,
        'status'                                => 'Verfied',
        'status_id'                             =>  $request->status_id,
    ];
    $response_data=StaffAppeal::where('application_no', $request->aplication_number)->update($request_data);
    return $this->successResponse($response_data, Response::HTTP_CREATED);

  }
  

}
