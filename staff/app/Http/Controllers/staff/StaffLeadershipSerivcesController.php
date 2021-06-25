<?php

namespace App\Http\Controllers\staff;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Models\staff_leadership\ApplicableApplicant;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff_leadership\LeadershipDetails;
use App\Models\staff_leadership\NominationDetails;
use App\Models\staff_leadership\FeedbackProviderDetails;
use App\Models\staff_leadership\RequiredAttachment;
use Illuminate\Support\Facades\DB;
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
            'details'                       =>  $request->details,
        ];
        if($request->id==""){
            $rules = [
                'selection_type'    =>  'required',
                'position_title'    =>  'required',
                'details'           =>  'required',
                'from_date'         =>  'required | date',
                'to_date'           =>  'required | date | after:from_date',
            ];
            $customMessages = [
                'selection_type.required'   => 'This field is required',
                'position_title.required'   => 'This field is required',
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
    public function loadPostDetials($role_ids=""){
        $participant=explode(',', $role_ids);
        $posts=ApplicableApplicant::wherein('role_id',$participant)->get()->groupby('leadership_id');
        if($posts!=null && $posts!="" && sizeof($posts)>0){
            foreach($posts as $post){
                dd($post);
                $post->application_details=LeadershipDetails::where('id',$post->leadership_id)->first();
                $post->attachments=RequiredAttachment::where('leadership_id',$post->leadership_id)->get();
            }
        }
        return $this->successResponse($posts);
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

    public function checkforfeedbackLink($id=""){
        // return FeedbackProviderDetails::where('staff_id',$id)->get();
        // dd($id);
        $respomse_data=DB::table('staff_leadership_nominee_feedback_detials as f')
        ->join('staff_leadership_detials as l', 'f.leadership_id', '=', 'l.id')
        ->join('master_stf_position_title as p', 'l.position_title', '=', 'p.id')
        ->join('staff_leadership_nomination_detials as n', 'n.id', '=', 'f.nominees_id')
        ->leftjoin('stf_staff as s', 's.id', '=', 'n.staff_id')
        ->join('master_stf_position_title as np', 's.position_title_id', '=', 'np.id')

        ->select('l.from_date','l.to_date','l.details','p.name AS position_title','l.selection_type',
        'n.id','n.staff_id','s.name AS nominee_name','np.name AS nominee_position_title','n.dzongkhag_id','n.org_id')
        ->where('f.staff_id', $id)
        ->where('l.to_date','>=',date('Y-m-d'))
        ->where('l.status', 'created')->get();
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
}
