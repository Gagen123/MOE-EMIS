<?php

namespace App\Http\Controllers\establishment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\Masters\RoadType;
use App\Models\Masters\Classes;
use App\Models\Masters\Stream;
use App\Models\Masters\ElectricitySource;
use App\Models\Masters\ServiceProvider;
use App\Models\ContactDetails;
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationClassStream;
use App\Models\establishment\ApplicationProprietorDetails;
use App\Models\generalInformation\Connectivity;
use App\Models\generalInformation\Locations;
use App\Models\generalInformation\Section;
use App\Models\generalInformation\SectionDetails;
use App\Models\generalInformation\LocationDisasterRisk;
use App\Models\ApplicationSequence;
use App\Models\OrganizationDetails;
use App\Models\OrganizationFeedingDetails;
use App\Models\OrganizationProprietorDetails;
use App\Models\OrganizationClassStream;
use App\Models\OrgProfile;
use App\Models\OrganizaitonSenModule;
use App\Models\HistoryForOrganizaitonDetail;
use App\Models\establishment\HeadQuaterDetails;
use App\Models\establishment\ApplicationEstPublic;
use App\Models\establishment\ApplicationEstPrivate;
use App\Models\establishment\ApplicationVerification;
use App\Models\establishment\ApplicationNoMeals;
use App\Models\establishment\ApplicationVerificationTeam;
use App\Models\establishment\ApplicationAttachments;
use App\Models\establishment\ApplicationEstDetailsChange;
use App\Models\restructuring\Bifurcation;

