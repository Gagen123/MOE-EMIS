<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\ExternalData\AbroadStudentDetails;
use App\Models\ExternalData\RubCollegeDetails;
use App\Models\ExternalData\RubStaffDetails;
use App\Models\ExternalData\RubStudentDetails;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;


class ExternalDataImputController extends Controller
{
    use ApiResponser;
    public $database="student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveImported(Request $request){
        if($request->action_type=="add"){
            if($request->type == "institutes"){
                $rules = [
                    'collegeName'               => 'required',
                    'dzongkhag'                 => 'required',
                    'remarks'                   => 'required',
                    'institutes_type'           => 'required',
                    'own_by'                    => 'required',

                ];
                $customMessages = [
                    'collegeName.required'     => 'This field is required',
                    'dzongkhag.required'       => 'This field is required',
                    'remarks.required'         => 'This field is required',
                    'institutes_type.required' => 'This field is required',
                    'own_by.required'          => 'This field is required',
                ];
                $this->validate($request, $rules, $customMessages);
                    $collegeDetails =[
                        'collegeName'           => $request->collegeName,
                        'institutes_type'       => $request->institutes_type,
                        'dzongkhag'             => $request->dzongkhag,
                        'own_by'                => $request->own_by,
                        'status'                => $request->status,
                        'remarks'               => $request->remarks,
                        'created_by'            => $request->user_id,
                        'org_id'                => $request->working_agency_id,
                        'created_at'            =>  date('Y-m-d h:i:s')
                    ];
                    $response_data=RubCollegeDetails::create($collegeDetails);
                    return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            else if($request->type == "staff"){
                $staffDetails =[
                    'institute_id'             => $request->institutes_id,
                    'year'                     => $request->year,
                    'staffMale'                => $request->staffMale,
                    'staffFemale'              => $request->staffFemale,
                    'staffTotal'               => $request->staffTotal,
                    'remarks'                  =>  $request->remarks,
                    'created_by'               =>  $request->user_id,
                    'created_at'               =>  date('Y-m-d h:i:s')
                ];
                $response_data = RubStaffDetails::create($staffDetails);
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            else if($request->type == "student"){
                $institutes_id  = $request['institutes_id'];
                $user_id  = $request['user_id'];
                $studentDetails = [
                    'institute_id'              =>  $institutes_id,
                    'studentMale'               =>  $request['studentMale'],
                    'studentFemale'             =>  $request['studentFemale'],
                    'studentTotal'              =>  $request['studentTotal'],
                    'addAs'                     => $request->addAs,
                    'created_by'                =>  $user_id,
                    'created_at'                =>  date('Y-m-d h:i:s')
                ];
                $response_data = RubStudentDetails::create($studentDetails);
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            else if($request->type == "abroad_student"){
                $user_id  = $request['user_id'];
                $studentDetails = [
                    'year'                        =>  $request['year'],
                    'AbstudentMale'               =>  $request['AbstudentMale'],
                    'AbstudentFemale'             =>  $request['AbstudentFemale'],
                    'AbstudentTotal'              =>  $request['AbstudentTotal'],
                    'created_by'                  =>  $user_id,
                    'created_at'                  =>  date('Y-m-d h:i:s')
                ];
                $response_data = AbroadStudentDetails::create($studentDetails);
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            else{
                $modelName = "App\\Models\\ExternalData\\"."$request->model";
                $model = new $modelName();
                $response_data="";
                if($request->model=="NsbModel" || $request->model=="CensusModel"){
                    $request_data = [
                        'year'                          =>  $request['year'],
                        'male'                          =>  $request['male'],
                        'female'                        =>  $request['female'],
                    ];
                }
                if($request->model=="NsbModel"){
                    $request_data=$request_data+[
                        'age_group'                      =>  $request['agegroup'],
                    ];
                }
                if($request->model=="CensusModel"){
                    $request_data=$request_data+[
                        'age'                      =>  $request['age'],
                    ];
                }
                $request_data=$request_data+[
                    'created_by'                    =>  $request['user_id'],
                    'created_at'                    =>  date('Y-m-d h:i:s')
                ];
                $response_data = $model::create($request_data);
            }
        }

        if($request->action_type=="edit"){
            if($request->type == "institutes"){
                $rules = [
                    'collegeName'               => 'required',
                    'dzongkhag'                 => 'required',
                    'remarks'                   => 'required',
                    'institutes_type'           => 'required',
                    'own_by'                    => 'required',

                ];
                $customMessages = [
                    'collegeName.required'     => 'This field is required',
                    'dzongkhag.required'       => 'This field is required',
                    'remarks.required'         => 'This field is required',
                    'institutes_type.required' => 'This field is required',
                    'own.required'             => 'This field is required',
                ];
                $this->validate($request, $rules, $customMessages);
                $collegeDetails =[
                    'id'                    => $request->id,
                    'remarks'               => $request->remarks,
                    'own_by'                => $request->own_by,
                    'status'                => $request->status,
                    'collegeName'           => $request->collegeName,
                    'institutes_type'       => $request->institutes_type,
                    'dzongkhag'             => $request->dzongkhag,
                    'updated_by'            => $request->user_id,
                    'org_id'                => $request->working_agency_id,
                    'updated_at'            =>  date('Y-m-d h:i:s')
                ];
                $response_data = RubCollegeDetails::where('id',$request->id,)->update($collegeDetails);
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            else if($request->type == "staff"){
                $staffDetails =[
                    'id'                       => $request->id,
                    'institute_id'             => $request->institutes_id,
                    'year'                     => $request->year,
                    'staffMale'                => $request->staffMale,
                    'staffFemale'              => $request->staffFemale,
                    'staffTotal'               => $request->staffTotal,
                    'updated_by'               =>  $request->user_id,
                    'updated_at'               =>  date('Y-m-d h:i:s')
                ];
                $response_data = RubStaffDetails::where('id',$request->id,)->update($staffDetails);
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            else if($request->type == "student"){
                $studentDetails = [
                    'id'                        => $request->id,
                    'institute_id'              =>  $request->institutes_id,
                    'studentMale'               =>  $request['studentMale'],
                    'studentFemale'             =>  $request['studentFemale'],
                    'studentTotal'              =>  $request['studentTotal'],
                    'addAs'                     =>  $request->addAs,
                    'created_by'                =>  $request->user_id,
                    'created_at'                =>  date('Y-m-d h:i:s')
                ];
                $response_data = RubStudentDetails::where('id',$request->id,)->update($studentDetails);
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            else if($request->type == "abroad_student"){
                $user_id  = $request['user_id'];
                $studentDetails = [
                    'id'                          => $request->id,
                    'year'                        =>  $request['year'],
                    'AbstudentMale'               =>  $request['AbstudentMale'],
                    'AbstudentFemale'             =>  $request['AbstudentFemale'],
                    'AbstudentTotal'              =>  $request['AbstudentTotal'],
                    'created_by'                  =>  $user_id,
                    'created_at'                  =>  date('Y-m-d h:i:s')
                ];
                $response_data = AbroadStudentDetails::where('id',$request->id,)->update($studentDetails);
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
            else{
                $modelName = "App\\Models\\ExternalData\\"."$request->model";
                $model = new $modelName();
                $response_data="";
                if($request->model=="NsbModel" || $request->model=="CensusModel"){
                    $request_data = [
                        'year'                          =>  $request['year'],
                        'male'                          =>  $request['male'],
                        'female'                        =>  $request['female'],
                    ];
                }
                if($request->model=="NsbModel"){
                    $request_data=$request_data+[
                        'age_group'                     =>  $request['agegroup'],
                    ];
                }
                if($request->model=="CensusModel"){
                    $request_data=$request_data+[
                        'age'                     =>  $request['age'],
                    ];
                }
                $request_data=$request_data+[
                    'updated_by'                    =>  $request['user_id'],
                    'updated_at'                    =>  date('Y-m-d h:i:s')
                ];
                $model::where('id',$request->id)->update($request_data);
                $response_data = $model::where('id',$request->id)->first();
                return $this->successResponse($response_data, Response::HTTP_CREATED);
            }
        }
    }

    public function loadInstitues($type="",$model=""){
        // if($param=="all_institutes"){
        //     return $this->successResponse(RubCollegeDetails::all());
        // }
        // if($param=="staff"){
        //     return $this->successResponse(RubStaffDetails::all());
        // }
        // if($param=="student"){
        //     return $this->successResponse(RubStudentDetails::all());
        // }
        // if($param=="Abroadstudent"){
        //     return $this->successResponse(AbroadStudentDetails::all());
        // }
        $modelName = "App\\Models\\ExternalData\\"."$model";
        $model = new $modelName();
        if($type == 'all'){
            return $this->successResponse($model::get());
        }
        if(strpos($type,'nsbData')  !== false){
            $response_data=$model::where('year',explode('_',$type)[1])->where('age_group',explode('_',$type)[2])->first();
            return $this->successResponse($response_data);
        }
        if(strpos($type,'censusData_')  !== false){
            $years=explode(',',explode('_',$type)[2]);
            $response_data=$model::where('year',explode('_',$type)[1])->wherein('age',$years)->get();
            return $this->successResponse($response_data);
        }

    }
}
