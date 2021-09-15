<?php

namespace App\Http\Controllers\staff;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\staff\SubstitutionModel;
use App\Models\staff\SubstitutedTeacher;
use App\Models\staff\PersonalDetails;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use DateTime;

class SubstitutionController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function savestaff(Request $request){
        $rules = [
            'cid'                   =>  'required  ',
            'name'                  =>  'required  ',
            'dob'                   =>  'required  ',
            'gender'                =>  'required  ',
            'dzongkhag'             =>  'required  ',
            'contact'               =>  'required  ',
            'email'                 =>  'required  ',
            'qualification'         =>  'required  ',
        ];
        $customMessages = [
            'cid.required'              => 'Please provide CID',
            'name.required'             => 'name is required',
            'dob.required'              => 'dob is required',
            'gender.required'           => 'gender is required',
            'dzongkhag.required'        => 'dzongkhag is required',
            'contact.required'          => 'contact is required',
            'email.required'            => 'email is required',
            'qualification.required'    => 'qualification is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'cid'               =>  $request->cid,
            'name'              =>  $request->name,
            'dob'               =>  $request->dob,
            'gender'            =>  $request->gender,
            'dzongkhag'         =>  $request->dzongkhag,
            'contact'           =>  $request->contact,
            'email'             =>  $request->email,
            'qualification'     =>  $request->qualification,
        ];
        if($request->action_type=="add"){
            $data =$data+[
                'created_by'        =>  $request->user_id,
                'created_at'        =>  date('Y-m-d h:i:s'),
            ];
            $response_data = SubstitutionModel::create($data);
        }
        if($request->action_type=="edit"){
            $data =$data+[
                'updated_by'        =>  $request->user_id,
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];
            $response_data = SubstitutionModel::where('id',$request->id)->update($data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadStaff($type="",$model=""){
        $modelName = "App\\Models\\staff\\"."$model";
        $model = new $modelName();
        if($type == 'all'){
            $response_data=$model::get();
            return $response_data;
        }
        if(strpos($type,'by_id')!==false){
            $response_data=$model::where('id',explode('__',$type)[1])->first();
            return $response_data;
        }
        if(strpos($type,'by_cid')!==false){
            $response_data=$model::where('cid',explode('__',$type)[1])->first();
            return $response_data;
        }
    }
    public function saveStaffSubstituted(Request $request){
       // dd($request);
        $modelName = "App\\Models\\staff\\"."$request->model";
        $model = new $modelName();
        $rules = [
            'staff_id'              =>  'required',
            'start_date'            =>  'required',
            'subsTeacher'           =>  'required',
            'teaching_subject'      =>  'required',
        ];
        $customMessages = [
            'staff_id.required'     => 'Please select applicant',
            'start_date.required'   => 'Please select applicant',
            'subsTeacher'           => 'This field is required',
            'teaching_subject'      => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $insert_data = [
            'staff_id'              =>  $request->staff_id,
            'from_date'             =>  $request->start_date,
            'to_date'               =>  $request->end_date,
            'remarks'               =>  $request->remarks,
            'subsTeacher'           =>  $request->subsTeacher,
            'teaching_subject'      =>  $request->teaching_subject,
            'isextended'            =>  $request->isextended,
           
        ];
        
       //dd($insert_data);
        if($request->action_type=="add"){
            $insert_data =$insert_data+[
                'created_by'        =>  $request->user_id,
                'created_at'        =>  date('Y-m-d h:i:s'),
            ];
            $response_data = $model::create($insert_data);
        }
        if($request->action_type=="edit"){
            $insert_data =$insert_data+[
                'updated_by'        =>  $request->user_id,
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];
            $response_data = $model::where('id',$request->id)->update($insert_data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    public function loadSubstaff(){
        //dd('from services');
        $response_data = DB::table('substituted_teachers')
        ->join('stf_staff', 'substituted_teachers.staff_id', '=', 'stf_staff.id')
        ->join('staff_substitution', 'substituted_teachers.subsTeacher', '=', 'staff_substitution.id')
        ->select('substituted_teachers.id AS id','stf_staff.emp_id AS empId', 'stf_staff.name AS name','staff_substitution.name AS subtituted_by',
            'staff_substitution.cid AS cid', 'substituted_teachers.from_date AS from_date','substituted_teachers.to_date AS to_date',
            'substituted_teachers.teaching_subject AS teaching_subject','substituted_teachers.isextended AS contact_extended')
        ->get();
        //dd($response_data);
        return $this->successResponse($response_data);

    }
    public function getEditSubstitutedList($subid=""){
     // dd($subid);
        $response_data = DB::table('substituted_teachers')
    //    ->join('stf_staff', 'substituted_teachers.staff_id', '=', 'stf_staff.id')
        ->select('id','staff_id','subsTeacher',
            'from_date','to_date',
            'teaching_subject','isextended',
            'remarks')->where('id',$subid)->first();
  
        //dd($response_data);
        return $this->successResponse($response_data);

    }
    // public function localProcureEditList($subid=""){
    //     //dd($subid);
    //     $response_data=SubstitutedTeacher::where('id', $subid)->first();
    //     return $this->successResponse($response_data);
    // }
}
