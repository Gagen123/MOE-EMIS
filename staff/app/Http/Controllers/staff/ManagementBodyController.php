<?php

namespace App\Http\Controllers\staff;

use App\Models\staff\StaffManagementMeetingMember;
use App\Models\staff\StaffManagementMeetingMinutes;
use App\Models\staff\ManagementBodyComposition;
use App\Models\staff\StaffManagementMeeting;
use App\Models\staff\ManagementBodyDetails;
use App\Models\staff_masters\MgmntBodyType;
use App\Models\staff_masters\MgmnDesignation;
use App\Models\staff\DocumentDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ManagementBodyController extends Controller{
    use ApiResponser;
    public $database="emis_staff";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveManagementBody(Request $request){
        $rules = [
            'body_type'                =>  'required',
            'from_date'                =>  'required',
            'to_date'                  =>  'required',
        ];
        $customMessages = [
            'body_type.required'      => 'This field is required',
            'from_date.required'      => 'This field is required',
            'to_date.required'        => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $mgmn_details =[
            'body_type_id'      =>$request->body_type,
            'from_date'         =>$request->from_date,
            'to_date'           =>$request->to_date,
            'org_id'            =>$request->org,
            'dzongkhag_id'      =>$request->dzongkhag,
            'remarks'           =>$request->remarks,
            'status'            =>'pending',
            'created_by'        =>$request->user_id,
            'created_at'        =>date('Y-m-d h:i:s'),
        ];
       
        if($request->type=="edit"){
            ManagementBodyDetails::where('id', $request->id)->update($mgmn_details);
            $response_data = ManagementBodyDetails::where('id', $request->id)->first();
        }
        else{
            $pending_Data=ManagementBodyDetails::where ('created_by', $request->user_id)->where ('status', 'pending')->first();
            if($pending_Data=="" || $pending_Data==null){
                $response_data = ManagementBodyDetails::create($mgmn_details);
            }
            else{
                ManagementBodyDetails::where('created_by', $request->user_id)->where ('status', 'pending')->update($mgmn_details);
                $response_data = ManagementBodyDetails::where('created_by', $request->user_id)->where('status', 'pending')->first();
            }
            if($request->attachment_details!=null){
                foreach($request->attachment_details as $att){
                    $doc_data =[
                        'parent_id'                        =>  $response_data->id,
                        'attachment_for'                   =>  'Management Body',
                        'path'                             =>  $att['path'],
                        'original_name'                    =>  $att['original_name'],
                        'user_defined_name'                =>  $att['user_defined_name'],
                    ];
                    DocumentDetails::create($doc_data);
                }
            }
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function saveManagementBodyComposition(Request $request){
        $rules = [
            'nonstaffname' =>  'required',
            'designation'  =>  'required',
            'phone'        =>  'required',
        ];
        $customMessages = [
            'nonstaffname.required' => 'This field is required',
            'designation.required'  => 'This field is required',
            'phone.required'        => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $mgmn_details =[
            'management_id'     =>  $request->management_id,
            'emptye'            =>  $request->emptye,
            'name'              =>  $request->nonstaffname,
            'designation'       =>  $request->designation,
            'phone'             =>  $request->phone,
            'email'             =>  $request->email,
            'address'           =>  $request->address,
            'from_date'         =>  $request->fromdate,
            'to_date'           =>  $request->todate,
        ];
        $response_data = ManagementBodyComposition::create($mgmn_details);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }


    public function saveManagementMeeting(Request $request){
        $rules = [
            'meeting_date' =>'required',
            'start_time'   =>'required',
            'end_time'     =>'required',
            'venue'        =>'required',
        ];
        $customMessages = [
            'meeting_date.required' => 'This field is required',
            'start_time.required'   => 'This field is required',
            'end_time.required'     => 'This field is required',
            'venue.required'        => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $meeting_data =[
            'meeting_date'  =>$request->meeting_date,
            'start_time'    =>$request->start_time,
            'end_time'      =>$request->end_time,
            'venue'         =>$request->venue,
            'status'        =>'pending',
            'created_by'    =>$request->user_id,
            'created_at'    =>date('Y-m-d h:i:s'),
        ];
        if($request->type=="edit"){
            StaffManagementMeeting::where('id', $request->id)->update($meeting_data);
            $response_data = StaffManagementMeeting::where('id', $request->id)->first();
            return $this->successResponse("success edit");
        }
        else{
            if($request->id){
                $met_data = StaffManagementMeeting::find($request->id);
                $met_data->fill($meeting_data);
                $met_data->save();
                foreach($request->members as $member) {
                    $sdata =[
                        'meeting_id'  => $met_data->id,
                        'member_id'   => $member,
                        'status'      => 'pending',
                        'created_by'  => $request->user_id,
                        'created_at'  => date('Y-m-d h:i:s'),
                    ];
                    //check existing and update or create new if not found.
                    StaffManagementMeetingMember::where('member_id', $member)
                    ->updateOrCreate([
                        'meeting_id' => $met_data->id,
                        'member_id' => $member
                    ],
                    [
                        'status'      => 'pending',
                        'created_by'  => $request->user_id,
                        'created_at'  => date('Y-m-d h:i:s')
                    ]);
                }
                return $this->successResponse($met_data, Response::HTTP_CREATED);

            }else{
                // add new meeting and members
                $response_data = StaffManagementMeeting::create($meeting_data);
                if($response_data){
                    foreach($request->members as $member) {
                        $sdata =[
                            'meeting_id'  => $response_data->id,
                            'member_id'   => $member,
                            'status'      => 'pending',
                            'created_by'  => $request->user_id,
                            'created_at'  => date('Y-m-d h:i:s'),
                        ];
                        if(!(StaffManagementMeetingMember::create($sdata))){
                            StaffManagementMeetingMember::where('meeting_id', $response_data->id)->delete();
                            StaffManagementMeeting::where('id', $response_data->id)->delete();
                            return $this->successResponse("error");
                        };
                    }
                    return $this->successResponse($response_data, Response::HTTP_CREATED);
                }else{
                    return $this->successResponse("error");
                }
            }
        }

    }

    public function saveResolutions(Request $request){
       // dd($request);
        // $rules = [
        //     'minutes'        =>'required',
        // ];
        // $customMessages = [
        //     'minutes.required' => 'This field is required',
        // ];
        // $this->validate($request, $rules,$customMessages);
        foreach($request->minutes as $_data){
            $resolution =[
                'meeting_id' =>$_data["meeting_id"],
                'minutes'    =>$_data["minutes"],
                'status'     =>'created',
                'created_by' =>$request->created_by,
                'created_at' =>date('Y-m-d h:i:s'),
            ];
            StaffManagementMeetingMinutes::create($resolution);
            if($resolution){
                $meeting_id = $resolution["meeting_id"];
                $updatedata = [
                    'status' => 'created'
                ];
                StaffManagementMeeting::where('id', $meeting_id)->update($updatedata);
                StaffManagementMeetingMember::where('meeting_id', $meeting_id)->update($updatedata);
            }
        }
        return $this->successResponse('success');
    }

    public function loadCurrentMeeting($userid=""){
        return $this->successResponse(StaffManagementMeeting::where('status','pending')->where('created_by',$userid)->first());
    }

    public function loadManagementBodyComposition($id){ //$userid
        $_meeting = StaffManagementMeeting::where('status','pending')->first();//->where('created_by',$userid)->first();
        $_members = ManagementBodyComposition::select(
                        'stf_mgmn_body_composition.id',
                        'stf_mgmn_body_composition.address',
                        'master_mgmn_designation.name as designation',
                        'stf_mgmn_body_composition.email',
                        'stf_mgmn_body_composition.emptye',
                        'stf_mgmn_body_composition.from_date',
                        'stf_mgmn_body_composition.management_id',
                        'stf_mgmn_body_composition.name',
                        'stf_mgmn_body_composition.phone',
                        'stf_mgmn_body_composition.to_date',
                        'staff_management_meeting_members.id as meeting_member_id'
                    )
                    ->leftJoin('staff_management_meeting_members','staff_management_meeting_members.member_id', '=',  'stf_mgmn_body_composition.id')
                    ->leftjoin('master_mgmn_designation','stf_mgmn_body_composition.designation', '=','master_mgmn_designation.id')
                    ->where('management_id',$id)->get();

        $data = array_merge(['meeting' => $_meeting], ['members' => $_members]);
        return $this->successResponse($data);
    }

    public function deleteManagementBodyComposition($id="",$itemId=""){
        ManagementBodyComposition::where('id',$id)->delete();
        return $this->successResponse(ManagementBodyComposition::where('management_id',$itemId)->get());
    }

    public function updateManagementBody(Request $request){
        $update_details=[
            'status'      =>  'created',
        ];
        $response_data=ManagementBodyDetails::where('id', $request->id)->update($update_details);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadcreatedManagementBodyComposition($param=""){
        //dd($param);
        // return $this->successResponse(ManagementBodyDetails::where('org_id',explode('SSS',$param)[1])->where('status','created')->get());
       
            $equi = DB::table('stf_mgmn_body_details as a')
                ->select('a.id as id', 'b.name as body_type_id', 'a.from_date as from_date','a.to_date','a.remarks')
                ->join('master_mgmn_body_type as b', 'b.id', '=', 'a.body_type_id')
                ->where('a.org_id',explode('SSS',$param)[1])
                ->where('a.status','created')
                ->get();
            return $equi;
        
    }

    public function loadcurrentbaord($id=""){
        // return $this->successResponse(ManagementBodyDetails::where('id',$id)->first());
        $response_data=ManagementBodyDetails::where('id',$id)->first();
        $response_data->attachments=DocumentDetails::where('parent_id',$response_data->id)->get();
        return $this->successResponse($response_data);

    }
}
