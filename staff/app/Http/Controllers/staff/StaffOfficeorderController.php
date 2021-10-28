<?php

namespace App\Http\Controllers\staff;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Models\office_order\TransferOrder;
use App\Models\staff\ApplicationSequence;
use App\Models\staff\PersonalDetails;
use App\Models\staff_masters\ChildGroupPosition;
use App\Models\staff_masters\PositionLevel;
use App\Models\staff_masters\PositionTitle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class StaffOfficeorderController extends Controller{
    use ApiResponser;
    public $database="staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function submitApplication(Request $request){
        $rules = [
            'reason'              =>  'required',
        ];
        $customMessages = [
            'reason.required'     => 'Please mention reason',
        ];
        $this->validate($request, $rules,$customMessages);

        $request_data =[
            'staff_id'                          =>  $request->staff_id,
            'reason'                            =>  $request->reason,
            'type'                              =>  $request->office_order_type,
            'status'                            =>  1,
        ];
        if($request->id==""){
            $last_seq=ApplicationSequence::where('service_name','Office Order')->first();
            if($last_seq==null || $last_seq==""){
                $last_seq=1;
                $app_details = [
                    'service_name'                  =>  'Office Order',
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::create($app_details);
            }
            else{
                $last_seq=$last_seq->last_sequence+1;
                $app_details = [
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::where('service_name', 'Office Order')->update($app_details);
            }
            $appNo='Order-No-';
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
            $request_data=array_merge($request_data,
                array('created_by'          =>  $request->user_id,
                    'created_at'            =>  date('Y-m-d h:i:s'),
                    'order_no'              =>  $appNo
                )
            );
            $response_data = TransferOrder::create($request_data);
        }
        else{
            $request_data=array_merge($request_data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
            $act_det = TransferOrder::where ('id', $request->id)->first();
            $act_det->fill($request_data);
            $response_data=$act_det->save();
            $response_data = TransferOrder::where ('id', $request->id)->first();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function checkOngoingApplication($type=""){
        $mod=explode('__',$type)[0];
        $modelName = "App\\Models\\office_order\\"."$mod";
        $model = new $modelName();
        return $this->successResponse($model::where('type',explode('__',$type)[1])->where('created_by',explode('__',$type)[2])->where('status',1)->first());
    }

    public function loadCreatedApplication($type=""){
        $mod=explode('__',$type)[0];
        $modelName = "App\\Models\\office_order\\"."$mod";
        $model = new $modelName();
        return $this->successResponse($model::where('type',explode('__',$type)[1])->where('created_by',explode('__',$type)[2])->get());
    }

    public function loadCreatedApplicationForVerification($type=""){
        $app=TransferOrder::where('status',1)->where('type',explode('__',$type)[1])->get();
        if($app!=null && $app!=""){
            foreach($app as $ap){
                $ap->StaffID=$ap->staff_id;
            }
            $app=$this->getstaff_positiondirectory($app,'Array');
        }
        return $this->successResponse($app);
    }

    public function loadDetForVerification($id=""){
        $app=TransferOrder::where('id',$id)->first();
        if($app!=null && $app!=""){
            $app->StaffID=$app->staff_id;
            $app=$this->getstaff_positiondirectory($app,'Single');
        }
        return $this->successResponse($app);
    }

    private function getstaff_positiondirectory($response_data,$type){
        if($type=="Single"){
            $person=PersonalDetails::where('id',$response_data->StaffID)->first();
            if($person!=null && $person!=""){
                $response_data->staff_name=$person->name;
                $response_data->emp_id=$person->emp_id;
                $response_data->working_agency_id=$person->working_agency_id;
            }
            $positions=ChildGroupPosition::where('id', $person->position_title_id)->first();
            if($positions!=null && $positions!=""){
                $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                if($posi!=null && $posi!=""){
                    $response_data->position_title_name=$posi->name;
                    $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                    if($posiLev!=null && $posiLev!=""){
                        $response_data->positionlevel=$posiLev->name;
                    }
                }
            }
        }else{
            foreach($response_data as $res){
                $person=PersonalDetails::where('id',$res->StaffID)->first();
                if($person!=null && $person!=""){
                    $res->staff_name=$person->name;
                    $res->emp_id=$person->emp_id;
                    $res->working_agency_id=$person->working_agency_id;
                    $res->position_title_name='';
                    $res->positionlevel='';
                    $positions=ChildGroupPosition::where('id', $person->position_title_id)->first();
                    if($positions!=null && $positions!=""){
                        $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                        if($posi!=null && $posi!=""){
                            $res->position_title_name=$posi->name;
                            $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                            if($posiLev!=null && $posiLev!=""){
                                $res->positionlevel=$posiLev->name;
                            }
                        }
                    }
                }
            }
        }
        return $response_data;
    }

    public function verifyApprove(Request $request){
        $status=2;
        if($request->action_type=="Reject"){
            $status=3;
        }
        $request_data =[
            'remarks'                           =>  $request->remarks,
            'status'                            =>  $status,
            'reject_approve_Date'               =>  date('Y-m-d h:i:s'),
            'rejected_approved_by'              =>  $request->user_id,
        ];
        $act_det = TransferOrder::where ('id', $request->id)->first();
        $act_det->fill($request_data);
        $response_data=$act_det->save();
        $response_data = TransferOrder::where ('id', $request->id)->first();
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

}
