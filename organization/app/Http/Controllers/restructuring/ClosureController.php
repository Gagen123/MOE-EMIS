<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\restructuring\Closure;
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationProprietorDetails;
use App\Models\ApplicationSequence;
use App\Models\Masters\Level;
use App\Models\Masters\Location;


class ClosureController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    /**
     * method to submit school for closure 
     */
    public function saveClosure(Request $request){

        $last_seq=ApplicationSequence::where('service_name','Closure')->first();
            if($last_seq==null || $last_seq==""){
                $last_seq=1;
                $app_details = [
                    'service_name'                  =>  'Closure',
                    'last_sequence'                 =>  $last_seq,
                ];  
                ApplicationSequence::create($app_details);
            }
            else{
                $last_seq=$last_seq->last_sequence+1;
                $app_details = [
                    'last_sequence'                 =>  $last_seq,
                ];  
                ApplicationSequence::where('service_name', 'Closure')->update($app_details);
            }
            $application_no='Cls-';
            if(strlen($last_seq)==1){
                $application_no= $application_no.date('Y').date('m').'-000'.$last_seq;
            }
            else if(strlen($last_seq)==2){
                $application_no= $application_no.date('Y').date('m').'-00'.$last_seq;
            }
            else if(strlen($last_seq)==3){
                $application_no= $application_no.date('Y').date('m').'-0'.$last_seq;
            }
            else if(strlen($last_seq)==4){
                $application_no= $application_no.date('Y').date('m').'-'.$last_seq;
            }
        $closure =[
            'proposedName'             =>  $request['name'],
            'category'                 =>  $request['category'],
            'levelId'                  =>  $request['level'],
            'dzongkhagId'              =>  $request['dzongkhag'],
            'gewogId'                  =>  $request['gewog'],
            'chiwogId'                 =>  $request['chiwog'],
            'locationId'               =>  $request['location'],
            'isGeopoliticallyLocated'  =>  $request['geoLocated'],
            'isSenSchool'              =>  $request['senSchool'],
            'parentSchoolId'           =>  $request['parentSchool'],
            'coLocatedParent'          =>  $request['coLocatedParent'],
            'status'                   =>  $request['status'],
            'applicationNo'            =>  $application_no,
            'service'                  =>  "Closure",
            'created_by'               =>  $request->user_id,
            'created_at'               =>  date('Y-m-d h:i:s'),
            'reason'                   =>  $request['reason'],
            'remark'                   =>  $request['remark'],
            'id'                       =>  $request['id'],
        ];
        // dd($closure);
        $cls = ApplicationDetails::create($closure);
        // save proprietor details if category is private
        if($request['category'] == 0){
            $pvtDetails = [
                'applicationId'            =>  $cls->id,
                'cid'                      =>  $request['cid'],
                'fullName'                 =>  $request['fullName'],
                'phoneNo'                  =>  $request['phoneNo'],
                'email'                    =>  $request['email'],
                'created_by'               =>  $request->user_id,
                'created_at'               =>  date('Y-m-d h:i:s')
                ];
            $cls = ApplicationProprietorDetails::create($pvtDetails);
        }
        return $this->successResponse($cls, Response::HTTP_CREATED);
    }

    /**
     * method to load closure application for verification process
     */
    public function loadClosureApplicationDetails($appNo=""){
        $response_data=ApplicationDetails::where('applicationNo',$appNo)->first();
        $response_data->level=Level::where('id',$response_data->levelId)->first()->name; 
        $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        if($response_data->id!=null && $response_data->id!=""){
            $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        }
        return $this->successResponse($response_data); 
    }

    /**
     * method to update closure status in application table
     */
    public function updateClosure(Request $request){
        $estd =[
            'status'                       =>   $request->status,
            'updated_remarks'              =>   $request->yourRemark,
            'updated_by'                   =>   $request->user_id, 
        ];
        $close = ApplicationDetails::where('applicationNo', $request->application_number)->update($estd);
        return $this->successResponse($close, Response::HTTP_CREATED);
    }
}
