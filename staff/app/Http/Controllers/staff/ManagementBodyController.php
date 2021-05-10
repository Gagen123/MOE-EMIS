<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff\ManagementBodyDetails;
use App\Models\staff\ManagementBodyComposition;
class ManagementBodyController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
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
            'body_type_id'      =>  $request->body_type,
            'from_date'         =>  $request->from_date,
            'to_date'           =>  $request->to_date,
            'org_id'            =>  $request->org,
            'dzongkhag_id'      =>  $request->dzongkhag,
            'remarks'           =>  $request->remarks,
            'status'            =>  'pending',
            'created_by'        =>  $request->user_id, 
            'created_at'        =>  date('Y-m-d h:i:s'),
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
                // $act_det = ManagementBodyDetails::where ('id', $request->id)->where ('status', 'created')->first();
                ManagementBodyDetails::where('created_by', $request->user_id)->where ('status', 'pending')->update($mgmn_details);
                // $act_det->save();
                $response_data = ManagementBodyDetails::where('created_by', $request->user_id)->where('status', 'pending')->first();
            }  
        }
         
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function saveManagementBodyComposition(Request $request){
        $rules = [
            'nonstaffname'                =>  'required',
            'designation'                =>  'required',
            'phone'                  =>  'required',
        ];
        $customMessages = [
            'nonstaffname.required'      => 'This field is required',
            'designation.required'      => 'This field is required',
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
        // $update_details=[
        //     'status'            =>  'created',
        // ];
        // ManagementBodyDetails::where('id', $request->management_id)->update($update_details);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadManagementBodyComposition($id=""){
        return $this->successResponse(ManagementBodyComposition::where('management_id',$id)->get());
    }
    
    public function deleteManagementBodyComposition($id="",$itemId=""){
        ManagementBodyComposition::where('id',$id)->delete();
        return $this->successResponse(ManagementBodyComposition::where('management_id',$itemId)->get());
    }
    
    public function updateManagementBody(Request $request){
        $update_details=[
            'status'            =>  'created',
        ];
        $response_data=ManagementBodyDetails::where('id', $request->id)->update($update_details);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadcreatedManagementBodyComposition($param=""){
        return $this->successResponse(ManagementBodyDetails::where('org_id',explode('SSS',$param)[1])->where('status','created')->get());
    }
    
    public function loadcurrentbaord($id=""){
        return $this->successResponse(ManagementBodyDetails::where('id',$id)->first());
    }
}
