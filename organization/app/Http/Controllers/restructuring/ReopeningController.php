<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\OrganizationDetails;
use App\Models\ApplicationSequence;
use App\Models\restructuring\Reopening;
use App\Models\establishment\ApplicationClassStream;
use App\Models\establishment\ApplicationDetails;
use App\Models\Masters\Classes;
use App\Models\Masters\Stream;
use Illuminate\Support\Carbon;
use App\Models\Masters\Level;
use App\Models\Masters\Location;


class ReopeningController extends Controller
{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * method to save reopening details
     */
    public function saveReopening(Request $request){

        $last_seq=ApplicationSequence::where('service_name','Reopening')->first();

        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Reopening',
                'last_sequence'                 =>  $last_seq,
            ];  
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'      =>  $last_seq,
            ];  
            ApplicationSequence::where('service_name', 'Reopening')->update($app_details);
        }
        $application_no='Reopen-';
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
        $data =[
            'application_no'       =>  $application_no,
            'establishment_type'   =>  'public_school',
            'application_type'     =>  'Reopening',
            'dzongkhagId'          =>   $request['dzongkhag1'],
            'gewogId'              =>   $request['gewog1'],
            'chiwogId'             =>   $request['chiwog1'],
            'year'                 =>   date('Y'),
            'status'               =>  'Submitted',
            'created_by'           =>  $request['user_id'],
            'created_at'           =>  date('Y-m-d h:i:s')
        ];
        
        $establishment = ApplicationDetails::create($data);

        $bir = [
            'ApplicationDetailsId'         =>  $establishment->id,
            'organizationId'               =>  $request['parent_id'],
            'proposedName'                =>  $request['name1'],
            'dateOfReopening'              =>  date('Y-m-d'),
            'levelId'                      =>  $request['level1'],
            'locationId'                   =>  $request['location1'],
            'isGeoPoliticallyLocated'      =>  $request['geoLocated1'],
            'isSenSchool'                  =>  $request['senSchool1'],
            'isFeedingSchool'              =>  $request['parentSchool1']
        ];

        $reopening = Reopening::create($bir);

        if($request->class1!="" && sizeof($request->class1)>0){
            foreach ($request->class1 as $cls){
                $class_data = [
                    'foreignKeyFor'     => 'Reopening',
                    'ApplicationDetailsId'     =>$establishment->id,
                    'classId'           => $cls,
                    'created_by'        => $request->user_id,
                    'created_at'        => date('Y-m-d h:i:s'),
                ];

                $class = ApplicationClassStream::create($class_data);
            }
        }
        
        $inserted_class="";
        if($request->stream1!="" && sizeof($request->stream1)>0){
            foreach ($request->stream1 as $stm){
                foreach ($request->class1 as $cls){
                    if(explode('##',$stm)[0]==$cls){
                        $stream_data = [
                            'foreignKeyFor'     => 'Reopening',
                            'ApplicationDetailsId'     =>$establishment->id,
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


    /**
     * details of reopening for verification
     */

    public function loadReopeningForVerification($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        $response_data->application_date=date_format(Carbon::parse($response_data->created_at), 'Y-m-d h:i:s');
        $reopening=Reopening::where('ApplicationDetailsId',$response_data->id)->first();
        
        $response_data->reopening=$reopening;
        // if($merger->isfeedingschool==1){
        //     $response_data->feeding=ApplicationNoMeals::where('ApplicationDetailsId',$merger->id)->get();
        // }
        
        // $response_data->level=Level::where('id',$merger->levelId)->first()->name;
        // $response_data->locationType=Location::where('id',$merger->locationId)->first()->name;
        // $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        // $classSection=ApplicationClassStream::where('ApplicationDetailsId',$merger->id)->groupBy('classId')->get();
        // $sections=ApplicationClassStream::where('ApplicationDetailsId',$merger->id)->where('streamId','<>',null)->get();
        // foreach($classSection as $cls){
        //     $cls->class_name=Classes::where('id',$cls->classId)->first()->class;
        // }
        // $response_data->class_section=$classSection;
        // if($sections!="" && sizeof($sections)>0){
        //     foreach($sections as $sec){
        //         $sec->section_name=Stream::where('id',$sec->streamId)->first()->stream;
        //     }
        //     $response_data->stream=$sections;
        // }
        return $this->successResponse($response_data); 
    }

}
