<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Masters\CounsellingType;
use App\Models\Students\CounsellingRecords;
use App\Models\Students\CounsellingProgram;


class StudentCounsellingController extends Controller
{
    //
    use ApiResponser;
    public $database="emis_student";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function loadCounsellingInformation($orgId=""){

       $list= DB::table('std_counselling_records')
                    ->join('std_counselling_type', 'std_counselling_records.counselling_type', '=', 'std_counselling_type.id')
                    ->join('std_counselling_class_range', 'std_counselling_records.class_range', '=', 'std_counselling_class_range.id')
                    ->join('std_counselling_age_range', 'std_counselling_records.age_range', '=', 'std_counselling_age_range.id')
                    ->select('std_counselling_records.*', 'std_counselling_type.name as counselling_name', 
                                'std_counselling_class_range.name as ClassRange', 'std_counselling_age_range.name as AgeRange')
                    ->where('organizationId', $orgId)
                    ->get();
       return $list;
    }

    public function saveCounsellingInformation(Request $request){
        $id = $request->id;
        if( $id != null){
            $data =[
                'id'                    => $request['id'],
                'counselling_type'      => $request['counselling_type'],
                'male'                  => $request['male'],
                'female'                => $request['female'],
                'age_range'             => $request['age_range'],
                'class_range'           => $request['class_range'],
                'organizationId'        => $request['working_agency_id'],
                'remarks'               => $request['remarks'],
                'updated_by'            =>  $request['user_id'],
                'updated_at'            =>  date('Y-m-d h:i:s'),
            ];

            $response_data = CounsellingRecords::where('id', $id)->update($data);
            
            return $this->successResponse($response_data, Response::HTTP_CREATED);
        }else{
            $data =[
                'id'                    => $request['id'],
                'counselling_type'      => $request['counselling_type'],
                'male'                  => $request['male'],
                'female'                => $request['female'],
                'age_range'             => $request['age_range'],
                'class_range'           => $request['class_range'],
                'organizationId'        => $request['working_agency_id'],
                'remarks'               => $request['remarks'],
                'created_by'            =>  $request['user_id'],
                'created_at'            =>  date('Y-m-d h:i:s'),
            ];
            $response_data = CounsellingRecords::create($data);
            
            return $this->successResponse($response_data, Response::HTTP_CREATED);
        }
    }
    

    public function getCounsellingDetails($couId=""){
        $response_data=CounsellingRecords::where('id',$couId)->first();
     // $response_data->facility=FacilityInStructure::where('infrastructureId',$response_data->id)->get();
        return $this->successResponse($response_data);
    }

    public function saveCounsellingProgram(Request $request){
        $id = $request->id;
        if( $id != null){
            $data =[
                'id'                    => $request['id'],
                'organizationId'        => $request['working_agency_id'],
                'activities'            => $request['activities'],
                'issues'                => $request['issues'],
                'updated_by'            =>  $request['user_id'],
                'updated_at'            =>  date('Y-m-d h:i:s'),
            ];

            $response_data = CounsellingProgram::where('id', $id)->update($data);
            
            return $this->successResponse($response_data, Response::HTTP_CREATED);
        }else{
            $data =[
                'id'                    => $request['id'],
                'activities'            => $request['activities'],
                'issues'                => $request['issues'],
                'organizationId'        => $request['working_agency_id'],
                'remarks'               => $request['remarks'],
                'created_by'            =>  $request['user_id'],
                'created_at'            =>  date('Y-m-d h:i:s'),
            ];
            $response_data = CounsellingProgram::create($data);
            
            return $this->successResponse($response_data, Response::HTTP_CREATED);
        }
    }

    public function loadCounsellingProgram($orgId=""){

        $list= DB::table('std_counselling_programs')
                     ->where('organizationId', $orgId)
                     ->get();
        return $list;
     }
}
