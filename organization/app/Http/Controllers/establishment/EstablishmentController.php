<?php

namespace App\Http\Controllers\establishment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Traits\ApiResponser;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\Masters\Classes;
use App\Models\Masters\Stream;
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationClassStream;
use App\Models\establishment\ApplicationProprietorDetails;
use App\Models\ApplicationSequence;

use Illuminate\Support\Facades\DB;


class EstablishmentController extends Controller
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
     * method to get level in dropdown
     */
    public function getLevelInDropdown(){
        return Level::get(['id','name']);
    }

    /**
     * method to get location in dropdown
     */
    public function getLocationInDropdown(){
        return Location::get(['id','name']);
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
                // 'cid'                           =>  $request['cid'],
                // 'fullName'                      =>  $request['name'],
                // 'phoneNo'                       =>  $request['phoneNo'],
                // 'email'                         =>  $request['email'],
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
                'cid'                           =>  $request['cid'],
                'fullName'                      =>  $request['name'],
                'phoneNo'                       =>  $request['phoneNo'],
                'email'                         =>  $request['email'],
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

        // $applicationNo = DB::table('application_details as a')
        //     ->select('a.applicationNo')
        //     ->where('created_by',$request->user_id)
        //     ->where('status', 'pending')
        //     ->get();
        $application_details=  ApplicationDetails::where('created_by',$request->user_id)->where('status', 'pending')->first();
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
        return Classes::get(['id','class']);
    }

    /**
     * method to get stream in checkbox
     */
    public function getStream(){
        return Stream::get(['id','stream']);
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
        return $this->successResponse(ApplicationDetails::where('status','Approved')->where('category','0')->get());
    }
}