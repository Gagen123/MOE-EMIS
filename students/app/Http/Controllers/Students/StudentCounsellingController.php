<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Masters\CounsellingType;
use App\Models\Students\CounsellingRecords;


class StudentCounsellingController extends Controller
{
    //
    use ApiResponser;
    public $database="emis_student";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function loadCounsellingInformation($orgId=""){
        //dd('from microservice');
        //  $info = CounsellingRecords::where('organizationId',$orgId)->get();
        //  return $info;
       $list= DB::table('counselling_records as a')
       ->join('counselling_type as b', 'a.counselling_type', '=', 'b.id')
       ->select('a.id as id', 'b.name as counselling_type', 'a.number as number', 'a.remarks as remarks')
       ->where('organizationId', $orgId)->get();
       return $list;
    }

    

    public function saveCounsellingInformation(Request $request){
        $id = $request->id;
     //   dd($id);
        if( $id != null){
        $data =[
            'id'                       =>  $request['id'],
            'organizationId'           =>  $request['working_agency_id'],
            'counselling_type'         =>  $request['counselling_type'],
            'number'                   =>  $request['number'],
            'remarks'                  =>  $request['remarks'],
            'updated_by'               =>  $request['user_id'],
            'updated_at'               =>  date('Y-m-d h:i:s'),
        ];

        $response_data = CounsellingRecords::where('id', $id)->update($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
         }else{
        $data =[
            'organizationId'           =>  $request['working_agency_id'],
            'counselling_type'         =>  $request['counselling_type'],
            'number'                   =>  $request['number'],
            'remarks'                  =>  $request['remarks'],
            'created_by'               =>  $request['user_id'],
            'created_at'               =>  date('Y-m-d h:i:s'),
        ];
        // dd($data);
        $response_data = CounsellingRecords::create($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    }
    

    public function getCounsellingDetails($couId=""){
        $response_data=CounsellingRecords::where('id',$couId)->first();
     // $response_data->facility=FacilityInStructure::where('infrastructureId',$response_data->id)->get();
        return $this->successResponse($response_data);
    }
}