class EstablishmentController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    /**
     * method to get level in dropdown
     */
    public function getLevelInDropdown(){
        return Level::where('status',1)->get();
    }

    /**
     * method to get location in dropdown
     */
    public function getLocationInDropdown(){
        return Location::where('status',1)->get();
    }

    /**
     * method to save new establishment details
     */
    public function saveEstablishment(Request $request){
        $id = $request->id;

        /**
         * First Fill in the application details table and get id
         * Application Details Table Id will be foreign key to other tables
         *
         * Does not use insertData function as we need the last insert id
         */
        if($request['action_type']=="edit"){
            return $this->editEstablishment($request);
        }
        else{
            $application_details_data = $this->extractApplicationDetailsData($request);
            switch($request['establishment_type']){
                case "public_school" : {
                        $establishment_data = $this->extractPublicEstDetailsData($request, $application_details_data->id);
                        $dataModel = 'ApplicationEstPublic';
                        break;
                    }
                case "private_school" : {
                        $establishment_data = $this->extractPrivateEstDetailsData($request, $application_details_data->id);
                        $dataModel = 'ApplicationEstPrivate';
                        break;
                    }
                case "public_eccd" : {
                        $establishment_data = $this->extractPublicEstDetailsData($request, $application_details_data->id);
                        $dataModel = 'ApplicationEstPublic';
                        break;
                    }
                case "private_eccd" : {
                        $establishment_data = $this->extractPrivateEstDetailsData($request, $application_details_data->id);
                        $dataModel = 'ApplicationEstPrivate';
                        break;
                    }
                case "public_ecr" : {
                        $establishment_data = $this->extractPublicEstDetailsData($request, $application_details_data->id);
                        $dataModel = 'ApplicationEstPublic';
                        break;
                    }
                default : {

                    break;
                }
            }

            //Delete previous application details and recreate for editing record
            if($request['ap_estb_id']!=""){
                $modelName = "App\\Models\\establishment\\"."$dataModel";
                $model = new $modelName();
                $response_data = $model::where('id',$request['ap_estb_id'])->delete();

                $modelName = "App\\Models\\establishment\\ApplicationNoMeals";
                $model = new $modelName();
                $response_data = $model::where('foreignKeyId',$request['ap_estb_id'])->delete();
            }
            $response_data = $this->insertData($establishment_data, $dataModel);
            $response_data->applicaiton_details=$application_details_data;
            if($request->isfeedingschool==1 && sizeof($request->feeding)>0 ){
                foreach($request->feeding as $feed){
                    $data =[
                        'noOfMeals'                 =>  $feed,
                        'foreignKeyFor'             => 'application_est_public',
                        'foreignKeyId'              =>  $response_data->id,
                        'created_by'                =>  $request->user_id,
                        'created_at'                =>  date('Y-m-d h:i:s')
                    ];
                    $this->insertData($data, 'ApplicationNoMeals');
                }
            }
            return $this->successResponse($response_data, Response::HTTP_CREATED);
        }
    }

    /**
     * Extract the Basic Application Details
     */

    private function extractApplicationDetailsData($request){
        $data =[
            'establishment_type'   =>  $request['proposed_establishment'],
            'category'             =>  $request['category'],
            'dzongkhagId'          =>  $request['dzongkhag'],
            'gewogId'              =>  $request['gewog'],
            'chiwogId'             =>  $request['chiwog'],
            'application_type'     =>  $request['level'],
            'year'                 =>  $request['year'],
            'status'               =>  $request['status'],
            'remarks'              =>  $request['remarks'],
        ];
        if($request['app_id']!=null && $request['app_id']!="null" || $request['app_id']!=""){
            ApplicationDetails::where('id',$request['app_id'])->update($data);
            $inserted_application_data = ApplicationDetails::where('id',$request['app_id'])->first();
        }
        else{
            $data =$data+[
                'application_no'       =>  $this->generateApplicationNo(),
                'created_by'           =>  $request['user_id'],
                'created_at'           =>  date('Y-m-d h:i:s')
            ];
            $inserted_application_data = ApplicationDetails::create($data);
        }
        return $inserted_application_data;

    }
     /**
     * edit Application Details
     */

    private function editEstablishment($request){
        $data =[
            'establishment_type'   =>  $request['proposed_establishment'],
            'category'             =>  $request['category'],
            'dzongkhagId'          =>  $request['dzongkhag'],
            'gewogId'              =>  $request['gewog'],
            'chiwogId'             =>  $request['chiwog'],
            'application_type'     =>  $request['level'],
            'updated_by'           =>  $request['user_id'],
            'updated_at'           =>  date('Y-m-d h:i:s')
        ];
        ApplicationDetails::where('application_no',$request['application_number'])->update($data);
        $response_data=ApplicationDetails::where('application_no',$request['application_number'])->first();

        if($request['establishment_type']=="public_school" || $request['establishment_type']=="public_eccd" || $request['establishment_type']=="public_ecr"){
            $org_data=[
                'proposedName'                  =>  $request['proposedName'],
                'initiated_by'                  =>  $request['initiatedBy'],
                'levelId'                       =>  $request['level'],               //edited from 'level'     =>  $request['level']
                'locationId'                    =>  $request['locationType'],        //edited from 'locationTypeId'    =>  $request['locationType'],
                'isGeoPoliticallyLocated'       =>  $request['geopoliticallyLocated'],
                'isSenSchool'                   =>  $request['senSchool'],
                'isFeedingschool'               =>  $request['isfeedingschool'],
                'updated_at'                    =>  date('Y-m-d h:i:s'),
                'isSenSchool'                   =>  $request['senSchool'],
                'coLocatedParent'               =>  $request['coLocatedParent'],
                'parentSchool'                  =>  $request['parentSchool'],
                'proposedLocation'              =>  $request['proposedLocation'],

            ];
            ApplicationEstPublic::where('ApplicationDetailsId',$response_data->id)->update($org_data);
            $app_det=ApplicationEstPublic::where('ApplicationDetailsId',$response_data->id)->first();
            ApplicationNoMeals::where('foreignKeyFor','application_est_public')->where('foreignKeyId',$app_det->id)->delete();
            if($request['isfeedingschool']==1){
                foreach($request->feeding as $feed){
                    $data =[
                        'noOfMeals'                 =>  $feed,
                        'foreignKeyFor'             => 'application_est_public',
                        'foreignKeyId'              =>  $app_det->id,
                        'created_by'                =>  $request->user_id,
                        'created_at'                =>  date('Y-m-d h:i:s')
                    ];
                    ApplicationNoMeals::create($data);
                }
            }
        }
        if($request['establishment_type']=="private_school" || $request['establishment_type']=="private_eccd"){
            $data =[
                'proposedName'                 =>  $request['proposedName'],
                'proprietorName'               =>  $request['proprietorName'],
                'proprietorCid'                =>  $request['proprietorCid'],
                'proprietorPhone'              =>  $request['proprietorPhone'],
                'proprietorMobile'             =>  $request['proprietorMobile'],
                'proprietorEmail'              =>  $request['proprietorEmail'],
                // 'totalLand'                    =>  $request['totalLand'],
                // 'enrollmentBoys'               =>  $request['enrollmentBoys'],
                // 'enrollmentGirls'              =>  $request['enrollmentGirls'],
                'proposedLocation'             =>  $request['proposedLocation'],
                'typeOfSchool'                 =>  $request['typeOfSchool'],
                'proposedInfrastructure'       =>  $request['proposedInfrastructure'],
                'coLocatedParent'              =>  $request['coLocatedParent'],
                'parentSchool'                 =>  $request['parentSchool'],
                'levelId'                      =>  $request['level'],
            ];
            // dd($data);
            ApplicationEstPrivate::where('ApplicationDetailsId',$response_data->id)->update($data);
            $app_det=ApplicationEstPrivate::where('ApplicationDetailsId',$response_data->id)->first();
        }
        return $app_det;
    }

    /**
     * Extract Application Details for public establishments
     */

    private function extractPublicEstDetailsData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'         =>  $applicationDetailsId,
            'proposedName'                 =>  $request['proposedName'],
            'initiated_by'                 =>  $request['initiatedBy'],
            'levelId'                      =>  $request['level'],               //edited from 'level'     =>  $request['level']
            'locationId'                   =>  $request['locationType'],        //edited from 'locationTypeId'    =>  $request['locationType'],
            'isGeoPoliticallyLocated'      =>  $request['geopoliticallyLocated'],
            'isSenSchool'                  =>  $request['senSchool'],
            'isFeedingSchool'              =>  $request['isfeedingschool'],
            'coLocatedParent'              =>  $request['coLocatedParent'],
            'parentSchool'                 =>  $request['parentSchool'],
            'proposedLocation'             =>  $request['proposedLocation'],
            'created_at'                   =>  date('Y-m-d h:i:s')
        ];
        return $data;
    }

    /**
     * Extract Application Details for private establishments
     */

    private function extractPrivateEstDetailsData($request, $applicationDetailsId){
        $data =[
            'ApplicationDetailsId'         =>  $applicationDetailsId,
            'proposedName'                 =>  $request['proposedName'],
            'proprietorName'               =>  $request['proprietorName'],
            'proprietorCid'                =>  $request['proprietorCid'],
            'proprietorPhone'              =>  $request['proprietorPhone'],
            'proprietorMobile'             =>  $request['proprietorMobile'],
            'proprietorEmail'              =>  $request['proprietorEmail'],
            // 'totalLand'                    =>  $request['totalLand'],
            // 'enrollmentBoys'               =>  $request['enrollmentBoys'],
            // 'enrollmentGirls'              =>  $request['enrollmentGirls'],
            'proposedLocation'             =>  $request['proposedLocation'],
            'typeOfSchool'                 =>  $request['typeOfSchool'],
            'levelId'                      =>  $request['level'],
            'proposedInfrastructure'       =>  $request['proposedInfrastructure'],
            'coLocatedParent'              =>  $request['coLocatedParent'],
            'parentSchool'                 =>  $request['parentSchool'],
            'created_at'           =>  date('Y-m-d h:i:s')
        ];

        return $data;
    }

    /**
     * Extract Application Details for no of meals
     */

    private function extractNoMealsData($request){
        $data =[
            //enter data
        ];

        return $data;
    }

    /**
     * Function to insert data into the respective tables
     */

    private function insertData($data, $databaseModel){

        $modelName = "App\\Models\\establishment\\"."$databaseModel";
        $model = new $modelName();

        $response_data = $model::create($data);

        return $response_data;
    }


    /**
     * Generate the application no
     */

    private function generateApplicationNo(){
        $last_seq=ApplicationSequence::where('service_name','New Establishment')->first();

        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'New Establishment',
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::where('service_name', 'New Establishment')->update($app_details);
        }
        $application_no='Estb-';
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
     * method to save class and stream
     */
    public function saveClassStream(Request $request){
        $classStream='';
        $application_details= ApplicationDetails::where('application_no', $request->application_number)->first();
        ApplicationClassStream::where('ApplicationDetailsId', $application_details->id)->delete();
        // return $request->class;
        if($request->class){
            foreach($request->class as $key => $classId){
                // $stream_exists = $this->checkStreamExists($classId);
                // if(empty($stream_exists)){
                $classStream = [
                    'ApplicationDetailsId'  => $application_details->id,
                    'classId'               => $classId,
                    'streamId'              => '',
                    'created_by'            => $request->user_id,
                    'created_at'            => date('Y-m-d h:i:s'),
                ];
                $class = ApplicationClassStream::create($classStream);
                // }
            }
        }

        if($request->stream!=null && $request->stream!=""){
            foreach($request->stream as $key2 => $classStreamId){
                $class_stream_data = $this->getClassStreamId($classStreamId);
            //    return $class_stream_data;
                foreach($class_stream_data as $v){
                    $classStream = [
                        'ApplicationDetailsId'  => $application_details->id,
                        'classId'               => $v->classId,
                        'streamId'              => $v->streamId,
                        'created_by'            => $request->user_id,
                        'created_at'            => date('Y-m-d h:i:s'),
                    ];
                    // return $classStream;
                    $class = ApplicationClassStream::create($classStream);
                }
            }
        }
        $application_details= ApplicationDetails::where('application_no', $request->application_number)->first();

        return $this->successResponse($application_details, Response::HTTP_CREATED);
    }

    public function saveUploadedFiles(Request $request){
        $doc="";
        if($request->attachment_details!=null && $request->attachment_details!=""){
            $application_details=  ApplicationDetails::where('application_no',$request['application_number'],)->first();
            foreach($request->attachment_details as $att){
                $attach =[
                    'ApplicationDetailsId'      =>  $application_details->id,
                    'path'                      =>  $att['path'],
                    'user_defined_file_name'    =>  $att['user_defined_name'],
                    'name'                      =>  $att['original_name'],
                    'updoad_type'               =>  'Applicant',
                ];
                $doc = ApplicationAttachments::create($attach);
            }
        }
        if($request['update_type']=="Document Update"){
            $array =[
                'status'                       =>   "Document Updated",
                'remarks'                      =>   $request->remarks,
                'updated_by'                   =>   $request->user_id,
                'updated_at'                   =>   date('Y-m-d h:i:s'),
            ];
            ApplicationDetails::where('application_no', $request->application_number)->update($array);
        }
        else{
            $array =[
                'status'                       =>   $request->status,
                'applicant_remarks'            =>   $request->remarks,
            ];
            DB::table('application_details')->where('application_no',$request->application_number)->update($array);
        }
        return $doc;
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

    /**
     * method to get class in checkbox
     */
    public function getClass(){
        return Classes::where('status',1)->get();
    }

    /**
     * method to get stream in checkbox
     */
    public function getStream(){
        return Stream::where('status',1)->get();
    }
    public function getClassMappingDetails($mapping_id=""){
        return OrganizationClassStream::where('id',$mapping_id)->first();
    }

    /**
     * method to load organization details
     */
    public function loadOrganizationDetails($user_id=""){
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('status','pending')->first());
    }

    //used in portal
    public function loadOrganizationDetailsbyOrgId($org_id){
        $response_data=ApplicationDetails::where('id',$org_id)->first();
        return $this->successResponse($response_data);


    }

    /**
     * method to load organization applications
     */
    public function loadOrgApplications($user_id="",$type=""){
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('status','<>','pending')->where('establishment_type',str_replace('_',' ',$type))->get());
    }


    /**
     * loading bifurcation, merger, closure and reopening
     */

    public function loadBifurcationApplications($user_id="",$dzo_id=""){
        return $this->successResponse(ApplicationDetails::where('dzongkhagId',$dzo_id)->where('application_no', 'like', 'Bif%')->get());
        //return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Ch-%')->where('establishment_type',str_replace('_',' ',$type))->get());
        // return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Ch-%')->get());
    }

    public function loadMergerApplications($user_id="",$dzo_id=""){
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Mer%')->get());
        //return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Ch-%')->where('establishment_type',str_replace('_',' ',$type))->get());
        // return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Ch-%')->get());
    }

    public function loadClosureApplications($user_id="",$dzo_id=""){
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Cls%')->get());
        //return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Ch-%')->where('establishment_type',str_replace('_',' ',$type))->get());
        // return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Ch-%')->get());
    }

    public function loadReopeningApplications($user_id="",$dzo_id=""){
        return $this->successResponse(ApplicationDetails::where('dzongkhagId',$dzo_id)->where('application_no', 'like', 'Reop%')->get());
        //return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Ch-%')->where('establishment_type',str_replace('_',' ',$type))->get());
        // return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Ch-%')->get());
    }

    /**
     * method to load organization details
     */
    public function loadProprietorDetails(){
        return $this->successResponse(ApplicationProprietorDetails::all());
    }

    public function loadEstbDetailsForVerification($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        $response_data->application_date=date_format(Carbon::parse($response_data->action_date), 'Y-m-d h:i:s');
        if($response_data->establishment_type=="Public School" || $response_data->establishment_type=="Public ECCD" || $response_data->establishment_type=="Public ECR"){
            $app_details=ApplicationEstPublic::where('ApplicationDetailsId',$response_data->id)->first();
            $response_data->org_details=$app_details;
            if($app_details->isFeedingSchool==1){
                $response_data->feeding_modality=ApplicationNoMeals::where('foreignKeyId',$app_details->id)->get();
            }
        }
        if($response_data->establishment_type=="Private School" || $response_data->establishment_type=="Private ECCD"){
            $response_data->org_details=ApplicationEstPrivate::where('ApplicationDetailsId',$response_data->id)->first();
        }
        $response_data->org_class_stream=
            DB::table('application_class_stream')
                ->join('classes', 'classes.id', '=', 'application_class_stream.classId')
                ->select('application_class_stream.*')
                ->where('application_class_stream.ApplicationDetailsId',$response_data->id)
                ->orderBy('classes.displayOrder')
                ->get();
        //ApplicationClassStream::where('ApplicationDetailsId',$response_data->id)->get();
        $response_data->attachments=ApplicationAttachments::where('ApplicationDetailsId',$response_data->id)->get();
        $response_data->app_verification=ApplicationVerification::where('ApplicationDetailsId',$response_data->id)->first();
        if($response_data!=null && $response_data!=""){
            $response_data->app_verification_team=ApplicationVerificationTeam::where('ApplicationVerificationId',$response_data->id)->get();
        }

        // $response_data->level=Level::where('id',$response_data->levelId)->first()->name;
        // $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        // $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        // $classSection=ApplicationClassStream::where('applicationNo',$appNo)->groupBy('classId')->get();
        // $sections=ApplicationClassStream::where('applicationNo',$appNo)->where('streamId','!=',null)->get();
        // foreach($classSection as $cls){
        //     $cls->class_name=ApplicationClassStream::where('id',$cls->classId)->first()->class;
        // }
        // $response_data->class_section=$classSection;
        return $this->successResponse($response_data);
    }

    public function updateEstablishment(Request $request){
        if($request->attachment_details!="" ){
            if(sizeof($request->attachment_details)>0){
                $application_details=  ApplicationDetails::where('application_no',$request->application_number)->first();
                foreach($request->attachment_details as $att){
                    $attach =[
                        'ApplicationDetailsId'      =>  $application_details->id,
                        'path'                      =>  $att['path'],
                        'user_defined_file_name'    =>  $att['user_defined_name'],
                        'name'                      =>  $att['original_name'],
                        'upload_type'               =>  $request->update_type,
                    ];
                    $doc = ApplicationAttachments::create($attach);
                }
            }
        }
        $status=$request->status;
        if($request->update_type=="tentative"){
            $verification =[
                'ApplicationDetailsId'        =>   $request->id,
                'verifyingAgency'             =>   $request->verifying_agency,
                'tentativeDate'               =>   $request->tentative_date,
                'remarks'                     =>   $request->remarks,
                'created_by'                  =>   $request->user_id,
                'created_by'                  =>   date('Y-m-d h:i:s'),
            ];
            $establishment=ApplicationVerification::create($verification);
            if($request->status!="Rejected"){
                $status="Notified For Tentative Date";
            }

        }
        else if($request->update_type=="team_verification" || $request->update_type=="final_verification"){
            // if(sizeof($request->nomi_staffList)>0 ){
            //     foreach($request->nomi_staffList as $nomi){
            //         $verification =[
            //             'ApplicationVerificationId'     =>   $request->id,
            //             'agency'                        =>   $nomi['org_id'],
            //             'teamMember'                    =>   $nomi['staff_id'],
            //             'verificationDate'              =>   date('Y-m-d h:i:s'),
            //             'remarks'                       =>   $request->remarks,
            //             'created_by'                    =>   $request->user_id,
            //             'created_by'                    =>   date('Y-m-d h:i:s'),
            //         ];
            //         $establishment=ApplicationVerificationTeam::create($verification);
            //     }
            // }
            if($request->status!="Rejected" && $request->status!="Approved"){
                $status="Notified For Team Verification";
            }
        }
        $estd =[
            'status'                       =>   $status,
            'remarks'                      =>   $request->remarks,
            'updated_by'                   =>   $request->user_id,
            'updated_at'                   =>   date('Y-m-d h:i:s'),
        ];
        $establishment = ApplicationDetails::where('application_no', $request->application_number)->update($estd);
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    public function updateTeamVerification(Request $request){
        $verification =[
            'ApplicationVerificationId'     => $request->id,
            'agency'                        => $request['org_id'],
            'teamMember'                    => $request['staff_id'],
            'type'                          => $request['staff_type'],
            'name'                          => $request['name'],
            'cid'                           => $request['cid'],
            'email'                         => $request['email'],
            'applicationNo'                 => $request['applicationNo'],
            'created_at'                    => date('Y-m-d h:i:s'),
            'created_by'                    => $request->user_id,
        ];
        $establishment=ApplicationVerificationTeam::create($verification);
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    public function loadTeamVerificationList($id=""){
        $response_data= ApplicationVerificationTeam::where('ApplicationVerificationId',$id)->get();
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadApprovedOrgs($type=""){
        $response_data= ApplicationDetails::where('status','Approved')->where('establishment_type','like','%'.$type.'%')->get();
        if($response_data!=null && $response_data!=""){
            foreach($response_data as $data){
                if($data->establishment_type=="Private School" || $data->establishment_type=="Private ECCD"){
                    $data->proposedName=ApplicationEstPrivate::where('ApplicationDetailsId',$data->id)->first()->proposedName;
                }
                else if($data->establishment_type=="Bifurcation"){
                    $data->proposedName=Bifurcation::where('ApplicationDetailsId',$data->id)->first()->proposedName;
                }
                else if($data->establishment_type=="Public School" || $data->establishment_type=="Public ECCD" || $data->establishment_type=="Public ECR"){
                    //dd('ddd');proposedName
                    $data->proposedName=ApplicationEstPublic::where('ApplicationDetailsId',$data->id)->first()->proposedName;
                }
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }


    public function getApprovedOrgDetails($type="",$key=""){
        $response_data= ApplicationDetails::where('status','Approved')->where('id',$key)->first();
        if($response_data->establishment_type=="Private School" ||$response_data->establishment_type=="Private ECCD"){
            $response_data->org_details=ApplicationEstPrivate::where('ApplicationDetailsId',$response_data->id)->first();
        }
        else if($response_data->establishment_type=="Bifurcation"){
            $response_data->org_details=Bifurcation::where('ApplicationDetailsId',$response_data->id)->first();
        }
        else{
            $response_data->org_details=ApplicationEstPublic::where('ApplicationDetailsId',$response_data->id)->first();
        }
        $response_data->org_class_stream=ApplicationClassStream::where('ApplicationDetailsId',$response_data->id)->get();
        // $response_data->level=Level::where('id',$response_data->levelId)->first()->name;
        // $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        // $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        // $classSection=ApplicationClassStream::where('applicationNo',$response_data->applicationNo)->groupBy('classId')->get();
        // $sections=ApplicationClassStream::where('applicationNo',$response_data->applicationNo)->where('streamId','!=',null)->get();
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

    public function registerOrganizationDetails(Request $request){
        $last_seq=ApplicationSequence::where('service_name','Organization Code')->first();
        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Organization Code',
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::where('service_name', 'Organization Code')->update($app_details);
        }
        $org_code='';
        if(strlen($last_seq)==1){
            $org_code= $org_code.date('Y').'.'.date('m').'.000'.$last_seq;
        }
        else if(strlen($last_seq)==2){
            $org_code= $org_code.date('Y').'.'.date('m').'.00'.$last_seq;
        }
        else if(strlen($last_seq)==3){
            $org_code= $org_code.date('Y').'.'.date('m').'.0'.$last_seq;
        }
        else if(strlen($last_seq)==4){
            $org_code= $org_code.date('Y').'.'.date('m').'.'.$last_seq;
        }

        $caegory=str_replace(' ','_', strtolower($request->Applicationdetails['establishment_type']));

        $org_details=$request->Applicationdetails['org_details'];
        // dd($request->Applicationdetails);
        //

        $org_data = [
            'category'                  =>$caegory,
            'yearOfEstablishment'       =>$request->yearestb,
            'dateOfEstablishment'       =>date('Y-m-d h:i:s'),
            'zestAgencyCode'            =>$request->zestcode,
            'code'                      =>$org_code,
            'name'                      =>$org_details['proposedName'],
            'dzongkhagId'               =>$request->Applicationdetails['dzongkhagId'],
            'gewogId'                   =>$request->Applicationdetails['gewogId'],
            'chiwogId'                  =>$request->Applicationdetails['chiwogId'],
            'status'                    => 'Active',
            'remarks'                   =>$request->remarks,
            'created_by'                =>$request->action_by,
        ];
        $application_data="";
        if($caegory=="public_school"){
            $application_data= ApplicationEstPublic::where('ApplicationDetailsId',$request->Applicationdetails['id'])->first();
            // dd($application_data);
            $org_data = $org_data+[
                'levelId'                   =>$application_data->levelId,
                'locationId'                =>$application_data->locationId,
                'isGeopoliticallyLocated'   =>$application_data->isGeoPoliticallyLocated,
                'isSenSchool'               =>$application_data->isSenSchool,
                'isFeedingSchool'           =>$application_data->isFeedingSchool,
            ];
        }
        if($caegory=="private_school"){
            $org_data = $org_data+[
                'levelId'                   =>$org_details['levelId'],
                'locationId'                =>$org_details['proposedLocation'],
                'typeOfSchool'              =>$org_details['typeOfSchool'],
            ];
        }
        if($caegory=="Bifurcation"){
            $application_data= Bifurcation::where('ApplicationDetailsId',$request->Applicationdetails['id'])->first();
            $org_data = $org_data+[
                'levelId'                   =>$application_data->levelId,
                'locationId'                =>$application_data->locationId,
                'isGeopoliticallyLocated'   =>$application_data->isGeoPoliticallyLocated,
                'bifOrgId'                  =>$application_data->organizationId,
                'isSenSchool'               =>$application_data->isSenSchool,
                'isFeedingSchool'           =>$application_data->isFeedingSchool,

            ];
        }
        // dd($org_data);
        $establishment = OrganizationDetails::create($org_data);

        if($caegory=="public_school" && $application_data->isFeedingSchool==1){
            $feeding_modality=ApplicationNoMeals::where('foreignKeyId',$org_details['id'])->get();
            if($feeding_modality!="" && sizeof($feeding_modality)>0){
                foreach($feeding_modality as $modality){
                    $org_feeding_modality = [
                        'organizationId'                    =>$establishment->id,
                        'noOfMeals'                         =>$modality['noOfMeals'],
                        'created_by'                        =>$request->user_id,
                        'created_at'                        =>date('Y-m-d h:i:s'),
                    ];
                    $feeding=OrganizationFeedingDetails::create($org_feeding_modality);
                }
            }
        }

        if($caegory=="private_school"){
            $prop_details = [
                'organizationId'           =>  $establishment->id,
                'cid'                      =>  $org_details['proprietorCid'],
                'fullName'                 =>  $org_details['proprietorName'],
                'phoneNo'                  =>  $org_details['proprietorMobile'],
                'email'                    =>  $org_details['proprietorEmail'],
                'created_by'               =>  $request->user_id,
                'created_at'               =>  date('Y-m-d h:i:s')
            ];
            $porp_response_data = OrganizationProprietorDetails::create($prop_details);
        }
        $application_calss_data=ApplicationClassStream::where('ApplicationDetailsId',$request->Applicationdetails['id'])->get();
        if($application_calss_data && sizeof($application_calss_data)>0){
            foreach($application_calss_data as $cls){
                if($caegory=="public_school" || $caegory=="public_ecr" || $caegory=="private_school"){
                    $strm_details = [
                        'organizationId'          =>  $establishment->id,
                        'classId'                 =>  $cls['classId'],
                        'streamId'                =>  $cls['streamId'],
                        'created_by'              =>  $request->user_id,
                        'created_at'              =>  date('Y-m-d h:i:s')
                    ];
                }
                else{//for eccd's
                    $strm_details = [
                        'organizationId'          =>  $establishment->id,
                        'classId'                 =>  $cls['classId'],
                        'created_by'              =>  $request->user_id,
                        'created_at'              =>  date('Y-m-d h:i:s')
                    ];
                }
                $stream_data = OrganizationClassStream::create($strm_details);
            }
        }

        $app_details=['status' => 'Registered','registered_org_code'=>$org_code];
        ApplicationDetails::where('application_no',$request->Applicationdetails['application_no'])->update($app_details);
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    public function getschoolDetials($param=""){
        $access_level=explode('SSS',$param)[0];
        if($access_level=="Ministry"){
            if(explode('SSS',$param)[1]=="private"){
                $response_data=OrganizationDetails::where('category',0)->get();
            }
            else{
                $response_data=OrganizationDetails::where('category',1)->get();
            }

        }
        if($access_level=="Dzongkhag"){
            $response_data=OrganizationDetails::where('dzongkhagId',explode('SSS',$param)[1])->get();
        }
        if($access_level=="Org"){
            $response_data=OrganizationDetails::where('id',explode('SSS',$param)[2])->get();
        }
        foreach($response_data as $det){
            $det->level=Level::where('id',$det->levelId)->first()->name;
        }
        return $this->successResponse($response_data);
    }

    public function getFullSchoolDetials($id=""){
        $response_data=OrganizationDetails::where('id',$id)->first();
        if($response_data!=null || $response_data!=""){
            $response_data->level=Level::where('id',$response_data->levelId)->first()->name;
            $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
            $response_data->proprietor=OrganizationProprietorDetails::where('organizationId',$id)->get();
            $classSection=OrganizationClassStream::where('organizationId',$id)->where('streamId',null)->groupBy('classId')->get();
            $stream=OrganizationClassStream::where('organizationId',$id)->where('streamId','!=',null)->get();
            foreach($classSection as $cls){
                $cls->class_name=Classes::where('id',$cls->classId)->first()->class;
            }
            foreach($stream as $sec){
                $sec->section_name=Stream::where('id',$sec->streamId)->first()->stream;
            }
            $response_data->class_section=$classSection;
            $response_data->sections=$stream;
        }
        return $this->successResponse($response_data);
    }

    /**
     * get the dzongkhag id of the school
     */

    public function getSchoolDzongkhagId($id=""){
        $response_data=OrganizationDetails::where('id',$id)->select('dzongkhagId')->get();
        return $response_data;
    }

    /**
     * get the list of HSS by dzongkhag
     */

    public function getHssSchoolList($dzo_id){
        //this is for testing
        $dzo_id = '21';
        $response_data = DB::table('organization_details')
                ->join('level','level.id','=','organization_details.levelId')
                ->select('organization_details.id', 'organization_details.name', 'level.name as level')
                ->where('organization_details.dzongkhagId', $dzo_id)
                ->where('organization_details.category', 'public_school')
                ->where('level.name','Higher Secondary School')
                ->get();

        return $response_data;

    }

    public function loadorgs($type=""){
        $response_data="";
        if($type=="Org"){
            $response_data=OrganizationDetails::all();
        }
        if($type=="Dzongkhag"){
            $response_data=HeadQuaterDetails::where('organizationType',2)->select('agencyName AS name','id')->get();
        }
        if($type=="Ministry"){
            $response_data=HeadQuaterDetails::where('organizationType',1)->select('agencyName AS name','id')->get();
        }
        return $this->successResponse($response_data);
    }

    //Used in NFE-MIS
    public function loadorgbygewogId($gewog_id){
      $response_data=OrganizationDetails::where('gewogId',$gewog_id)->get();
      return $response_data;
    }

    public function loadorgbyId($type="",$org_id=""){
        if($type=="org"){
            $response_data=OrganizationDetails::where('id',$org_id)->first();
        }
        if($type=="gewog"){
            $response_data=OrganizationDetails::where('id',$org_id)->get();
        }
        return $this->successResponse($response_data);
    }

    public function getOrgList($dzo_id=""){
        $response_data=OrganizationDetails::where('dzongkhagId',$dzo_id)->get();
        return $this->successResponse($response_data);

    }
    public function getClassByOrg($id=""){
        $classSection=OrganizationClassStream::where('organizationId',$id)->where('streamId',null)->groupBy('classId')->get();
        foreach($classSection as $cls){
            $cls->class_name=Classes::where('id',$cls->classId)->first()->class;
        }
        $classSection->class_section=$classSection;
        return $this->successResponse($classSection);
    }

    public function getLocationDetails($id=""){
        $response_data=Locations::where('organizationId',$id)->first();
        $response_data->disasterRisk=LocationDisasterRisk::where('locationId',$response_data->id)->get();
        return $this->successResponse($response_data);
    }

    public function getConnectivityDetails($id=""){
        $response_data=Connectivity::where('organizationId',$id)->first();
        $response_data->roadType=RoadType::where('id',$response_data->roadTypeId)->first()->name;
        $response_data->electricitySource=ElectricitySource::where('id',$response_data->electricitySourceId)->first()->name;
        $response_data->telephone=ServiceProvider::where('id',$response_data->telephoneServiceProvoderId)->first()->name;
        $response_data->internet=ServiceProvider::where('id',$response_data->internetServiceProviderId)->first()->name;
        $response_data->contact=ContactDetails::where('organizationId',$id)->get();
        return $this->successResponse($response_data);
    }

    public function getSectionDetails($id=""){
        $response_data = DB::table('section_details as s')
        ->join('organization_class_streams as o', 'o.id', '=', 's.classSectionId')
        ->select('o.organizationId','s.section', 'o.classId','o.streamId')->where('o.organizationId', $id)->orderby('o.classId')->get();
        return $this->successResponse($response_data);
    }



    public function udpateOrgProfile(Request $request){
        $org_det=OrgProfile::where('org_id',$request->org_id)->first();
        // dd($request->ori_id);
        $org_data = [
            'org_id'        =>  $request->org_id,
            'mission'       =>  $request->mission,
            'vission'       =>  $request->vission,
        ];
        if($request->attachments!=""){
            $org_data=$org_data+[
                'logo_path'     =>  $request->attachments];
        }
        if($org_det==null || $org_det==""){
            $org_data=$org_data+[
                'created_by'    =>  $request->user_id,
                'created_at'    =>  date('Y-m-d h:i:s')];
            OrgProfile::create($org_data);
        }
        else{
            $org_data=$org_data+[
                'updated_by'    =>  $request->user_id,
                'updated_at'    =>  date('Y-m-d h:i:s')];
            OrgProfile::where('org_id',$request->org_id)->update($org_data);
        }
        $org_det=OrgProfile::where('org_id',$request->org_id)->first();

        return $this->successResponse($org_det, Response::HTTP_CREATED);
    }

    public function updateOrgBasicDetials(Request $request){
        $org_det=OrganizationDetails::where('id',$request->org_id)->first();
        $org_data =[
            'id'                        =>  $org_det->id,
            'isAspNetSchool'            =>  $org_det->isAspNetSchool,
            'isColocated'               =>  $org_det->isColocated,
            'isGeoPoliticallyLocated'   =>  $org_det->isGeoPoliticallyLocated,
            'hasCounselingRoom'         =>  $org_det->hasCounselingRoom,
            'hasShiftSystem'            =>  $org_det->hasShiftSystem,
            'hasCE'                     =>  $org_det->hasCE,
            'mofCode'                   =>  $org_det->mofCode,
            'zestAgencyCode'            =>  $org_det->zestAgencyCode,
            'recorded_on'               =>  date('Y-m-d h:i:s'),
            'recorded_for'              =>  'Basic Detials Update',
            'recorded_by'               =>  $request->user_id,
        ];

        HistoryForOrganizaitonDetail::create($org_data); //pushing in history

        $org_update_data = [
            'isAspNetSchool'            =>  $request['isAspNetSchool'],
            'isColocated'               =>  $request['isColocated'],
            'isGeoPoliticallyLocated'   =>  $request['isGeoPoliticallyLocated'],
            'hasCounselingRoom'         =>  $request['hasCounselingRoom'],
            'isResourceCenter'         =>  $request['isResourceCenter'],
            'hasShiftSystem'            =>  $request['hasShiftSystem'],
            'hasCE'                     =>  $request['hasCE'],
            'mofCode'                   =>  $request['mofCode'],
            'zestAgencyCode'            =>  $request['zestAgencyCode'],
            'updated_by'                =>  $request['user_id'],
            'updated_at'                =>  date('Y-m-d h:i:s')
        ];

        OrganizationDetails::where('id',$request->org_id)->update($org_update_data);

        $org_det=OrganizationDetails::where('id',$request->org_id)->first();

        /**
         * all the commented fields are the ones missing from the database
         * Note to those looking at this function
        */
        $location = [
            'organizationId'        =>  $request->org_id,
            'landOwnership'         =>  $request['landOwnership'],
            'compoundFencing'       =>  $request['compoundFencing'],
            'entranceGate'          =>  $request['entranceGate'],
            'gate_type'             =>  $request['gate_type'],
            'longitude'             =>  $request['longitude'],
            'latitude'              =>  $request['latitude'],
            'altitude'              =>  $request['altitude'],
            //'thramNo'               =>  $request['thramNo'],
            // 'cid'                   =>  $request['cid'],
            // 'name'                  =>  $request['name'],
            'compoundArea'          =>  $request['compoundArea'],
            'googleMapPath'         =>  $request['map_path'],
            'climate_type'          =>  $request['climate_type'],
            'disasterArea'          =>  $request['disasterArea'],
            'distance_from_dzo'     =>  $request['distance_from_dzo'],
            'fencingtypeId'         =>  $request['fencingtype'],
        ];

        $loc = Locations::where('organizationId', $request->org_id)->first();
        if($loc!=null && $loc!=""){
            $location = $location+[
                'updated_by'            =>  $request->user_id,
                'updated_at'            =>  date('Y-m-d h:i:s')
            ];
            Locations::where('organizationId', $request->org_id)->update($location);
        }
        else{
            $location = $location+[
                'created_by'            =>  $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
            ];
            try{
                Locations::create($location);
            } catch(\Illuminate\Database\QueryException $ex){
                dd($ex->getMessage());
            }
        }
        return $this->successResponse($org_det, Response::HTTP_CREATED);
    }

    //New function to add basic details

    public function updateBasicDetails(Request $request){

        $org_details =[
            'mofCode'           =>  $request['mofCode'],
            'contactNo'         =>  $request['contactNo'],
            'officialWebsite'   =>  $request['officialWebsite'],
            'officialEmail'     =>  $request['officialEmail'],
            'facebookLink'      =>  $request['facebookLink'],
            'user_id'           =>  $request['user_id'],
            'org_id'            =>  $request['org_id']
        ];

        $org_update_data =[
            'mofCode'           =>  $request['mofCode'],
            'zestAgencyCode'    =>  $request['zestAgencyCode'],
        ];

        OrganizationDetails::where('id',$request->org_id)->update($org_update_data);

        $org_det=OrganizationDetails::where('id',$request->org_id)->first();

        $contact_details = [
            'phone'         =>  $request['contactNo'],
            'website'   =>  $request['officialWebsite'],
            'email'     =>  $request['officialEmail'],
            'facebookLink'      =>  $request['facebookLink'],
            'organizationId'            =>  $request['org_id']
        ];

        $contact = ContactDetails::where('organizationId', $request->org_id)->first();

        if($contact!=null && $contact!=""){
            $contact_details = $contact_details+[
                'updated_by'            =>  $request->user_id,
                'updated_at'            =>  date('Y-m-d h:i:s')
            ];
            $response_data = ContactDetails::where('organizationId', $request->org_id)->update($contact_details);
        }
        else{
            $contact_details = $contact_details+[
                'created_by'            =>  $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
            ];
            $response_data = ContactDetails::create($contact_details);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loaddraftApplication($type="",$user_id=""){
        $app_details=  ApplicationDetails::where('status','pending')->where('created_by',$user_id)->where('establishment_type',str_replace('_',' ',$type))->first();
        if($app_details!=""){
            if($app_details->establishment_type=="Private School" || $app_details->establishment_type=="Private ECCD"){
                $appData=ApplicationEstPrivate::where('ApplicationDetailsId',$app_details->id)->first();
                $app_details->estb_details=$appData;
            }
            else{
                $appData=ApplicationEstPublic::where('ApplicationDetailsId',$app_details->id)->first();
                $app_details->estb_details=$appData;
                if($appData->isFeedingSchool!=null && $appData->isFeedingSchool==1){
                    $app_details->meal_details=ApplicationNoMeals::where('foreignKeyId',$appData->id)->get();
                }
            }
        }
        return $this->successResponse($app_details);
    }
    public function loadEstablishmentApplciaiton($record_id=""){
        $app_details=  ApplicationDetails::where('id',$record_id)->first();
        if($app_details!=""){
            if($app_details->establishment_type=="Private School" || $app_details->establishment_type=="Private ECCD"){
                $appDetails=ApplicationEstPrivate::where('ApplicationDetailsId',$app_details->id)->first();
            }
            else{
                $appDetails=ApplicationEstPublic::where('ApplicationDetailsId',$app_details->id)->first();
                if($appDetails->isFeedingSchool==1){
                    $app_details->feeding_modality=ApplicationNoMeals::where('foreignKeyId',$appDetails->id)->get();
                }
            }
            $app_details->estb_details= $appDetails;
        }
        $app_details->estb_attachments=ApplicationAttachments::where('ApplicationDetailsId',$app_details->id)->get();
        $app_details->estb_classStream=ApplicationClassStream::where('ApplicationDetailsId',$app_details->id)->get();
        return $this->successResponse($app_details);
    }

    public function updateSenDetials(Request $request){
        $professionalsSupportChildren="";
        if($request['professionalsSupportChildren']!=""){
            $professionalsSupportChildren=implode($request['professionalsSupportChildren'], ', ');
        }
        $adultWorkingwithChildren="";
        if($request['adultWorkingwithChildren']!=""){
            $adultWorkingwithChildren=implode($request['adultWorkingwithChildren'], ", ");
        }
        $org_details =[
            'org_id'                        =>  $request['org_id'],
            // 'accessibleToilet'              =>  $request['accessibleToilet'],
            'disabilitiesInHostal'          =>  $request['disabilitiesInHostal'],

            'adjustmentsAccomodatte'        =>  $request['adjustmentsAccomodatte'],
            'outdoorPlayground'             =>  $request['outdoorPlayground'],
            'outdoorRoutes'                 =>  $request['outdoorRoutes'],
            'newConstruction'               =>  $request['newConstruction'],

            'girlsHostelAccessible'         =>  $request['girlsHostelAccessible'],
            'diningHall'                    =>  $request['hasCdiningHallE'],
            'hostelWash'                    =>  $request['hostelWash'],
            'boysHostelAccessible'          =>  $request['boysHostelAccessible'],

            'enrollment'                    =>  $request['enrollment'],
            'proprietorName'                =>  $request['proprietorName'],
            'communityWithDisablities'      =>  $request['communityWithDisablities'],
            'community'                     =>  $request['community'],

            'senProgram'                    =>  $request['senProgram'],
            'studentDisabilities'           =>  $request['studentDisabilities'],

            'professionalsSupportChildren'  =>  $professionalsSupportChildren,
            'adultWorkingwithChildren'      =>  $adultWorkingwithChildren,
            'supportDisabilitycommunity'    =>  $request['supportDisabilitycommunity'],
            'supportService'                =>  $request['supportService'],
            'schoolEndrosed'                =>  $request['schoolEndrosed'],
            'disabledGraduated'             =>  $request['disabledGraduated'],
            'disabledMovedToOtherSchool'    =>  $request['disabledMovedToOtherSchool'],
            'disabledTransaction'           =>  $request['disabledTransaction'],
            'disabledDropOut'               =>  $request['disabledDropOut'],
            'disabilitiesDropoutCurrenly'   =>  $request['disabilitiesDropoutCurrenly'],
            'disabledTransactionLastYear'   =>  $request['disabledTransactionLastYear'],
            'caregivers'                    =>  $request['caregivers'],
            'disabilitiesInHostal'          =>  $request['disabilitiesInHostal'],

            'created_by'                    =>  $request['user_id'],

        ];
        // dd($org_details);
        $update_data= OrganizaitonSenModule::where('org_id',$request['org_id'])->first();
        // dd($update_data);
        if($update_data!=""){
            OrganizaitonSenModule::where('org_id',$request['org_id'])->update($org_details);
        }
        else{
            $update_data=OrganizaitonSenModule::create($org_details);
        }
        return $this->successResponse($update_data, Response::HTTP_CREATED);
    }

    public function getcurrentSenDetails($orgId=""){
        $response_data = OrganizaitonSenModule::where('org_id',$orgId)->first();
        return $this->successResponse($response_data);
    }

    public function loadOrgChangeApplications($user_id="",$type=""){
        $response_data=ApplicationDetails::where('created_by',$user_id)->where('establishment_type',str_replace("_"," ",$type))->get();
        if($response_data!="" && $response_data!=null && sizeof($response_data)>0){
            foreach($response_data as $app){
                $app->attachments=ApplicationAttachments::where('ApplicationDetailsId',$app->id)->get();
                $change_det=ApplicationEstDetailsChange::where('ApplicationDetailsId',$app->id)->first();
                $app->change_details= $change_det;
                $app->category=OrganizationDetails::where('id',$app->change_details->organizationId)->first()->category;
                if($app->application_type=="feeding_change"){
                    $app->change_feeding=ApplicationNoMeals::where('foreignKeyId',$change_det->id)->get();
                }
                if($app->application_type=="proprietor_change"){
                    $$app->change_prop=ApplicationProprietorDetails::where('ApplicationEstDetailsChangeId',$change_det->id)->first();
                }
                if($app->application_type=="downgradation" || $app->application_type=="upgradation" || $app->application_type=="stream_change"){
                    $app->change_classes = DB::table('classes as c')
                    ->join('application_class_stream as cl', 'c.id', '=', 'cl.classId')
                    ->select('cl.*', 'c.class', 'c.id AS classId')
                    ->where('cl.ApplicationDetailsId',$change_det->id)
                    ->orderBy('c.displayOrder', 'asc')
                    ->get();
                }
            }

        }
        return $this->successResponse($response_data);
    }
}
