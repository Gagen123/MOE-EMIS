<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\TransferWindow;
use App\Models\staff\TransferApplication;
use App\Models\staff\ApplicationSequence;
use App\Models\staff\TransPrefenreces;
use App\Models\staff\DocumentDetails;

class TransferController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function getcurrentTransferWindowDetails($id=""){
        if($id=="NA"){
            return $this->successResponse(TransferWindow::where('from_date','<=',date('Y-m-d'))->where('to_date','>=',date('Y-m-d'))->first());
        }
        else{
            return $this->successResponse(TransferWindow::where('id',$id)->first());
        }
    }
    
    public function submitapplicantDetails(Request $request){
        $rules = [
            'staff_id'              =>  'required  ',
            'reason_id'             =>  'required',
        ];
        $customMessages = [
            'staff_id.required'     => 'Please select applicant',
            'reason_id.required'    => 'Please select transfer reason',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'transfer_window_id'                =>  $request->t_id,
            'staff_id'                          =>  $request->staff_id,
            'transfer_reason_id'                =>  $request->reason_id,
            'description'                       =>  $request->description,
            'status'                            =>  $request->status,
            'created_by'                        =>$request->user_id,
            'created_at'                        =>date('Y-m-d h:i:s'),
        ];
        if($request->id=="" || $request->id==null){
            $response_data = TransferApplication::create($request_data);
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
            'preference_dzongkhag1'              =>  'required  ',
        ];
        $customMessages = [
            'preference_dzongkhag1.required'     => 'Please select this',
        ];
        $this->validate($request, $rules,$customMessages);
        $last_seq=ApplicationSequence::where('service_name','Training')->first();
        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Training',
                'last_sequence'                 =>  $last_seq,
            ];  
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];  
            ApplicationSequence::where('service_name', 'Training')->update($app_details);
        }
        $appNo='TR_';
        if(strlen($last_seq)==1){
            $appNo= $appNo.date('Y').'.'.date('m').'_0000'.$last_seq;
        }
        else if(strlen($last_seq)==2){
            $appNo= $appNo.date('Y').'.'.date('m').'_000'.$last_seq;
        }
        else if(strlen($last_seq)==3){
            $appNo= $appNo.date('Y').'.'.date('m').'_00'.$last_seq;
        }
        else if(strlen($last_seq)==4){
            $appNo= $appNo.date('Y').'.'.date('m').'_0'.$last_seq;
        }
        else if(strlen($last_seq)==5){
            $appNo= $appNo.date('Y').'.'.date('m').'_'.$last_seq;
        }
        $app_data=[
            'aplication_number'     =>  $appNo,
            'status'                =>  'Submitted'
        ];
        TransferApplication::where('id', $request->id)->update($app_data);
        $request_data =[
            'transfer_application_id'       =>  $request->id,
            'dzongkhag_id'                  =>  $request->preference_dzongkhag1,
            'preference'                    =>  1,
            'created_by'                    =>$request->user_id,
            'created_at'                    =>date('Y-m-d h:i:s'),
        ];
        TransPrefenreces::create($request_data); 
        if($request->preference_dzongkhag2!=""){
            $request_data =[
                'transfer_application_id'       =>  $request->id,
                'dzongkhag_id'                  =>  $request->preference_dzongkhag2,
                'preference'                    =>  2,
                'created_by'                    =>$request->user_id,
                'created_at'                    =>date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::create($request_data); 
        }
        if($request->preference_dzongkhag3!=""){
            $request_data =[
                'transfer_application_id'       =>  $request->id,
                'dzongkhag_id'                  =>  $request->preference_dzongkhag3,
                'preference'                    =>  3,
                'created_by'                    =>$request->user_id,
                'created_at'                    =>date('Y-m-d h:i:s'),
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

    public function loadtrainsferDetails($appNo=""){
        $response_data=TransferApplication::where('aplication_number',$appNo)->first();
        $response_data->preferences=TransPrefenreces::where('transfer_application_id',$response_data->id)->get();
        $response_data->documents=DocumentDetails::where('parent_id',$response_data->id)->get();
        return $this->successResponse($response_data);
    }
    
    public function updateTransferApplication(Request $request){
        $request_data =[
            'status'                       =>   $request->status,
            'updated_by'                   =>   $request->user_id,
            'updated_at'                   =>   date('Y-m-d h:i:s'),
        ];
        if($request->status=="Approved"){
            $additional_data=[
                'dzongkhagApproved'           =>   $request->dzongkhagApproved,
            ];
            $request_data = $request_data + $additional_data;
        }
        $response_data=TransferApplication::where('aplication_number', $request->application_number)->update($request_data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}
<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\TransferWindow;
use App\Models\staff\TransferApplication;
use App\Models\staff\ApplicationSequence;
use App\Models\staff\TransPrefenreces;
use App\Models\staff\DocumentDetails;

class TransferController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function getcurrentTransferWindowDetails($id=""){
        if($id=="NA"){
            return $this->successResponse(TransferWindow::where('from_date','<=',date('Y-m-d'))->where('to_date','>=',date('Y-m-d'))->first());
        }
        else{
            return $this->successResponse(TransferWindow::where('id',$id)->first());
        }
    }
    
    public function submitapplicantDetails(Request $request){
        $rules = [
            'staff_id'              =>  'required  ',
            'reason_id'             =>  'required',
        ];
        $customMessages = [
            'staff_id.required'     => 'Please select applicant',
            'reason_id.required'    => 'Please select transfer reason',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'transfer_window_id'                =>  $request->t_id,
            'staff_id'                          =>  $request->staff_id,
            'transfer_reason_id'                =>  $request->reason_id,
            'description'                       =>  $request->description,
            'status'                            =>  $request->status,
            'created_by'                        =>$request->user_id,
            'created_at'                        =>date('Y-m-d h:i:s'),
        ];
        if($request->id=="" || $request->id==null){
            $response_data = TransferApplication::create($request_data);
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
            'preference_dzongkhag1'              =>  'required  ',
        ];
        $customMessages = [
            'preference_dzongkhag1.required'     => 'Please select this',
        ];
        $this->validate($request, $rules,$customMessages);
        $last_seq=ApplicationSequence::where('service_name','Training')->first();
        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Training',
                'last_sequence'                 =>  $last_seq,
            ];  
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];  
            ApplicationSequence::where('service_name', 'Training')->update($app_details);
        }
        $appNo='TR_';
        if(strlen($last_seq)==1){
            $appNo= $appNo.date('Y').'.'.date('m').'_0000'.$last_seq;
        }
        else if(strlen($last_seq)==2){
            $appNo= $appNo.date('Y').'.'.date('m').'_000'.$last_seq;
        }
        else if(strlen($last_seq)==3){
            $appNo= $appNo.date('Y').'.'.date('m').'_00'.$last_seq;
        }
        else if(strlen($last_seq)==4){
            $appNo= $appNo.date('Y').'.'.date('m').'_0'.$last_seq;
        }
        else if(strlen($last_seq)==5){
            $appNo= $appNo.date('Y').'.'.date('m').'_'.$last_seq;
        }
        $app_data=[
            'aplication_number'     =>  $appNo,
            'status'                =>  'Submitted'
        ];
        TransferApplication::where('id', $request->id)->update($app_data);
        $request_data =[
            'transfer_application_id'       =>  $request->id,
            'dzongkhag_id'                  =>  $request->preference_dzongkhag1,
            'preference'                    =>  1,
            'created_by'                    =>$request->user_id,
            'created_at'                    =>date('Y-m-d h:i:s'),
        ];
        TransPrefenreces::create($request_data); 
        if($request->preference_dzongkhag2!=""){
            $request_data =[
                'transfer_application_id'       =>  $request->id,
                'dzongkhag_id'                  =>  $request->preference_dzongkhag2,
                'preference'                    =>  2,
                'created_by'                    =>$request->user_id,
                'created_at'                    =>date('Y-m-d h:i:s'),
            ];
            TransPrefenreces::create($request_data); 
        }
        if($request->preference_dzongkhag3!=""){
            $request_data =[
                'transfer_application_id'       =>  $request->id,
                'dzongkhag_id'                  =>  $request->preference_dzongkhag3,
                'preference'                    =>  3,
                'created_by'                    =>$request->user_id,
                'created_at'                    =>date('Y-m-d h:i:s'),
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

    public function loadtrainsferDetails($appNo=""){
        $response_data=TransferApplication::where('aplication_number',$appNo)->first();
        $response_data->preferences=TransPrefenreces::where('transfer_application_id',$response_data->id)->get();
        $response_data->documents=DocumentDetails::where('parent_id',$response_data->id)->get();
        return $this->successResponse($response_data);
    }
    
    public function updateTransferApplication(Request $request){
        $request_data =[
            'status'                       =>   $request->status,
            'updated_by'                   =>   $request->user_id,
            'updated_at'                   =>   date('Y-m-d h:i:s'),
        ];
        if($request->status=="Approved"){
            $additional_data=[
                'dzongkhagApproved'           =>   $request->dzongkhagApproved,
            ];
            $request_data = $request_data + $additional_data;
        }
        $response_data=TransferApplication::where('aplication_number', $request->application_number)->update($request_data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
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
    public function loadTransferWindow(){
        return $this->successResponse(TransferWindow::all());
    }
}