<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Support\Carbon;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\Masters\Classes;
use App\Models\Masters\Stream;
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationClassStream;
use App\Models\establishment\ApplicationProprietorDetails;
use App\Models\ApplicationSequence;
class MergerController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveMerger(Request $request){
        $last_seq=ApplicationSequence::where('service_name','Merger')->first();
        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Merger',
                'last_sequence'                 =>  $last_seq,
            ];  
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'      =>  $last_seq,
            ];  
            ApplicationSequence::where('service_name', 'Merger')->update($app_details);
        }
        $application_no='Merge-';
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
        $merger = [
            'applicationNo'            =>       $application_no,
            'service'                  =>       'Merger',
            'oldOrganizationId1'       =>       $request['orgId1'],
            'oldOrganizationId2'       =>       $request['orgId2'],
            'proposedName'             =>       $request['proposedName'],
            'category'                 =>       $request['category'],
            'levelId'                  =>       $request['level'],
            'dzongkhagId'              =>       $request['dzongkhag'],
            'gewogId'                  =>       $request['gewog'],
            'chiwogId'                 =>       $request['chiwog'],
            'locationId'               =>       $request['location'],
            'isGeopoliticallyLocated'  =>       $request['geoLocated'],
            'isSenSchool'              =>       $request['senSchool'],
            'parentSchoolId'           =>       $request['parentSchool'],
            'isColocated'              =>       $request['coLocated'],
            'year'                     =>       $request['year'],
            'created_by'               =>       $request->user_id,
            'status'                   =>       'Submitted',
            'created_at'               =>       date('Y-m-d h:i:s')
        ];
        $establishment = ApplicationDetails::create($merger);
        if($request['category'] == 0){
            $pvtDetails = [
                'applicationId'            =>  $establishment->id,
                'cid'                      =>  $request['cid'],
                'fullName'                 =>  $request['name'],
                'phoneNo'                  =>  $request['phoneNo'],
                'email'                    =>  $request['email'],
                'created_by'               =>  $request->user_id,
                'created_at'               =>  date('Y-m-d h:i:s')
            ];
            $prop = ApplicationProprietorDetails::create($pvtDetails);
        }
        if($request->class!="" && sizeof($request->class)>0){
            foreach ($request->class as $cls){
                $class_data = [
                    'applicationNo'     => $application_no,
                    'classId'           => $cls,
                    'created_by'        => $request->user_id,
                    'created_at'        => date('Y-m-d h:i:s'),
                ];
                $class = ApplicationClassStream::create($class_data);
            }
        }
        $inserted_class="";
        if($request->stream!="" && sizeof($request->stream)>0){
            foreach ($request->stream as $stm){
                foreach ($request->class as $cls){
                    if(explode('##',$stm)[0]==$cls){
                        $stream_data = [
                            'applicationNo'     => $application_no,
                            'classId'           => $cls,
                            'streamId'          => explode('##',$stm)[1],
                            'created_by'        => $request->user_id,
                            'created_at'        => date('Y-m-d h:i:s'),
                        ];
                        if(strpos($inserted_class,$cls)===false){
                            $inserted_class.=$cls;
                        }
                        $strm = ApplicationClassStream::create($stream_data);
                    }
                }
            }
        }
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }
    
    public function loadMergerForVerification($appNo=""){
        $response_data=ApplicationDetails::where('applicationNo',$appNo)->first();
        $response_data->application_date=date_format(Carbon::parse($response_data->created_at), 'Y-m-d h:i:s');
        $response_data->level=Level::where('id',$response_data->levelId)->first()->name;
        $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        $classSection=ApplicationClassStream::where('applicationNo',$appNo)->groupBy('classId')->get();
        $sections=ApplicationClassStream::where('applicationNo',$appNo)->where('streamId','!=',null)->get();
        foreach($classSection as $cls){
            $cls->class_name=Classes::where('id',$cls->classId)->first()->class;
        }
        foreach($sections as $sec){
            $sec->section_name=Stream::where('id',$sec->streamId)->first()->stream;
        }
        $response_data->class_section=$classSection;
        $response_data->sections=$sections;
        return $this->successResponse($response_data); 
    }

}
