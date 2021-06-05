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
use App\Models\HistoryForOrganizaitonDetail;
use App\Models\OrganizationProprietorDetails;
use App\Models\OrganizationClassStream;
use App\Models\ApplicationSequence;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\Masters\Classes;
use App\Models\Masters\Stream;
use App\Models\establishment\ApplicationAttachments;
use App\Models\establishment\ApplicationNoMeals;
use App\Models\OrganizationFeedingDetails;
use App\Models\OrganizationProprietorDetailsHistory;
use App\Models\OrganizationClassStreamHistory;
use App\Models\OrganizationSectionHistory;
use App\Models\generalInformation\SectionDetails;
 

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
        if($request->action_type!="edit"){
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
                case "autonomus_change" : {
                    $change_details_data = $this->extractAutomonusData($request, $applicationDetailsId);
                    break;
                }
                case "location_type_change" : {
                    $change_details_data = $this->extractLocationData($request, $applicationDetailsId);
                    break;
                }
                case "expension_change" : {
                    $change_details_data = $this->extractExtensionData($request, $applicationDetailsId);
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
        }
        else{
            if($request['application_type']=="name_change"){
                $data =[
                    'proposedChange'           =>  $request['proposedName'],
                    'initiatedBy'              =>  $request['initiatedBy'],
                ];
                $changeDetails = ApplicationEstDetailsChange::where('id',$request->id)->update($data);
                $inserted_application_data= ApplicationEstDetailsChange::where('id',$request->id)->first();
            }

            if($request['application_type']=="level_change"){
                $data =[
                    'proposedChange'           =>  $request['level'],
                ];
                $changeDetails = ApplicationEstDetailsChange::where('id',$request->app_level_change_id)->update($data);

                if($request->class){
                    ApplicationClassStream::where('ApplicationDetailsId',$request->app_level_change_id)->delete();
                    foreach($request->class as $key => $classId){
                        $stream_exists = $this->checkStreamExists($classId);
                        if(empty($stream_exists)){
                            $classStream = [
                                'ApplicationDetailsId'  => $request->app_level_change_id,
                                'classId'               => $classId,
                                'streamId'              => '',
                                'created_by'            => $request->user_id,
                                'created_at'            => date('Y-m-d h:i:s'),
                            ];
                            $class = ApplicationClassStream::create($classStream);
                        } 
                    }
                }
                
                if($request->stream!=null && $request->stream!=""){
                    foreach($request->stream as $key2 => $classStreamId){
                        $class_stream_data = $this->getClassStreamId($classStreamId);
                        foreach($class_stream_data as $v){
                            $classStream = [
                                'ApplicationDetailsId'  => $request->app_level_change_id,
                                'classId'               => $v->classId,
                                'streamId'              => $v->streamId,
                                'created_by'            => $request->user_id,
                                'created_at'            => date('Y-m-d h:i:s'),
                            ];
                            $class = ApplicationClassStream::create($classStream);
                        }
                    }
                }
                $inserted_application_data= ApplicationEstDetailsChange::where('id',$request->app_level_change_id)->first();
            }
            if($request['application_type']=="sen_change"){
                $data =[
                    'proposedChange'           =>  $request['senSchool'],
                ];
                $changeDetails = ApplicationEstDetailsChange::where('id',$request->id)->update($data);
                $inserted_application_data= ApplicationEstDetailsChange::where('id',$request->id)->first();
            }
            if($request['application_type']=="location_type_change"){
                $data =[
                    'proposedChange'           =>  $request['locationType'],
                ];
                $changeDetails = ApplicationEstDetailsChange::where('id',$request->id)->update($data);
                $inserted_application_data= ApplicationEstDetailsChange::where('id',$request->id)->first();
            }
            if($request['application_type']=="feeding_change"){
                $data =[
                    'proposedChange'               =>  $request['isfeedingschool'],
                ];
                $changeDetails = ApplicationEstDetailsChange::where('id',$request->id)->update($data);
                if($request->isfeedingschool==1 && sizeof($request->feeding)>0 ){
                    ApplicationNoMeals::where( 'foreignKeyId', $request->id)->delete();
                    foreach($request->feeding as $feed){
                        $data =[
                            'noOfMeals'                 =>  $feed,
                            'foreignKeyFor'             => 'application_est_public',
                            'foreignKeyId'              =>  $request->id,
                            'created_by'                =>  $request->user_id,
                            'created_at'                =>  date('Y-m-d h:i:s')
                        ];
                        ApplicationNoMeals::create($data);
                    }
                }
                $inserted_application_data= ApplicationEstDetailsChange::where('id',$request->id)->first();
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
            'ApplicationDetailsId'     =>  $applicationDetailsId,
            'organizationId'           =>  $request['organizationId'],
            'change_type'              =>  $request['application_for'],
            'proposedChange'           =>  $request['proposedName'],
            'initiatedBy'              =>  $request['initiatedBy'],
            'created_by'               =>  $request['user_id']  
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
        if($request->isfeedingschool==1 && sizeof($request->feeding)>0 ){
            foreach($request->feeding as $feed){
                $data =[
                    'noOfMeals'                 =>  $feed,
                    'foreignKeyFor'             => 'application_est_public',
                    'foreignKeyId'              =>  $changeDetails->id,
                    'created_by'                =>  $request->user_id,
                    'created_at'                =>  date('Y-m-d h:i:s')
                ];
                ApplicationNoMeals::create($data);
            }
        }

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

        if($request->class){
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
    
    private function extractAutomonusData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'          => $applicationDetailsId,
            'organizationId'                =>  $request['organizationId'],
            'change_type'                   =>  $request['application_for'],
            'proposedChange'               =>  $request['autonomuos'],
            'created_by'                   =>  $request['user_id'] 
        ];

        $changeDetails = ApplicationEstDetailsChange::create($data);

        return $changeDetails;
    }
    
    private function extractLocationData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'          => $applicationDetailsId,
            'organizationId'                =>  $request['organizationId'],
            'change_type'                   =>  $request['application_for'],
            'proposedChange'               =>  $request['locationType'],
            'created_by'                   =>  $request['user_id'] 
        ];

        $changeDetails = ApplicationEstDetailsChange::create($data);

        return $changeDetails;
    }
    
    private function extractExtensionData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'          => $applicationDetailsId,
            'organizationId'                =>  $request['organizationId'],
            'change_type'                   =>  $request['application_for'],
            'proposedChange'                =>  $request['currentCapacity'],
            'changeInDetails'               =>  $request['proposedCapacity'],
            'created_by'                    =>  $request['user_id'] 
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

    public function getChangeBasicDetails($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        if($response_data!="" && $response_data!=null){
            $change_det=ApplicationEstDetailsChange::where('ApplicationDetailsId',$response_data->id)->first();
            $response_data->change_details= $change_det;
            $change_class=ApplicationClassStream::where('ApplicationDetailsId',$change_det->id)->get();
            $calss_data = DB::table('classes as c')
            ->join('application_class_stream as cl', 'c.id', '=', 'cl.classId')
            ->select('cl.*', 'c.class', 'c.id AS classId')
            ->where('cl.ApplicationDetailsId',$change_det->id)
            ->orderBy('c.displayOrder', 'asc')
            ->get();
            $response_data->change_class_details=  $calss_data;
            $feed_det=ApplicationNoMeals::where('foreignKeyId',$change_det->id)->get();;
            $response_data->feed_det= $feed_det;
        }
        return $this->successResponse($response_data); 
    }

    public function loadChangeDetailForVerification($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        if($response_data!="" && $response_data!=null){
            // $response_data->attachments=ApplicationAttachments::where('ApplicationDetailsId',$response_data->id)->whereIn('upload_type', ['Verification','Approval'])->get();
            $change_det=ApplicationEstDetailsChange::where('ApplicationDetailsId',$response_data->id)->first();
            $response_data->change_details= $change_det;
            $response_data->category=OrganizationDetails::where('id',$response_data->change_details->organizationId)->first()->category;
            if($response_data->application_type=="feeding_change"){ 
                $response_data->change_feeding=ApplicationNoMeals::where('foreignKeyId',$change_det->id)->get();
            }
            if($response_data->application_type=="proprietor_change"){
                $response_data->change_prop=ApplicationProprietorDetails::where('ApplicationEstDetailsChangeId',$change_det->id)->first();
            }
            if($response_data->application_type=="level_change"){
                $response_data->change_classes = DB::table('classes as c')
                ->join('application_class_stream as cl', 'c.id', '=', 'cl.classId')
                ->select('cl.*', 'c.class', 'c.id AS classId')
                ->where('cl.ApplicationDetailsId',$change_det->id)
                ->orderBy('c.displayOrder', 'asc')
                ->get();
                // $response_data->change_classes=ApplicationClassStream::where('ApplicationDetailsId',$change_det->id)->get();
            }
            // if($response_data=="Change in Level"){
                
            // }
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

    public function updateChangeBasicDetails(Request $request){
        // dd($app_details->application_type);
        $estd =[
            'status'                        =>   $request->status,
            'remarks'                       =>   $request->remarks,
            'updated_by'                    =>   $request->user_id, 
        ];
        ApplicationDetails::where('application_no', $request->application_number)->update($estd);
       
        if($request->attachment_details!="" ){
            $type="Verification";
            if($request->status=="Approved"){
                $type="Approval";
            }
            if(sizeof($request->attachment_details)>0){
                $application_details=  ApplicationDetails::where('application_no',$request->application_number)->first();
                foreach($request->attachment_details as $att){
                    $attach =[
                        'ApplicationDetailsId'      =>  $application_details->id,
                        'path'                      =>  $att['path'],
                        'user_defined_file_name'    =>  $att['user_defined_name'],
                        'name'                      =>  $att['original_name'],
                        'upload_type'               =>  $type,
                        'created_by'                =>  $request->user_id, 
                    ];
                    $doc = ApplicationAttachments::create($attach);
                }
            }
        }

        $app_details = ApplicationDetails::where('application_no', $request->application_number)->first();
        // return $app_details;
        if($request->status=="Approved"){
            $change_details=ApplicationEstDetailsChange::where('ApplicationDetailsId',$app_details->id)->first();
            $org_details=OrganizationDetails::where('id',$change_details->organizationId)->first();
            $change_details_data="";
            switch($app_details->application_type){
                case "name_change" : {
                    $change_details_data = $this->updateNameChange($change_details,  $org_details, $request);
                    break;
                }
                case "sen_change" : {
                    $change_details_data = $this->updateSenDetails($change_details,  $org_details, $request);
                    break;
                }
                case "feeding_change" : {
                    $change_details_data = $this->updateFeedingDetails($change_details,  $org_details, $request);
                    break;
                }
                case "proprietor_change" : {
                    $change_details_data = $this->updateProprietor($change_details,  $org_details, $request);
                    break;
                }
                case "level_change" : {
                    $change_details_data = $this->updateLevel($change_details,  $org_details, $request);
                    break;
                }
                case "location_type_change" : {
                    $change_details_data = $this->updateLocationType($change_details,  $org_details, $request);
                    break;
                }
                case "expension_change" : {
                    $change_details_data = $this->updateExtension($change_details,  $org_details, $request);
                    break;
                }
                case "autonomus_change" : {
                    $change_details_data = $this->updateAutonomous($change_details,  $org_details, $request);
                    break;
                }
                // case "" : {
                //     $change_details_data = $this->extractAutomonusData($request, $applicationDetailsId);
                //     break;
                // }
                // case "" : {
                //     $change_details_data = $this->extractLocationData($request, $applicationDetailsId);
                //     break;
                // }
                // case "" : {
                //     $change_details_data = $this->extractExtensionData($request, $applicationDetailsId);
                //     break;
                // }
                // case "all_details" : {
                //     $change_details_data = $this->extractAllChangeData($request, $applicationDetailsId);
                //     break;
                // }
                default : {
                    break;
                }
            }
        }
        return $this->successResponse($change_details_data, Response::HTTP_CREATED);
    }

    private function updateNameChange($change_details, $org_details,$request){
        // return $change_details->proposedChange;
        $org_data =[
            'id'                        =>  $org_details->id,
            'name'                      =>  $org_details->name,
            'updated_by'                =>  $org_details->updated_by,
            'updated_at'                =>  $org_details->updated_at,
            'recorded_on'               =>  date('Y-m-d h:i:s'),
            'recorded_for'              =>  'Name Change', 
            'recorded_by'               =>  $request->user_id, 
        ];
        HistoryForOrganizaitonDetail::create($org_data);
        $org_update_data =[
            'name'                      =>  $change_details->proposedChange,
            'updated_by'                =>  date('Y-m-d h:i:s'),
            'updated_at'                =>  $request->user_id, 
        ];
        $change_details=OrganizationDetails::where('id',$change_details->organizationId)->update($org_update_data);

        return $change_details;

    }
    
    private function updateSenDetails($change_details, $org_details,$request){
        $org_data =[
            'id'                        =>  $org_details->id,
            'isSenSchool'               =>  $org_details->isSenSchool,
            'updated_by'                =>  $org_details->updated_by,
            'updated_at'                =>  $org_details->updated_at,
            'recorded_on'               =>  date('Y-m-d h:i:s'),
            'recorded_for'              =>  'Change in SEN Details', 
            'recorded_by'               =>  $request->user_id, 
        ];
        HistoryForOrganizaitonDetail::create($org_data);
        $org_update_data =[
            'isSenSchool'               =>  $change_details->proposedChange,
            'updated_by'                =>  date('Y-m-d h:i:s'),
            'updated_at'                =>  $request->user_id, 
        ];
        $change_details=OrganizationDetails::where('id',$change_details->organizationId)->update($org_update_data);
        return $change_details;

    }
    
    private function updateFeedingDetails($change_details, $org_details,$request){
        $feed_det=OrganizationFeedingDetails::where('organizationId',$change_details->organizationId)->get();
        $feedings="";
        if($feed_det!="" && sizeof($feed_det)>0){
            foreach($feed_det as $i=> $fed){
                if($i+1==sizeof($feed_det)){
                    $feedings.=$fed['noOfMeals'];
                    break;
                }
                $feedings.=$fed['noOfMeals'].', ';
            }
        }
        $org_data=[
            'id'                        =>  $org_details->id,
            'isFeedingSchool'           =>  $org_details->isFeedingSchool,
            'feeding_details'           =>  $feedings,
            'updated_by'                =>  $org_details->updated_by,
            'updated_at'                =>  $org_details->updated_at,
            'recorded_on'               =>  date('Y-m-d h:i:s'),
            'recorded_for'              =>  'Change in SEN Details', 
            'recorded_by'               =>  $request->user_id, 
        ];
        HistoryForOrganizaitonDetail::create($org_data);
        $org_update_data =[
            'isFeedingSchool'           =>  $change_details->proposedChange,
            'updated_by'                =>  date('Y-m-d h:i:s'),
            'updated_at'                =>  $request->user_id, 
        ];
        $change_details=OrganizationDetails::where('id',$change_details->organizationId)->update($org_update_data);
        if( $change_details->proposedChange==1){
            OrganizationFeedingDetails::where('organizationId',$change_details->organizationId)->delete();
            $app_meals=ApplicationNoMeals::where('foreignKeyId',$change_details->id)->get();
            if($app_meals!="" && sizeof($app_meals)>0){
                foreach($app_meals as $meal){
                    $meal_data=[
                        'organizationId'    =>  $change_details->organizationId,
                        'noOfMeals'         => $meal['noOfMeals'],
                    ];
                    OrganizationFeedingDetails::create($meal_data);
                }
            }
        }
        return $change_details;

    }

    private function updateProprietor($change_details, $org_details,$request){
        $current_proprioter=OrganizationProprietorDetails::where('organizationId',$change_details->organizationId)->first();              
        if($current_propriote!="" && $current_propriote!=""){
            $pro_det= [
                'id'                =>  $prop['id'],
                'organizationId'    =>  $prop['organizationId'],
                'cid'               =>  $prop['cid'],
                'fullName'          =>  $prop['fullName'],
                'phoneNo'           =>  $prop['phoneNo'],
                'mobileNo'          =>  $prop['mobileNo'],
                'email'             =>  $prop['email'],
                'created_by'        =>  $prop['created_by'],
                'updated_by'        =>  $prop['updated_by'],
                'recorded_on'       =>  date('Y-m-d h:i:s'),
                'recorded_by'       =>  $request->user_id,
            ];
            OrganizationProprietorDetailsHistory::create($pro_det);
            OrganizationProprietorDetails::where('organizationId',$change_details->organizationId)->delete();              
        }
        $app_prop=ApplicationProprietorDetails::where('ApplicationEstDetailsChangeId',$change_details->id)->fist();
        $prop_data =[
            'organizationId'        => $change_details->organizationId,
            'fullName'              => $app_prop->proposedName,
            'cid'                   => $app_prop->proprietorCid,
            'mobileNo'              => $app_prop->proprietorMobile,
            'phoneNo'               => $app_prop->proprietorPhone,
            'email'                 => $app_prop->proprietorEmail,
        ];
        $propDetails = OrganizationProprietorDetails::create($prop_data);
        return $propDetails;
    }
    
    private function updateLevel($change_details, $org_details,$request){
        $org_data=[
            'id'                        =>  $org_details->id,
            'levelId'                   =>  $org_details->levelId,
            'updated_by'                =>  $org_details->updated_by,
            'updated_at'                =>  $org_details->updated_at,
            'recorded_on'               =>  date('Y-m-d h:i:s'),
            'recorded_for'              =>  'Change in Level', 
            'recorded_by'               =>  $request->user_id, 
        ];
        HistoryForOrganizaitonDetail::create($org_data);
        $org_update_data =[
            'levelId'                   =>  $change_details->proposedChange,
            'updated_by'                =>  date('Y-m-d h:i:s'),
            'updated_at'                =>  $request->user_id, 
        ];
        OrganizationDetails::where('id',$change_details->organizationId)->update($org_update_data);

        $ex_clas=OrganizationClassStream::where('organizationId',$change_details->organizationId)->get();
        if($ex_clas!="" && sizeof($ex_clas)>0){
            foreach($ex_clas as $cls){
                $cls_data=[
                    'id'                =>  $cls['id'],
                    'organizationId'    =>  $cls['organizationId'],
                    'classId'           =>  $cls['classId'],
                    'streamId'          =>  $cls['streamId'],
                    'created_by'        =>  $cls['created_by'],
                    'updated_by'        =>  $cls['updated_by'],
                    'recorded_for'      =>  'Change in Level',
                    'recorded_on'       =>  date('Y-m-d h:i:s'),
                    'recorded_by'       =>  $request->user_id 
                ];
                OrganizationClassStreamHistory::create($cls_data);
            }
            $org_section=OrganizationClassStream::where('organizationId',$change_details->organizationId)->get();
            if($org_section!="" && sizeof($org_section)>0){
                foreach($org_section as $orgCls){
                    $sections=SectionDetails::where('classSectionId',$orgCls['id'])->get();
                    if($sections!="" && sizeof($sections)>0){
                        foreach($sections as $sec){
                            $sec_data=[
                                'id'                =>  $sec['id'],
                                'classSectionId'    =>  $sec['classSectionId'],
                                'section'           =>  $sec['section'],
                                'created_by'        =>  $sec['created_by'],
                                'created_at'        =>  $sec['created_at'],
                                'updated_at'        =>  $sec['updated_at'],
                                'updated_by'        =>  $sec['updated_by'],
                                'recorded_for'      =>  'Change in Level',
                                'recorded_on'       =>  date('Y-m-d h:i:s'),
                                'recorded_by'       =>  $request->user_id 
                            ];
                            OrganizationSectionHistory::create($sec_data);
                        }
                    }
                    SectionDetails::where('classSectionId',$orgCls['id'])->delete();
                }
            }
            OrganizationClassStream::where('organizationId',$change_details->organizationId)->delete();
        }
        $class_strm=ApplicationClassStream::where('ApplicationDetailsId',$change_details->id)->get();
        if($class_strm!="" && sizeof($class_strm)>0){
            foreach($class_strm as $cls){
                $cls_data=[
                    'organizationId'    =>  $change_details->organizationId,
                    'classId'           =>  $cls['classId'],
                    'streamId'          =>  $cls['streamId'],
                    'updated_by'        =>  $request->user_id, 
                ];
                OrganizationClassStream::create($cls_data);
            }
        }
        return $class_strm;
    }
    
    private function updateLocationType($change_details, $org_details,$request){
        $org_data =[
            'id'                        =>  $org_details->id,
            'locationId'                =>  $org_details->locationId,
            'updated_by'                =>  $org_details->updated_by,
            'updated_at'                =>  $org_details->updated_at,
            'recorded_on'               =>  date('Y-m-d h:i:s'),
            'recorded_for'              =>  'Change in Location', 
            'recorded_by'               =>  $request->user_id, 
        ];
        HistoryForOrganizaitonDetail::create($org_data);
        $org_update_data =[
            'locationId'               =>  $change_details->proposedChange,
            'updated_by'                =>  date('Y-m-d h:i:s'),
            'updated_at'                =>  $request->user_id, 
        ];
        $change_details=OrganizationDetails::where('id',$change_details->organizationId)->update($org_update_data);
        return $change_details;

    }
    private function updateExtension($change_details, $org_details,$request){
        $org_data =[
            'id'                        =>  $org_details->id,
            'capacity'                  =>  $org_details->capacity,
            'updated_by'                =>  $org_details->updated_by,
            'updated_at'                =>  $org_details->updated_at,
            'recorded_on'               =>  date('Y-m-d h:i:s'),
            'recorded_for'              =>  'Change in Location', 
            'recorded_by'               =>  $request->user_id, 
        ];
        HistoryForOrganizaitonDetail::create($org_data);
        $org_update_data =[
            'capacity'               =>  $change_details->changeInDetails,
            'updated_by'                =>  date('Y-m-d h:i:s'),
            'updated_at'                =>  $request->user_id, 
        ];
        $change_details=OrganizationDetails::where('id',$change_details->organizationId)->update($org_update_data);
        return $change_details;

    }
}
