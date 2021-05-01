<?php

namespace App\Http\Controllers\establishment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Traits\ApiResponser;
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

use Illuminate\Support\Facades\DB;


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
     * method to save sport details
     */
    public function saveEstablishment(Request $request){
        $id = $request->id;
        if($id != null){
            $estd = [
                'proposedName'                  =>  $request['proposedName'],
                'category'                      =>  $request['category'],
                'levelId'                       =>  $request['level'],
                'dzongkhagId'                   =>  $request['dzongkhag'],
                'gewogId'                       =>  $request['gewog'],
                'chiwogId'                      =>  $request['chiwog'],
                'locationId'                    =>  $request['locationType'],
                'isGeopoliticallyLocated'       =>  $request['geopolicaticallyLocated'],
                'isSenSchool'                   =>  $request['senSchool'],
                'parentSchoolId'                =>  $request['parentSchool'],
                'isColocated'                   =>  $request['design'],
                'status'                        =>  $request['status'],
                'service'                       =>  "New Establishment",
                'updated_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s')
            ];

            // update proprietor details if category is private
            if($request['category'] == 0){
                $pvtDetails = [
                    'applicationId'            =>  1,
                    'cid'                      =>  $request['cid'],
                    'fullName'                 =>  $request['name'],
                    'phoneNo'                  =>  $request['phoneNo'],
                    'email'                    =>  $request['email'],
                    'updated_by'               =>  $request->user_id,
                    'created_at'               =>  date('Y-m-d h:i:s')
                ];

                $establishment = ApplicationProprietorDetails::where('applicationId', 1)->update($pvtDetails);
            }
            $establishment = ApplicationDetails::where('id', $id)->update($estd);
            return $this->successResponse($establishment, Response::HTTP_CREATED);
        }else{
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
            $estd = [
                'proposedName'                  =>  $request['proposedName'],
                'category'                      =>  $request['category'],
                'levelId'                       =>  $request['level'],
                'dzongkhagId'                   =>  $request['dzongkhag'],
                'gewogId'                       =>  $request['gewog'],
                'chiwogId'                      =>  $request['chiwog'],
                'locationId'                    =>  $request['locationType'],
                'isGeopoliticallyLocated'       =>  $request['geopolicaticallyLocated'],
                'isSenSchool'                   =>  $request['senSchool'],
                'parentSchoolId'                =>  $request['parentSchool'],
                'isColocated'                   =>  $request['coLocatedParent'],
                'status'                        =>  "Pending",
                'applicationNo'                 =>  $application_no,
                'service'                       =>  "New Establishment",
                'created_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s')
            ];
            $establishment = ApplicationDetails::create($estd);
            // save proprietor details if category is private
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
                $establishment = ApplicationProprietorDetails::create($pvtDetails);
            }
            return $this->successResponse($establishment, Response::HTTP_CREATED);
        }
    }

    /**
     * method to save class and stream
     */
    public function saveClassStream(Request $request){
        $classes=$request->class;
        $classStream='';
        $inserted_class="";
        $application_details=  ApplicationDetails::where('created_by',$request->user_id)->where('service', 'New Establishment')->where('status', 'pending')->first();
        // return $application_details;
        if($request->stream!="" && sizeof($request->stream)>0){
            foreach ($request->stream as $stm){
                foreach ($classes as $cls){
                    if(explode('##',$stm)[0]==$cls){
                        $classStream = [
                            'applicationNo'     => $application_details->applicationNo,
                            'classId'           => $cls,
                            'streamId'          => explode('##',$stm)[1],
                            'created_by'        => $request->user_id,
                            'created_at'        => date('Y-m-d h:i:s'),
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
                    'applicationNo'     => $application_details->applicationNo,
                    'classId'           => $cls,
                    'created_by'        => $request->user_id,
                    'created_at'        => date('Y-m-d h:i:s'),
                ];
                if($classStream != ""){
                    $class = ApplicationClassStream::create($classStream);
                }
            }
        }
        $array = ['status' => $request->status];
        DB::table('application_details')->where('applicationNo',$application_details->applicationNo)->update($array);
        return $this->successResponse($application_details, Response::HTTP_CREATED);
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
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('status','Pending')->first());
    }

    /**
     * method to load organization details
     */
    public function loadProprietorDetails(){
        return $this->successResponse(ApplicationProprietorDetails::all());
    }

    public function loadEstbDetailsForVerification($appNo=""){
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

    public function updateEstablishment(Request $request){
        $estd =[
            'status'                       =>   $request->status,
            'updated_remarks'              =>   $request->remarks,
            'updated_by'                   =>   $request->user_id,
        ];
        $establishment = ApplicationDetails::where('applicationNo', $request->application_number)->update($estd);
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    public function loadApprovedOrgs(){
        return $this->successResponse(ApplicationDetails::where('status','Approved')->where('service','New Establishment')->where('category','0')->get());
    }


    public function getApprovedOrgDetails($type="",$key=""){
        $response_data=ApplicationDetails::where('status','Approved')->where('category','0')->where('id',$key)->first();
        // dd($response_data);
        $response_data->level=Level::where('id',$response_data->levelId)->first()->name;
        $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        $classSection=ApplicationClassStream::where('applicationNo',$response_data->applicationNo)->groupBy('classId')->get();
        $sections=ApplicationClassStream::where('applicationNo',$response_data->applicationNo)->where('streamId','!=',null)->get();
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
        $org_data = [
            'category'                  =>$request->category,
            'yearOfEstablishment'       =>$request->yearestb,
            'zestAgencyCode'            =>$request->zestcode,
            'code'                      =>$org_code,
            'name'                      =>$request->proposedName,
            'levelId'                   =>$request->levelId,
            'dzongkhagId'               =>$request->dzongkhagId,
            'gewogId'                   =>$request->gewogId,
            'chiwogId'                  =>$request->chiwogId,
            'isColocated'               =>$request->isColocated,
            'locationId'                =>$request->locationId,
            'parentSchoolId'            =>$request->parentSchoolId,
            'isGeopoliticallyLocated'   =>$request->isGeopoliticallyLocated,
            'isSenSchool'               =>$request->isSenSchool,
            'status'                    => 'Active',
            'remarks'                   =>$request->remarks,
            'created_by'                =>$request->action_by,
        ];
        $establishment = OrganizationDetails::create($org_data);
        if($request['category'] == 0 && sizeof($request->proprietorList)>0){
            foreach($request->proprietorList as $prop){
                $prop_details = [
                    'organizationId'           =>  $establishment->id,
                    'cid'                      =>  $prop['cid'],
                    'fullName'                 =>  $prop['fullName'],
                    'phoneNo'                  =>  $prop['phoneNo'],
                    'email'                    =>  $prop['email'],
                    'created_by'               =>  $request->user_id,
                    'created_at'               =>  date('Y-m-d h:i:s')
                ];
                $porp_response_data = OrganizationProprietorDetails::create($prop_details);
            }
        }
        foreach($request->class_section as $cls){
            $class_details = [
                'organizationId'          =>  $establishment->id,
                'classId'                 =>  $cls['classId'],
                'created_by'              =>  $request->user_id,
                'created_at'              =>  date('Y-m-d h:i:s')
            ];
            $class_data = OrganizationClassStream::create($class_details);
            foreach($request->sectionList as $strm){
                if($strm['classId']==$cls['classId']){
                    $strm_details = [
                        'organizationId'          =>  $establishment->id,
                        'classId'                 =>  $class_data->id,
                        'streamId'                 =>  $strm['streamId'],
                        'created_by'              =>  $request->user_id,
                        'created_at'              =>  date('Y-m-d h:i:s')
                    ];
                    $stream_data = OrganizationClassStream::create($strm_details);
                }
            }
        }
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    public function getschoolDetials($param=""){
        $access_level=explode('SSS',$param)[0];
        if($access_level=="Ministry"){
            $response_data=OrganizationDetails::all();
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
<<<<<<< HEAD
        $response_data->class_section=$classSection;
        $response_data->sections=$sections;
        return $this->successResponse($response_data);
    }

    public function loadorgs(){
        $response_data=OrganizationDetails::all();
=======
        
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
>>>>>>> 7c1eacc1bb000a6915f72069eed79032abdcde2f
        return $this->successResponse($response_data);
    }
    public function loadorgbyId($type="",$org_id=""){
        // dd('i am here ');
        if($type=="org"){
            $response_data=OrganizationDetails::where('id',$org_id)->first();
        }
        if($type=="gewog"){
            $response_data=OrganizationDetails::where('id',$org_id)->get();
        }
        return $this->successResponse($response_data);
    }

    public function loadorgbygewogId($gewog_id){
        $response_data=OrganizationDetails::all()->where('gewogId',$gewog_id);
        return $this->successResponse(($response_data));
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
}
