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
use App\Models\OrganizationProprietorDetails;
use App\Models\OrganizationClassStream;
use App\Models\establishment\HeadQuaterDetails;
use App\Models\establishment\ApplicationEstPublic;
use App\Models\establishment\ApplicationEstPrivate;
use App\Models\establishment\ApplicationVerification;
use App\Models\establishment\ApplicationVerificationTeam;

use App\Models\establishment\ApplicationAttachments;


class EstablishmentController extends Controller
{
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

        $application_details_data = $this->extractApplicationDetailsData($request);

        $inserted_application_data = ApplicationDetails::create($application_details_data);
        $applicationDetailsId = $inserted_application_data->id;

        switch($request['establishment_type']){
            case "public_school" : {
                    $establishment_data = $this->extractPublicEstDetailsData($request, $applicationDetailsId);
                    $dataModel = 'ApplicationEstPublic';
                    break;
                }
            case "private_school" : {
                    $establishment_data = $this->extractPrivateEstDetailsData($request, $applicationDetailsId);
                    $dataModel = 'ApplicationEstPrivate';
                    break;
                }
            case "public_eccd" : {
                    $establishment_data = $this->extractPublicEstDetailsData($request, $applicationDetailsId);
                    $dataModel = 'ApplicationEstPublic';
                    break;
                }
            case "private_eccd" : {
                    $establishment_data = $this->extractPrivateEstDetailsData($request, $applicationDetailsId);
                    $dataModel = 'ApplicationEstPrivate';
                    break;
                }
            case "public_ecr" : {
                    $establishment_data = $this->extractPublicEstDetailsData($request, $applicationDetailsId);
                    $dataModel = 'ApplicationEstPublic';
                    break;
                }
            default : {
                
                break;
            }
        }

        // $feedingModality=null;
        // if($request['isfeedingschool']=="1"){
        //     $feedingModality=implode(',',$request['feeding']);
        // }

        $response_data = $this->insertData($establishment_data, $dataModel);
        $response_data->applicaiton_details=$inserted_application_data;

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /**
     * Extract the Basic Application Details
     */

    private function extractApplicationDetailsData($request){
        $data =[
            'application_no'       =>  $this->generateApplicationNo(),
            'establishment_type'   =>  $request['proposed_establishment'],
            'category'             =>  $request['category'],
            'dzongkhagId'          =>  $request['dzongkhag'],
            'gewogId'              =>  $request['gewog'],
            'chiwogId'             =>  $request['chiwog'],
            'application_type'     =>  $request['level'],
            'year'                 =>  $request['year'],
            'status'               =>  $request['status'],
            'remarks'              =>  $request['remarks'],
            'created_by'           =>  $request['user_id'],
            'created_at'           =>  date('Y-m-d h:i:s')
        ];

        return $data;
        
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
            'isFeedingschool'              =>  $request['isfeedingschool'],
            'created_at'           =>  date('Y-m-d h:i:s')
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
            'totalLand'                    =>  $request['totalLand'],
            'enrollmentBoys'               =>  $request['enrollmentBoys'],
            'enrollmentGirls'              =>  $request['enrollmentGirls'],
            'proposedLocation'             =>  $request['proposedLocation'],
            'typeOfSchool'                 =>  $request['typeOfSchool'],
            'levelId'                      =>  $request['level'],
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

        $classes=$request->class;
        $classStream='';
        $inserted_class="";
        $application_details= ApplicationDetails::where('created_by',$request->user_id) 
                                                    ->where('application_no', $request->applicaiton_number)
                                                    ->where('status', 'pending')
                                                    ->first();
        foreach($request->class as $key => $classId){
            $stream_exists = $this->checkStreamExists($classId);
            if(empty($stream_exists)){
                $classStream = [
                    'ApplicationDetailsId'  => $application_details->id,
                    'classId'               => $classId,
                    'streamId'              => '',
                    'created_by'            => $request->user_id,
                    'created_at'            => date('Y-m-d h:i:s'),
                ];
                
                $class = ApplicationClassStream::create($classStream);

            } 
        }

        // foreach($request->stream as $key2 => $classStreamId){
        //     $class_stream_data = $this->getClassStreamId($classStreamId);
        //     foreach($class_stream_data as $v){
        //         $classStream = [
        //             'ApplicationDetailsId'  => $request->applicaiton_number,
        //             'classId'               => $v->classId,
        //             'streamId'              => $v->streamId,
        //             'created_by'            => $request->user_id,
        //             'created_at'            => date('Y-m-d h:i:s'),
        //         ];
        //         $class = ApplicationClassStream::create($classStream);


         //this above is commented with conflict   

        if($request->stream!=null && $request->stream!=""){
            foreach($request->stream as $key2 => $classStreamId){
                $class_stream_data = $this->getClassStreamId($classStreamId);
    
                foreach($class_stream_data as $v){
                    $classStream = [
                        'ApplicationDetailsId'  => $application_details->id,
                        'classId'               => $v->classId,
                        'streamId'              => $v->streamId,
                        'created_by'            => $request->user_id,
                        'created_at'            => date('Y-m-d h:i:s'),
                    ];
                    $class = ApplicationClassStream::create($classStream);
                }
            }
        }

        $array = ['status' => $request->status];
        DB::table('application_details')->where('application_no',$request->applicaiton_number)->update($array);
        return $this->successResponse($application_details, Response::HTTP_CREATED);
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

    /**
     * method to load organization details
     */
    public function loadOrganizationDetails($user_id=""){
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('status','pending')->first());
    }

