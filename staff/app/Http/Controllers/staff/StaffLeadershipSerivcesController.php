<?php

namespace App\Http\Controllers\staff;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\staff\DocumentDetails;
use App\Models\staff_leadership\ApplicableApplicant;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff_leadership\LeadershipDetails;
use App\Models\staff_leadership\NominationDetails;
use App\Models\staff_leadership\FeedbackProviderDetails;
use App\Models\staff_leadership\RequiredAttachment;
use App\Models\staff\ApplicationSequence;
use App\Models\staff\Nomination;
use App\Models\staff\PersonalDetails;
use Illuminate\Support\Facades\DB;
use App\Models\staff_leadership\LeadershipApplication;

class StaffLeadershipSerivcesController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function createPost(Request $request){
        $response_data=[];
        $data =[
            'selection_type'                =>  $request->selection_type,
            'position_title'                =>  $request->position_title,
            'from_date'                     =>  $request->from_date,
            'to_date'                       =>  $request->to_date,
            'feedback'                      =>  $request->feedback,
            'interview'                     =>  $request->interview,
            'shortlist'                     =>  $request->shortlist,
            'details'                       =>  $request->details,
        ];
        if($request->id==""){
            $rules = [
                'selection_type'    =>  'required',
                'position_title'    =>  'required',
                'feedback'          =>  'required',
                'interview'         =>  'required',
                'shortlist'         =>  'required',
                'details'           =>  'required',
                'from_date'         =>  'required | date',
                'to_date'           =>  'required | date | after:from_date',
            ];
            $customMessages = [
                'selection_type.required'   => 'This field is required',
                'position_title.required'   => 'This field is required',
                'feedback.required'         => 'This field is required',
                'interview.required'        => 'This field is required',
                'shortlist.required'        => 'This field is required',
                'details.required'          => 'This field is required',
                'from_date.required'        => 'This field is required',
                'to_date.required'          => 'This field is required',
                'to_date.after'             => 'This field cannot be before start date',
            ];
            $this->validate($request, $rules,$customMessages);
            $data=array_merge($data,
                array('status'              =>  $request->action_type,
                    'created_by'            =>  $request->user_id,
                    'created_at'            =>  date('Y-m-d h:i:s')
                )
            );
            $response_data = LeadershipDetails::create($data);
            if($request->document_List!=null && $request->document_List!="null" && $request->document_List!="" && sizeof($request->document_List)>0){
                foreach($request->document_List as $doc){
                    $doc_data =[
                        'leadership_id'            =>  $response_data->id,
                        'attachment'               =>  $doc['document']
                    ];
                    RequiredAttachment::create($doc_data);
                }
            }

            foreach($request->applicant_List as $app){
                $app_data =[
                    'leadership_id'             =>  $response_data->id,
                    'role_id'                   =>  $app['applicant']
                ];
                ApplicableApplicant::create($app_data);
            }
        }
        else{
            $data=array_merge($data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
            $act_det = LeadershipDetails::where ('id', $request->id)->firstOrFail();
            $act_det->fill($data);
            $response_data=$act_det->save();
            if($request->document_List!=null && $request->document_List!="null" && $request->document_List!="" && sizeof($request->document_List)>0){
                RequiredAttachment::where('leadership_id',$request->id)->delete();
                foreach($request->document_List as $doc){
                    $doc_data =[
                        'leadership_id'            =>  $request->id,
                        'attachment'               =>  $doc['document']
                    ];
                    RequiredAttachment::create($doc_data);
                }
            }
            if($request->applicant_List!=null && $request->applicant_List!="null" && $request->applicant_List!="" && sizeof($request->applicant_List)>0){
                ApplicableApplicant::where('leadership_id',$request->id)->delete();
                foreach($request->applicant_List as $app){
                    $app_data =[
                        'leadership_id'             =>  $request->id,
                        'role_id'                   =>  $app['applicant']
                    ];
                    ApplicableApplicant::create($app_data);
                }
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadAllPosts($user_id=""){
        $respomse_data=LeadershipDetails::where('created_by',$user_id)->get();
        return $this->successResponse($respomse_data);
    }

    public function loadDetials($id=""){
        $respomse_data=LeadershipDetails::where('id',$id)->first();
        if($respomse_data!=""){
            $attachments=RequiredAttachment::where('leadership_id',$id)->get();
            if($attachments!=null && $attachments!=""){
                $respomse_data->attachments=$attachments;
            }
            $respomse_data->applicable_applicant=ApplicableApplicant::where('leadership_id',$id)->get();
        }
        return $this->successResponse($respomse_data);
    }

    public function loadAllPostList($role_ids=""){
        $query="SELECT p.leadership_id,s.id,s.position_title FROM staff_applicable_applicant p JOIN staff_leadership_detials s ON p.leadership_id=s.id WHERE role_id IN('";
        if(strpos($role_ids,',')){
            $role_ids=str_replace(",","','",$role_ids);
        }
        $posts=DB::select($query.$role_ids."') AND CURRENT_DATE BETWEEN s.from_date AND s.to_date GROUP BY p.leadership_id");
        return $this->successResponse($posts);
    }
    public function loadPostDetials($id=""){
        $post=LeadershipDetails::where('id',$id)->first();
        if($post!=null && $post!=""){
            $post->attachments=RequiredAttachment::where('leadership_id',$id)->get();
        }
        return $this->successResponse($post);
    }

    public function submitApplication(Request $request){
        $rules = [
            'post_id'    =>  'required',
            'staff_id'    =>  'required',
        ];
        $customMessages = [
            'post_id.required'   => 'This field is required',
            'staff_id.required'   => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'leadership_id'                 =>  $request->post_id,
            'staff_id'                      =>  $request->staff_id,
            'dzongkhag_id'                  =>  $request->dzo_id,
            'org_id'                        =>  $request->org_id,
            'accessLevel'                   =>  $request->accessLevel,
            'status'                        =>  'Submitted',
            'remarks'                       =>  $request->remarks,
        ];
        if($request->id==""){
            $last_seq=ApplicationSequence::where('service_name','Leadership Selection')->first();
            if($last_seq==null || $last_seq==""){
                $last_seq=1;
                $app_details = [
                    'service_name'                  =>  'Leadership Selection',
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::create($app_details);
            }
            else{
                $last_seq=$last_seq->last_sequence+1;
                $app_details = [
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::where('service_name', 'Leadership Selection')->update($app_details);
            }
            $appNo='STF_REC';
            if(strlen($last_seq)==1){
                $appNo= $appNo.date('Y').'.'.date('m').'.000'.$last_seq;
            }
            else if(strlen($last_seq)==2){
                $appNo= $appNo.date('Y').'.'.date('m').'.00'.$last_seq;
            }
            else if(strlen($last_seq)==3){
                $appNo= $appNo.date('Y').'.'.date('m').'.0'.$last_seq;
            }
            else if(strlen($last_seq)==4){
                $appNo= $appNo.date('Y').'.'.date('m').'.'.$last_seq;
            }

            $data=array_merge($data,
                array(  'application_number'    =>  $appNo,
                        'created_by'            =>  $request->user_id,
                        'created_at'            =>  date('Y-m-d h:i:s')
                )
            );
            $response_data = LeadershipApplication::create($data);
            if(!$request->attachment_details==null){
                foreach($request->attachment_details as $att){
                    $doc_data =[
                        'parent_id'                        =>  $response_data->id,
                        'attachment_for'                   =>  'Leadership Application',
                        'path'                             =>  $att['path'],
                        'original_name'                    =>  $att['original_name'],
                        'user_defined_name'                =>  $att['user_defined_name'],
                    ];
                    DocumentDetails::create($doc_data);
                }
            }
        }
        else{
            $data=array_merge($data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
            $act_det = LeadershipApplication::where ('id', $request->id)->firstOrFail();
            $act_det->fill($data);
            $response_data=$act_det->save();
            if($request->attachment_details!=null){
                // DocumentDetails::where('parent_id',$request->id)->delete();
                foreach($request->attachment_details as $att){
                    $doc_data =[
                        'parent_id'                        =>  $request->id,
                        'attachment_for'                   =>  'Leadership Application',
                        'path'                             =>  $att['path'],
                        'original_name'                    =>  $att['original_name'],
                        'user_defined_name'                =>  $att['user_defined_name'],
                    ];
                    DocumentDetails::create($doc_data);
                }
            }
            $response_data = LeadershipApplication::where ('id', $request->id)->first();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadAllApplication($user_id=""){
        $query="SELECT p.position_title,p.selection_type,p.details,a.id,a.application_number,a.created_at,a.status,a.staff_id,a.dzongkhag_id FROM staff_leadership_application a JOIN staff_leadership_detials p ON a.leadership_id =p.id where a.created_by= '".$user_id."'";
        $posts=DB::select($query);
        return $this->successResponse($posts);
    }

    public function loadapplicaitontDetials($id=""){
        $query="SELECT p.details,p.from_date,p.id post_id,p.position_title,p.selection_type,p.to_date,a.id,a.application_number,a.remarks,a.staff_id,a.status FROM staff_leadership_application a JOIN staff_leadership_detials p ON a.leadership_id=p.id WHERE a.id='".$id."'";
        $posts=DB::select($query);
        if($posts!="" && sizeof($posts)>0){
            foreach($posts as $post){
                $post->attachments=DocumentDetails::where('parent_id',$post->id)->get();
            }
        }
        return $this->successResponse($posts);
    }

    public function loadapplicaitontDetialsforVerification($app_no=""){
        $app_details=LeadershipApplication::where('application_number',$app_no)->first();
        if($app_details!=null && $app_details!=""){
            $app_details->Post_details=LeadershipDetails::where('id',$app_details->leadership_id)->first();
            $app_details->attachments=DocumentDetails::where('parent_id',$app_details->id)->get();
        }
        return $this->successResponse($app_details);
    }

    public function createLeadershipSelection(Request $request){
        $response_data=[];
        $data =[
            'selection_type'                =>  $request->selection_type,
            'position_title'                =>  $request->position_title,
            'from_date'                     =>  $request->from_date,
            'to_date'                       =>  $request->to_date,
            'details'                       =>  $request->details,
        ];
        if($request->id==""){
            $rules = [
                'selection_type'    =>  'required',
                'position_title'    =>  'required',
                'from_date'         =>  'required | date',
                'to_date'           =>  'required | date | after:from_date',
            ];
            $customMessages = [
                'selection_type.required'   => 'This field is required',
                'position_title.required'   => 'This field is required',
                'from_date.required'        => 'This field is required',
                'to_date.required'          => 'This field is required',
                'to_date.after'             => 'This field cannot be before start date',
            ];
            $this->validate($request, $rules,$customMessages);
            $data=array_merge($data,
                array('created_by'            =>  $request->user_id,
                    'created_at'            =>  date('Y-m-d h:i:s')
                )
            );
            $response_data = LeadershipDetails::create($data);
            foreach($request->nomi_staffList as $staff){
                $data =[
                    'leadership_id'            =>  $response_data->id,
                    'staff_id'                 =>  $staff['staff_id'],
                    'dzongkhag_id'             =>  $staff['dzo_id'],
                    'org_id'                   =>  $staff['org_id'],
                ];
                $nomination_data = NominationDetails::create($data);
            }
        }
        else{
            //eidt
            $data=array_merge($data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
            $act_det = LeadershipDetails::where ('id', $request->id)->firstOrFail();
            $act_det->fill($data);
            $response_data=$act_det->save();
            //
            $existing=NominationDetails::where('leadership_id',$request->id)->get();
            $newids="";
            // dd($request->nomi_staffList);
            foreach($request->nomi_staffList as $staff){
                $nomi_data =[
                    'leadership_id'            =>  $request->id,
                    'staff_id'                 =>  $staff['staff_id'],
                    'dzongkhag_id'             =>  $staff['dzo_id'],
                    'org_id'                   =>  $staff['org_id'],
                ];
                $newids.=$staff['staff_id'].', ';
                if($staff['id']=="NA"){
                    $nomination_data = NominationDetails::create($nomi_data);
                }
            }
            foreach($existing as $ids){
                if(strpos($newids,$ids->id)!==false){
                    FeedbackProviderDetails::where('nominees_id',$ids->id)->delete();
                    NominationDetails::where('id',$ids->id)->delete();
                }
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadLeadershipSelection($type="",$id=""){
        if($type=="draft"){
            $respomse_data=LeadershipDetails::where('created_by',$id)->where('status','pending')->first();
        }else{
            $respomse_data=LeadershipDetails::where('id',$id)->where('status','created')->first();
        }
        if($respomse_data!=""){
            $respomse_data->NominationDetails=NominationDetails::where('leadership_id',$respomse_data->id)->get();
        }
        return $this->successResponse($respomse_data);
    }

    public function createNominationForLeadershipSelection(Request $request){
        $rules = [
            'staff_type'            =>  'required',
            'cid'                   =>  'required',
            'name'                  =>  'required',
            'email'                 =>  'email',
        ];
        $customMessages = [
            'staff_type.required'           => 'This field is required',
            'cid.required'                  => 'This field is required',
            'name.required'                 => 'This field is required',
            'email.required'                => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'leadership_id'                 =>  $request->leadership_id,
            'staff_id'                      =>  $request->staff_id,
            'staff_type'                    =>  $request->staff_type,
            'cid'                           =>  $request->cid,
            'name'                          =>  $request->name,
            'email'                         =>  $request->email,
            'feedback_id'                   =>  $request->feedback_id,
            'nominees_id'                   =>  $request->nominees_id,
            'created_by'                    =>  $request->user_id,
        ];
        $response_data = FeedbackProviderDetails::create($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadNominationForLeadershipSelection($id=""){
        $respomse_data=FeedbackProviderDetails::where('leadership_id',$id)->get();
        return $this->successResponse($respomse_data);
    }

    public function publishleadership(Request $request){
        $final_details =[
            'status'        =>  'Created',
        ];
        $response_data=LeadershipDetails::where ('id', $request->id)->update($final_details);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadAllLeadershipSelection(){
        $respomse_data=LeadershipDetails::where('status','created')->get();
        return $this->successResponse($respomse_data);
    }

    public function getleadershipDetailsForFeedback($id=""){
        $respomse_data=DB::table('staff_leadership_nominee_feedback_detials as f')
        ->join('staff_leadership_detials as l', 'f.leadership_id', '=', 'l.id')
        ->join('master_stf_position_title as p', 'l.position_title', '=', 'p.id')
        ->join('staff_leadership_nomination_detials as n', 'n.id', '=', 'f.nominees_id')
        ->leftjoin('stf_staff as s', 's.id', '=', 'n.staff_id')
        ->join('master_stf_position_title as np', 's.position_title_id', '=', 'np.id')

        ->select('l.from_date','l.to_date','l.details','p.name AS position_title','l.selection_type','f.feedback_id',
        'n.staff_id','s.name AS nominee_name','np.name AS nominee_position_title','n.dzongkhag_id','n.org_id')
        ->where('n.id', $id)
        ->where('l.to_date','>=',date('Y-m-d'))
        ->where('l.status', 'created')->first();
        return $this->successResponse($respomse_data);
    }

    public function saveData(Request $request){
        $rules = [
            'name'                              =>  'required',
            'status'                            =>  'required',
        ];
        $customMessages = [
            'name.required'                     => 'This field is required',
            'status.required'                   => 'This field is required',
        ];
        if($request->record_type=="Question"){
            $rules = $rules+[
                'category_type_id'              =>  'required',
                'answer_type'                   =>  'required',
            ];
            $customMessages = $customMessages+[
                'category_type_id.required'     => 'This field is required',
                'answer_type.required'          => 'This field is required',
            ];
        }
        $this->validate($request, $rules,$customMessages);
        $databaseModel=$request->record_type;
        $modelName = "App\\Models\\"."$databaseModel";
        $model = new $modelName();
        $response_data="";
        // dd($request->action_type);
        if($request->action_type=="add"){
            $data =[
                'name'          =>  $request->name,
                'status'        =>  $request->status,
                'created_by'    =>  $request->user_id,
                'created_at'    =>  date('Y-m-d h:i:s'),
            ];
            if($request->record_type=="Question"){
                $data =$data+[
                    'category_type_id'   =>  $request->category_type_id,
                    'answer_type'        =>  $request->answer_type,
                ];
            }
            $response_data = $model::create($data);
            if($request->record_type=="Question"){
                if($request->answer!=null && $request->answer!="" && sizeof($request->answer)>0){
                    foreach($request->answer as $ans){
                        $ans_data =[
                            'question_id'          =>  $response_data->id,
                            'name'          =>  $ans['name'],
                            'status'        =>  $ans['status'],
                            'created_by'    =>  $request->user_id,
                            'created_at'    =>  date('Y-m-d h:i:s'),
                        ];
                        Answer::create($ans_data);
                    }
                }
            }
        }
        if($request->action_type=="edit"){
            $data = $model::find($request->id);
            //prepare data to save in audit
            // $messs_det="";
            // $messs_det.='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            // DB::select("CALL emis_audit_proc('".$this->database."','".$this->database_table."','".$request->id."','".$messs_det."','".$request->user_id."','Edit')");

            $data->name             = $request->name;
            $data->status           = $request->status;
            $data->updated_by       = $request->user_id;
            $data->updated_at       = date('Y-m-d h:i:s');
            if($request->record_type=="Question"){
                $data->category_type_id      = $request->category_type_id;
                $data->answer_type           = $request->answer_type;
            }
            $data->update();

            if($request->record_type=="Question"){
                if($request->answer!=null && $request->answer!="" && sizeof($request->answer)>0){
                    // dd($request->answer);
                    foreach($request->answer as $ans){
                        if($ans['id']=='NA'){
                            $ans_data =[
                                'question_id'   =>  $request->id,
                                'name'          =>  $ans['name'],
                                'status'        =>  $ans['status'],
                                'created_by'    =>  $request->user_id,
                                'created_at'    =>  date('Y-m-d h:i:s'),
                            ];
                            Answer::create($ans_data);
                        }
                        else{
                            $ans_data = Answer::find($ans['id']);
                            $ans_data->name             = $ans['name'];
                            $ans_data->status           = $ans['status'];
                            $ans_data->question_id      = $request->id;
                            $ans_data->update();
                        }
                    }
                }
            }
            $response_data=$model::find($request->id);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadData($param=""){
        if(strpos($param, 'allData_')!==false){
            $databaseModel=explode("_",$param)[1];
            $modelName = "App\\Models\\"."$databaseModel";
            $model = new $modelName();
            return $this->successResponse($model::all());
        }
        if(strpos($param, 'activeData')!==false){
            $databaseModel=explode("_",$param)[1];
            $modelName = "App\\Models\\"."$databaseModel";
            $model = new $modelName();
            return $this->successResponse($model::where('status',1)->get());
        }
    }

    public function loadexistingData($id=""){
        $response_data=Question::where('id',$id)->first();
        if($response_data!=null && $response_data!=""){
            $response_data->answers=Answer::where('question_id',$id)->get();
        }
        return $response_data;
    }

    public function saveFeedbackProviderData(Request $request){
        $rules = [
            'feedback_type'                            =>  'required',
        ];
        $customMessages = [
            'feedback_type.required'                   => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $response_data="";
        if($request->action_type=="add"){
            $data =[
                'application_number'        =>  $request->application_number,
                'partifipant_from'          =>  $request->partifipant_from,
                'email'                     =>  $request->email,
                'contact'                   =>  $request->contact,
                'participant'               =>  $request->participant,
                'positiontitle'             =>  $request->positiontitle,
                'cid'                       =>  $request->cid,
                'name'                      =>  $request->name,
                'department'                =>  $request->department,
                'school'                    =>  $request->school,
                'dzongkhag'                 =>  $request->dzongkhag,
                'feedback_type'             =>  $request->feedback_type,
                'action_type'               =>  $request->action_type,
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s'),
            ];
            $response_data = FeedbackProviderDetails::create($data);
        }
        if($request->action_type=="edit"){
            //need to write edit code if required
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function getFeedbackProviderData($appNo=""){
        $response_data=FeedbackProviderDetails::where('application_number',$appNo)->get();
        return $response_data;
    }
    public function deleteNomination($id=""){
        $response_data=FeedbackProviderDetails::where('id',$id)->delete();
        return $response_data;
    }

    public function verifyApproveNotify(Request $request){
        //$request->id is LeadershipApplication
        if($request->attachment_details!=null){
            foreach($request->attachment_details as $att){
                $doc_data =[
                    'parent_id'                        =>  $request->id,
                    'attachment_for'                   =>  'Leadership Selection',
                    'path'                             =>  $att['path'],
                    'original_name'                    =>  $att['original_name'],
                    'user_defined_name'                =>  $att['user_defined_name'],
                ];
                DocumentDetails::create($doc_data);
            }
        }
        $response_data="";
        $data =[
            'feedback_remarks'          =>  $request->verification_remarks,
            'feedback_start_date'       =>  $request->feedback_start_date,
            'feedback_end_date'         =>  $request->feedback_end_date,
            'feedback_details'          =>  $request->feedback_details,
            'status'                    =>  $request->current_status,
            'feedback_updated_date'     =>  date('Y-m-d h:i:s'),
            'feedback_updated_by'       =>  $request->user_id,
        ];
        LeadershipApplication::where('id',$request->id)->update($data);
        $response_data = LeadershipApplication::where('id',$request->id)->first();;
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function checkforfeedbackLink($id=""){
        // $respomse_data=DB::table('staff_leadership_nominee_feedback_detials as f')
        // ->join('staff_leadership_detials as l', 'f.leadership_id', '=', 'l.id')
        // ->join('master_stf_position_title as p', 'l.position_title', '=', 'p.id')
        // ->join('staff_leadership_nomination_detials as n', 'n.id', '=', 'f.nominees_id')
        // ->leftjoin('stf_staff as s', 's.id', '=', 'n.staff_id')
        // ->join('master_stf_position_title as np', 's.position_title_id', '=', 'np.id')

        // ->select('l.from_date','l.to_date','l.details','p.name AS position_title','l.selection_type',
        // 'n.id','n.staff_id','s.name AS nominee_name','np.name AS nominee_position_title','n.dzongkhag_id','n.org_id')
        // ->where('f.staff_id', $id)
        // ->where('l.to_date','>=',date('Y-m-d'))
        // ->where('l.status', 'created')->get();
        $response_data=FeedbackProviderDetails::where('participant',$id)->get();
        if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
            foreach($response_data as $data){
                $app_details=LeadershipApplication::where('application_number',$data['application_number'])->first();
                if($app_details!=null && $app_details!=""){
                    $data->application_details=$app_details;
                    $leadership_detials=LeadershipDetails::where('id',$app_details->leadership_id)->first();
                    $data->post_details=$leadership_detials;
                }
            }
        }
        return $this->successResponse($response_data);
    }

    public function getFeedbackData($id=""){
        $response_data=FeedbackProviderDetails::where('',$id)->get();
        return $response_data;
    }

}
