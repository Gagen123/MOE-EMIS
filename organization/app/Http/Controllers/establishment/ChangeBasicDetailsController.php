<?php

namespace App\Http\Controllers\establishment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationProprietorDetails;
use App\Models\establishment\ApplicationClassStream;
use App\Models\establishment\ApplicationEstDetailsChange;
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

        $application_details_data =[
            'application_no'       =>  $this->generateApplicationNo(),
            'establishment_type'   =>  $request['application_for'],
            'application_type'     =>  $request['application_type'],
            'year'                 =>  date('Y'),
            'status'               =>  $request['status'],
            'created_by'           =>  $request['user_id']
        ];

        $inserted_application_data = ApplicationDetails::create($application_details_data);
        $applicationDetailsId = $inserted_application_data->id;

        switch($request['application_type']){
            case "name_change" : {
                    $change_details_data = $this->extractNameChangeData($request, $applicationDetailsId);
                    break;
                }
            case "feeding_change" : {
                    $change_details_data = $this->extractFeedingChangeData($request, $applicationDetailsId);
                    break;
                }
            case "level_change" : {
                    $change_details_data = $this->extractChangeInLevelData($request, $applicationDetailsId);
                    break;
                }
            case "proprietor_change" : {
                    $change_details_data = $this->extractChangeInPropreitorData($request, $applicationDetailsId);
                    break;
                }
            case "sen_change" : {
                    $change_details_data = $this->extractSenChangeData($request, $applicationDetailsId);
                    break;
                }
            case "all_details" : {
                    $change_details_data = $this->extractAllChangeData($request, $applicationDetailsId);
                    break;
                }
            default : {
                
                break;
            }
        }

        return $this->successResponse($inserted_application_data, Response::HTTP_CREATED);

        //UGYEN'S OLD FUNCTION

        // $application_details=  ApplicationDetails::where('created_by', $request->user_id)->where('service', 'Change Basic Details')->where('status', 'pending')->first();
        // if($application_details != null && $application_details!=""){
        //     $change = [
        //         'proposedName'                  =>      $request['name'],
        //         'category'                      =>      $request['category'],
        //         'levelId'                       =>      $request['level'],
        //         'dzongkhagId'                   =>      $request['dzongkhag'],
        //         'gewogId'                       =>      $request['gewog'],
        //         'chiwogId'                      =>      $request['chiwog'],
        //         'locationId'                    =>      $request['locationType'], 
        //         'isGeopoliticallyLocated'       =>      $request['geoLocated'],
        //         'isSenSchool'                   =>      $request['senSchool'],
        //         'parentSchoolId'                =>      $request['parentSchool'],
        //         'isColocated'                   =>      $request['coLocatedParent'],
        //         'status'                        =>      $request['status'],
        //         'created_at'                    =>      date('Y-m-d h:i:s')
        //     ];
        //     $changeDetails = ApplicationDetails::where('id', $application_details->id)->update($change);
        //     if($request['category'] == 0){
        //         $pvtDetails = [
        //             'applicationId'            =>  $application_details->id,
        //             'cid'                      =>  $request['cid'],
        //             'fullName'                 =>  $request['fullName'],
        //             'phoneNo'                  =>  $request['phoneNo'],
        //             'email'                    =>  $request['email'],
        //             'updated_by'               =>  $request->user_id,
        //             'created_at'               =>  date('Y-m-d h:i:s')
        //         ];
        //         $prop_det = ApplicationProprietorDetails::where('applicationId', $application_details->id)->update($pvtDetails);
        //     }
        //     return $this->successResponse($application_details, Response::HTTP_CREATED);

        // }else{
        //     $last_seq=ApplicationSequence::where('service_name','Change Basic Details')->first();
        //     if($last_seq==null || $last_seq==""){
        //         $last_seq=1;
        //         $app_details = [
        //             'service_name'                  =>  'Change Basic Details',
        //             'last_sequence'                 =>  $last_seq,
        //         ];  
        //         ApplicationSequence::create($app_details);
        //     }
        //     else{
        //         $last_seq=$last_seq->last_sequence+1;
        //         $app_details = [
        //             'last_sequence'                 =>  $last_seq,
        //         ];  
        //         ApplicationSequence::where('service_name', 'Change Basic Details')->update($app_details);
        //     }
        //     $application_no='Ch-';
        //     if(strlen($last_seq)==1){
        //         $application_no= $application_no.date('Y').date('m').'-000'.$last_seq;
        //     }
        //     else if(strlen($last_seq)==2){
        //         $application_no= $application_no.date('Y').date('m').'-00'.$last_seq;
        //     }
        //     else if(strlen($last_seq)==3){
        //         $application_no= $application_no.date('Y').date('m').'-0'.$last_seq;
        //     }
        //     else if(strlen($last_seq)==4){
        //         $application_no= $application_no.date('Y').date('m').'-'.$last_seq;
        //     }
        //     $change = [
        //         'organizationId'                =>      $request['organizationId'],
        //         'proposedName'                  =>      $request['name'],
        //         'category'                      =>      $request['category'],
        //         'levelId'                       =>      $request['level'],
        //         'dzongkhagId'                   =>      $request['dzongkhag'],
        //         'gewogId'                       =>      $request['gewog'],
        //         'chiwogId'                      =>      $request['chiwog'],
        //         'locationId'                    =>      $request['locationType'], 
        //         'isGeopoliticallyLocated'       =>      $request['geoLocated'],
        //         'isSenSchool'                   =>      $request['senSchool'],
        //         'parentSchoolId'                =>      $request['parentSchool'],
        //         'isColocated'                   =>      $request['coLocatedParent'],
        //         'status'                        =>      $request['status'],
        //         'applicationNo'                 =>      $application_no,
        //         'service'                       =>      "Change Basic Details",
        //         'created_by'                    =>      $request->user_id,
        //         'created_at'                    =>      date('Y-m-d h:i:s')
        //     ];
        //     $changeDetails = ApplicationDetails::create($change);
        //     if($request['category'] == 0){
        //         $pvtDetails = [
        //             'applicationId'            =>  $changeDetails->id,
        //             'cid'                      =>  $request['cid'],
        //             'fullName'                 =>  $request['fullName'],
        //             'phoneNo'                  =>  $request['phoneNo'],
        //             'email'                    =>  $request['email'],
        //             'created_by'               =>  $request->user_id,
        //             'created_at'               =>  date('Y-m-d h:i:s')
        //         ];
        //         $prop_det = ApplicationProprietorDetails::create($pvtDetails);
        //     }
        //     return $this->successResponse($changeDetails, Response::HTTP_CREATED);
        // }
    }

    /**
     * Generate the application no
     */

    private function generateApplicationNo(){
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
        $application_no='Ch-';
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

        return $application_no;
    }

    /**
     * Extract the details of various field sets
     * 'id',
     *  'ApplicationDetailsId',
     *  'organizationId',
     *  'change_type',
     *  'proposedChange',
     *  'changeInDetails'
     * 
     */

    private function extractNameChangeData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'      => $applicationDetailsId,
            'organizationId'            =>  $request['organizationId'],
            'change_type'              =>  $request['application_for'],
            'proposedChange'               =>  $request['proposedName'],
            'created_by'                   =>  $request['user_id']  
        ];

        $changeDetails = ApplicationEstDetailsChange::create($data);

        return $changeDetails;
    }

    private function extractFeedingChangeData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'      => $applicationDetailsId,
            'organizationId'            =>  $request['organizationId'],
            'change_type'              =>  $request['application_for'],
            'proposedChange'               =>  $request['isfeedingschool'],
            'created_by'                   =>  $request['user_id'] 
        ];

        $changeDetails = ApplicationEstDetailsChange::create($data);

        return $changeDetails;

    }

    private function extractChangeInLevelData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'      => $applicationDetailsId,
            'organizationId'            =>  $request['organizationId'],
            'change_type'              =>  $request['application_for'],
            'proposedChange'               =>  $request['level'],
            'created_by'                   =>  $request['user_id']  
        ];

        $changeDetails = ApplicationEstDetailsChange::create($data);
        $EstDetailsChangeId = $changeDetails->id;


        foreach($request->class as $key => $classId){
            $stream_exists = $this->checkStreamExists($classId);
            
            if(empty($stream_exists)){

                $classStream = [
                    'ApplicationDetailsId'  => $EstDetailsChangeId,
                    'classId'               => $classId,
                    'streamId'              => '',
                    'created_by'            => $request->user_id,
                    'created_at'            => date('Y-m-d h:i:s'),
                ];
                
                $class = ApplicationClassStream::create($classStream);

            } 
        }
        if($request->stream!=null && $request->stream!=""){
            foreach($request->stream as $key2 => $classStreamId){
                $class_stream_data = $this->getClassStreamId($classStreamId);
    
                foreach($class_stream_data as $v){
                    $classStream = [
                        'ApplicationDetailsId'  => $EstDetailsChangeId,
                        'classId'               => $v->classId,
                        'streamId'              => $v->streamId,
                        'created_by'            => $request->user_id,
                        'created_at'            => date('Y-m-d h:i:s'),
                    ];
                    $class = ApplicationClassStream::create($classStream);
                }
            }
        }

        return $changeDetails;
    }

    /**
     * Check whether a class has streams or not
     */
    private function checkStreamExists($classId){
        $data = DB::table('class_stream_mappings')
                ->select('streamId', 'classId')
                ->where('classId', $classId)
                ->get()
                ->toArray();

        return $data;

    }

    /**
     * Get class and stream id based on id
     */
    private function getClassStreamId($id){
        $data = DB::table('class_stream_mappings')
                ->select('classId', 'streamId')
                ->where('id', $id)
                ->get()
                ->toArray();

        return $data;

    }

    private function extractChangeInPropreitorData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'      => $applicationDetailsId,
            'organizationId'            =>  $request['organizationId'],
            'change_type'              =>  $request['application_for'],
            'proposedChange'               =>  '',
            'created_by'                   =>  $request['user_id'] 
        ];

        $changeDetails = ApplicationEstDetailsChange::create($data);
        $EstDetailsChangeId = $changeDetails->id;

        $prop_data =[
            'ApplicationEstDetailsChangeId' => $EstDetailsChangeId,
            'proposedName'                  => $request['proposedName'],
            'proprietorCid'                 => $request['proprietorCid'],
            'proprietorMobile'              => $request['proprietorMobile'],
            'proprietorPhone'               => $request['proprietorPhone'],
            'proprietorEmail'               => $request['proprietorEmail']
        ];

        $propDetails = ApplicationProprietorDetails::create($prop_data);

        return $propDetails;
        
    }

    private function extractSenChangeData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'      => $applicationDetailsId,
            'organizationId'            =>  $request['organizationId'],
            'change_type'              =>  $request['application_for'],
            'proposedChange'               =>  $request['senSchool'],
            'created_by'                   =>  $request['user_id'] 
        ];

        $changeDetails = ApplicationEstDetailsChange::create($data);

        return $changeDetails;
    }

    private function extractAllChangeData($request, $applicationDetailsId){
        $data = [
            'ApplicationDetailsId'      => $applicationDetailsId,
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
            'created_by'                    =>      $request->user_id,
            'created_at'                    =>      date('Y-m-d h:i:s')
        ];

        $changeDetails = ApplicationDetails::create($data);
    }


    /**
     * method to save class and stream details
     */
    public function saveChangeClass(Request $request){
        $classes=$request->class;
        $classStream='';
        $inserted_class="";
        $application_details=  ApplicationDetails::where('created_by', $request->user_id)->where('service', 'Change Basic Details')->where('status', 'pending')->first();
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
        $array = ['status' => $request->status];
        DB::table('application_details')->where('applicationNo',$application_details->applicationNo)->update($array);
        return $this->successResponse($class, Response::HTTP_CREATED);
    }

    public function loadChangeDetailForVerification($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        if($response_data!="" && $response_data!=null){
            if($response_data->application_type=="name_change"){
                $response_data->change_details=ApplicationEstDetailsChange::where('ApplicationDetailsId',$response_data->id)->first();
            }
            if($response_data=="Change in Feeding Details"){
                
            }
            if($response_data=="Change in Level"){
                
            }
            if($response_data=="Change in Proprietor"){
                
            }
            if($response_data=="Change in SEN details"){
                
            }
        }
        // $response_data->level=Level::where('id',$response_data->levelId)->first()->name; 
        // $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        // if($response_data->id!=null && $response_data->id!=""){
        //     $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        // }
        // $classSection=ApplicationClassStream::where('applicationNo',$appNo)->groupBy('classId')->get();
        // $sections=ApplicationClassStream::where('applicationNo',$appNo)->where('streamId','!=',null)->get();
        // foreach($classSection as $cls){
        //     $cls->class_name=Classes::where('id',$cls->classId)->first()->class;
        // }
        // foreach($sections as $sec){
        //     $sec->section_name=Stream::where('id',$sec->streamId)->first()->stream;
        // }
        // $response_data->class_section=$classSection;
        // $response_data->sections=$sections;
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
        $appDetails = ApplicationDetails::where('applicationNo', $request->application_number)->first();
        $orgDetail=OrganizationDetails::where('id',$appDetails->organizationId)->first();
        $classSection=OrganizationClassStream::where('organizationId',$appDetails->organizationId)->get();
        if(sizeof($classSection)>0){
            OrganizationClassStream::where('organizationId',$appDetails->organizationId)->delete();
        }
        $appclassDetails=ApplicationClassStream::where('applicationNo',$request->application_number)->get();
       
        foreach($appclassDetails as $appclas){
            $appclas =[
                'organizationId'            =>  $appDetails->organizationId,
                'classId'                   =>  $appclas->classId,
                'streamId'                  =>  $appclas->streamId,
                'updated_by'                =>  $request->user_id,
            ];
            OrganizationClassStream::create($appclas);
        }
        $estd =[
            'status'                       =>   $request->status,
            'updated_remarks'              =>   $request->remarks,
            'updated_by'                   =>   $request->user_id, 
        ];
        $establishment = ApplicationDetails::where('applicationNo', $request->application_number)->update($estd);
        $appdetialsfororg =[
            'name'            =>  $appDetails->proposedName,
            'category'                   =>  $appDetails->category,
            'levelId'                  =>  $appDetails->levelId,
            'dzongkhagId'                =>  $request->dzongkhagId,
            'gewogId'                =>  $request->gewogId,
            'chiwogId'                =>  $request->chiwogId,
            'locationId'                =>  $request->locationId,
            'isGeopoliticallyLocated'    =>  $request->isGeopoliticallyLocated,
            'isSenSchool'                =>  $request->isSenSchool,
            'parentSchoolId'                =>  $request->parentSchoolId,
            'isColocated'                 =>  $request->isColocated,
            'updated_by'                =>  $request->user_id,
        ];
        $establishment = OrganizationDetails::where('id', $appDetails->organizationId)->update($appdetialsfororg);
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
        // $response_data->level=Level::where('id',$response_data->levelId)->first()->name;
        // $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        return $this->successResponse($response_data);
    }

    /**
     * method to load curent proprietor organization details
     */
    public function loadCurrentProprietorDetails($orgId=""){
        return $this->successResponse(OrganizationProprietorDetails::where('id',$orgId)->first());
    }
}