    /**
     * method to load organization applications
     */
    public function loadOrgApplications($user_id=""){
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('status','submitted')->get());
    }

    public function loadOrgChangeApplications($user_id=""){
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('application_no', 'like', 'Ch-%')->get());
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
        if($response_data->establishment_type=="Public School"){
            $response_data->org_details=ApplicationEstPublic::where('ApplicationDetailsId',$response_data->id)->first();
        }
        if($response_data->establishment_type=="Private School"){
            $response_data->org_details=ApplicationEstPrivate::where('ApplicationDetailsId',$response_data->id)->first();
        }
        $response_data->org_class_stream=ApplicationClassStream::where('ApplicationDetailsId',$response_data->id)->get();
        $response_data->attachments=ApplicationAttachments::where('ApplicationDetailsId',$response_data->id)->get();
        $response_data->app_verification=ApplicationVerification::where('ApplicationDetailsId',$response_data->id)->first();
        $id=ApplicationVerification::where('ApplicationDetailsId',$response_data->id)->first();
        if($id!=null && $id!=""){
            $response_data->app_verification_team=ApplicationVerificationTeam::where('ApplicationVerificationId',$id->id)->get();
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
        }
        else if($request->update_type=="team_verification"){
            if(sizeof($request->nomi_staffList)>0 ){
                foreach($request->nomi_staffList as $nomi){
                    $verification =[
                        'ApplicationVerificationId'     =>   $request->id,
                        'agency'                        =>   $nomi['org_id'],
                        'teamMember'                    =>   $nomi['staff_id'],
                        'verificationDate'              =>   date('Y-m-d h:i:s'),
                        'remarks'                       =>   $request->remarks,
                        'created_by'                    =>   $request->user_id,
                        'created_by'                    =>   date('Y-m-d h:i:s'),
                    ];
                    $establishment=ApplicationVerificationTeam::create($verification);
                }
            }
        }
        else{
            $estd =[
                'status'                       =>   $request->status,
                'remarks'                        =>   $request->remarks,
                'updated_by'                   =>   $request->user_id,
                'updated_at'                   =>   date('Y-m-d h:i:s'),
            ]; 
            $establishment = ApplicationDetails::where('application_no', $request->application_number)->update($estd);
        }
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    public function loadApprovedOrgs(){
        $response_data= ApplicationDetails::where('status','Approved')->where('establishment_type','like','Private%')->get();
        if($response_data!=null && $response_data!=""){
            foreach($response_data as $data){
                if($data->establishment_type=="Private School"){
                    $data->proposedName=ApplicationEstPrivate::where('ApplicationDetailsId',$data->id)->first()->proposedName;
                }
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }


    public function getApprovedOrgDetails($type="",$key=""){
        $response_data= ApplicationDetails::where('status','Approved')->where('establishment_type','like','Private%')->where('id',$key)->first();
        if($response_data->establishment_type=="Private School"){
            $response_data->org_details=ApplicationEstPrivate::where('ApplicationDetailsId',$response_data->id)->first();
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
       
        $org_details=$request->applicaitondetails['org_details'];
        $org_data = [
            'category'                  =>str_replace(' ','_', strtolower($request->applicaitondetails['establishment_type'])),
            'yearOfEstablishment'       =>$request->yearestb,
            'zestAgencyCode'            =>$request->zestcode,
            'code'                      =>$org_code,
            'name'                      =>$org_details['proposedName'],
            'levelId'                   =>$org_details['levelId'],
            'dzongkhagId'               =>$request->applicaitondetails['dzongkhagId'],
            'gewogId'                   =>$request->applicaitondetails['gewogId'],
            'chiwogId'                  =>$request->applicaitondetails['chiwogId'],
            'locationId'                =>$org_details['proposedLocation'],
            // 'parentSchoolId'            =>$request->applicaitondetails['parentSchoolId'],
            // 'isGeopoliticallyLocated'   =>$request->applicaitondetails['isGeopoliticallyLocated'],
            // 'isSenSchool'               =>$request->applicaitondetails['isSenSchool'],
            'typeOfSchool'                =>$org_details['typeOfSchool'],
            'status'                    => 'Active',
            'remarks'                   =>$request->remarks,
            'created_by'                =>$request->action_by,
        ];
        $establishment = OrganizationDetails::create($org_data);
       
        if($request->applicaitondetails['establishment_type']== 'Private School'){
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
        if($request->applicaitondetails['org_class_stream'] && sizeof($request->applicaitondetails['org_class_stream'])>0){
            foreach($request->applicaitondetails['org_class_stream'] as $cls){
                $strm_details = [
                    'organizationId'          =>  $establishment->id,
                    'classId'                 =>  $cls['classId'],
                    'streamId'                =>  $cls['streamId'],
                    'created_by'              =>  $request->user_id,
                    'created_at'              =>  date('Y-m-d h:i:s')
                ];
                $stream_data = OrganizationClassStream::create($strm_details);
            }
        }
        $app_details=['status' => 'Registered','registered_org_code'=>$org_code];
        ApplicationDetails::where('application_no',$request->applicaitondetails['application_no'])->update($app_details);
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
    
    public function saveUploadedFiles(Request $request){
        
        $doc;
        if($request->attachment_details!=null && $request->attachment_details!=""){
            foreach($request->attachment_details as $att){
                $application_details=  ApplicationDetails::where('application_no',$att['applicaiton_number'])->first();
                $attach =[
                    'ApplicationDetailsId'       =>  $application_details->id,
                    'path'                   =>  $att['path'],
                    'name'                      =>  $att['original_name'],
                ];

                $doc = ApplicationAttachments::create($attach);
            }
        }
        return $doc;
    }

    public function udpateOrgProfile(Request $request){
        $org_det=OrgProfile::where('org_id',$request->ori_id)->first();
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

    
    
    public function loaddraftApplication($type="",$user_id=""){
        $app_details=  ApplicationDetails::where('status','pending')->where('created_by',$user_id)->where('establishment_type',$type)->first();
        if($app_details!=""){
            $app_details->estb_details=ApplicationEstPublic::where('ApplicationDetailsId',$app_details->id)->first();
        }
        return $this->successResponse($app_details);
    }
}
