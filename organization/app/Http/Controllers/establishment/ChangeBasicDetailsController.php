<?php

namespace App\Http\Controllers\establishment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationProprietorDetails;
use App\Models\establishment\ApplicationClassStream;
use App\Models\OrganizationDetails;
use App\Models\OrganizationProprietorDetails;
use App\Models\OrganizationClassStream;
use App\Models\ApplicationSequence;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\Masters\Classes;
use App\Models\Masters\Stream;
use Illuminate\Support\Facades\DB;

class ChangeBasicDetailsController extends Controller
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
     * method to save change basic details
     */
    public function saveChangeBasicDetails(Request $request){
        $id = $request->id;

        if($id != null){
            $application_details=  ApplicationDetails::where('created_by',$request->user_id)->where('status', 'submitted')->first();
            $change = [
                'organizationId'                =>  $request['organizationId'],
                'proposedName'                  =>      $request['name'],
                'category'                      =>      $request['category'],
                'levelId'                       =>      $request['level'],
                'dzongkhagId'                   =>      $request['dzongkhag'],
                'gewogId'                       =>      $request['gewog'],
                'chiwogId'                      =>      $request['chiwog'],
                'locationId'                    =>      $request['locationType'], 
                'isGeopoliticallyLocated'       =>      $request['geoLocated'],
                'isSenSchool'                   =>      $request['senSchool'],
                'parentSchoolId'                =>      $request['parentSchool'],
                'isColocated'                   =>      $request['coLocatedParent'],
                'status'                        =>      $request['status'],
                'applicationNo'                 =>      $application_details->applicationNo,
                'service'                       =>      "Change Basic Details",
                'updated_by'                    =>      $request->user_id,
                'created_at'                    =>      date('Y-m-d h:i:s')
                ];
                $changeDetails = ApplicationDetails::where('id', $id)->update($change);

                if($request['category'] == 0){
                    $pvtDetails = [
                        'applicationId'            =>  $application_details->id,
                        'cid'                      =>  $request['cid'],
                        'fullName'                 =>  $request['fullName'],
                        'phoneNo'                  =>  $request['phoneNo'],
                        'email'                    =>  $request['email'],
                        'updated_by'               =>  $request->user_id,
                        'created_at'               =>  date('Y-m-d h:i:s')
                        ];
                    $changeDetails = ApplicationProprietorDetails::where('applicationId', $application_details->id)->update($pvtDetails);
                }
                return $this->successResponse($changeDetails, Response::HTTP_CREATED);

        }else{
            $last_seq=ApplicationSequence::where('service_name','Change Basic Details')->first();
            if($last_seq==null || $last_seq==""){
                $last_seq=1;
                $app_details = [
                    'service_name'                  =>  'Change Basic Details',
                    'last_sequence'                 =>  $last_seq,
                ];  
                ApplicationSequence::create($app_details);
            }
            else{
                $last_seq=$last_seq->last_sequence+1;
                $app_details = [
                    'last_sequence'                 =>  $last_seq,
                ];  
                ApplicationSequence::where('service_name', 'Change Basic Details')->update($app_details);
            }
            $application_no='Chn-';
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
            $change = [
            'organizationId'                =>      $request['organizationId'],
            'proposedName'                  =>      $request['name'],
            'category'                      =>      $request['category'],
            'levelId'                       =>      $request['level'],
            'dzongkhagId'                   =>      $request['dzongkhag'],
            'gewogId'                       =>      $request['gewog'],
            'chiwogId'                      =>      $request['chiwog'],
            'locationId'                    =>      $request['locationType'], 
            'isGeopoliticallyLocated'       =>      $request['geoLocated'],
            'isSenSchool'                   =>      $request['senSchool'],
            'parentSchoolId'                =>      $request['parentSchool'],
            'isColocated'                   =>      $request['coLocatedParent'],
            'status'                        =>      $request['status'],
            'applicationNo'                 =>      $application_no,
            'service'                       =>      "Change Basic Details",
            'created_by'                    =>  $request->user_id,
            'created_at'                    =>  date('Y-m-d h:i:s')
            ];
            $changeDetails = ApplicationDetails::create($change);
            if($request['category'] == 0){
                $pvtDetails = [
                    'applicationId'            =>  $changeDetails->id,
                    'cid'                      =>  $request['cid'],
                    'fullName'                 =>  $request['fullName'],
                    'phoneNo'                  =>  $request['phoneNo'],
                    'email'                    =>  $request['email'],
                    'created_by'               =>  $request->user_id,
                    'created_at'               =>  date('Y-m-d h:i:s')
                    ];
                $changeDetails = ApplicationProprietorDetails::create($pvtDetails);
            }
            return $this->successResponse($changeDetails, Response::HTTP_CREATED);
        }
    }

    /**
     * method to save class and stream details
     */
    public function saveChangeClass(Request $request){
        $classes=$request->class;
        $classStream='';
        $inserted_class="";
        $application_details=  ApplicationDetails::where('created_by',$request->user_id)->where('status', 'submitted')->first();
        if($request->stream!="" && sizeof($request->stream)>0){
            foreach ($request->stream as $stm){
                foreach ($classes as $cls){
                    if(explode('##',$stm)[0]==$cls){
                        $classStream = [
                            'applicationNo'   => $application_details->applicationNo,
                            'classId'           =>$cls,
                            'streamId'          =>explode('##',$stm)[1],
                            'created_by'           =>$request->user_id,
                            'created_at'        =>date('Y-m-d h:i:s'),
                            
                        ];
                        if(strpos($inserted_class,$cls)===false){
                            $inserted_class.=$cls;
                        }
                        $class = ApplicationClassStream::create($classStream);
                    }
                }
            }
        }
        foreach ($classes as $cls){
            if(strpos($inserted_class,$cls)===false){
                $classStream = [
                    'applicationNo'   => $application_details->applicationNo,
                    'classId'           => $cls,
                    'created_by'           =>$request->user_id,
                    'created_at'        =>date('Y-m-d h:i:s'),
                ];
                if($classStream != ""){
                    $class = ApplicationClassStream::create($classStream);
                }
            }
        }
        return $this->successResponse($class, Response::HTTP_CREATED);
    }

    public function loadChangeDetailForVerification($appNo=""){
        $response_data=ApplicationDetails::where('applicationNo',$appNo)->first();
        $response_data->level=Level::where('id',$response_data->levelId)->first()->name; 
        $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        if($response_data->id!=null && $response_data->id!=""){
            $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        }
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

    public function loadPriviousOrgDetails($orgId=""){
        $response_data=OrganizationDetails::where('id',$orgId)->first();
        $response_data->level=Level::where('id',$response_data->levelId)->first()->name; 
        $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        if($response_data->id!=null && $response_data->id!=""){
            $response_data->proprietor=OrganizationProprietorDetails::where('organizationId',$response_data->id)->get();
        }
        $classSection=OrganizationClassStream::where('organizationId',$orgId)->groupBy('classId')->get();
        $stream=OrganizationClassStream::where('organizationId',$orgId)->where('streamId','!=',null)->get();
        foreach($classSection as $cls){
            $cls->class_name=Classes::where('id',$cls->classId)->first()->class;
        }
        $response_data->class_section=$classSection;
        if(!$stream){
            foreach($stream as $sec){
                $sec->section_name=Stream::where('id',$sec->streamId)->first()->stream;
            }
            $response_data->stream=$stream;
        }
        return $this->successResponse($response_data); 
    }

    public function updateChangeBasicDetails(Request $request){
        $estd =[
            'status'                       =>   $request->status,
            'updated_remarks'              =>   $request->remarks,
            'updated_by'                   =>   $request->user_id, 
        ];
        $establishment = ApplicationDetails::where('applicationNo', $request->application_number)->update($estd);
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    /**
     * method to get application No 
     */
    public function getApplicationNo($userId=''){
        return ApplicationDetails::where('created_by',$userId)->where('status','Submitted')->where('service','Change Basic Details')->get(['id']);
    }

    /**
     * method to get current class in checkbox
     */
    public function getCurrentClass(){
        $currentClass =  DB::table('classes as a')
                        ->join('organization_class_streams as b', 'a.id', '=', 'b.classId')
                        ->select('b.classId as id', 'a.class as class')->get();
        return $currentClass;
    }

     /**
     * method to get current stream in checkbox
     */
    public function getCurrentStream(){
        $currentStream =  DB::table('streams as a')
                        ->join('organization_class_streams as b', 'a.id', '=', 'b.streamId')
                        ->select('b.streamId as id', 'a.stream as stream')->get();
        return $currentStream;
    }

    /**
     * method to load curent organization details
     */
    public function loadCurrentOrgDetails($orgId=""){
        $response_data=OrganizationDetails::where('id',$orgId)->first();
        $response_data->level=Level::where('id',$response_data->levelId)->first()->name;
        $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        return $this->successResponse($response_data);
    }

    /**
     * method to load curent proprietor organization details
     */
    public function loadCurrentProprietorDetails($orgId=""){
        return $this->successResponse(OrganizationProprietorDetails::where('id',$orgId)->first());
    }
}
