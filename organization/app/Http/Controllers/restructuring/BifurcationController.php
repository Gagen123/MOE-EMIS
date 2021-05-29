<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\OrganizationDetails;
use App\Models\ApplicationSequence;
use App\Models\restructuring\Bifurcation;
use App\Models\establishment\ApplicationClassStream;
use App\Models\Masters\Classes;
use App\Models\Masters\Stream;
use Illuminate\Support\Carbon;
use App\Models\Masters\Level;
use App\Models\Masters\Location;


class BifurcationController extends Controller
{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * method to save bifurcation details
     */
    public function saveBifurcation(Request $request){
        $last_seq=ApplicationSequence::where('service_name','Bifurcation')->first();
        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Bifurcation',
                'last_sequence'                 =>  $last_seq,
            ];  
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'      =>  $last_seq,
            ];  
            ApplicationSequence::where('service_name', 'Bifurcation')->update($app_details);
        }
        $application_no='Bif-';
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

        $bir = [
            'parentOrgId'                    =>  $request['parent_id'],
            'status'                       =>  'Submitted',
            'applicationNo'                =>  $application_no,
            'new1Name'                     =>  $request['name'],
            'new1Level'                    =>  $request['level'],
            'new1Category'                 =>  $request['category'],
            'new1Dzongkhag'                =>  $request['dzongkhag'],
            'new1Gewog'                    =>  $request['gewog'],
            'new1Chiwog'                   =>  $request['chiwog'],
            'new1Location'                 =>  $request['location'],
            'new1IsGeoLocated'             =>  $request['geoLocated'],
            'new1IsSenSchool'              =>  $request['senSchool'],
            'new1ParentSchool'             =>  $request['parentSchool'],
            'new1IsCoLocated'              =>  $request['coLocated'],

            'new2Name'                     =>  $request['name1'],
            'new2Level'                    =>  $request['level1'],
            'new2Category'                 =>  $request['category1'],
            'new2Dzongkhag'                =>  $request['dzongkhag1'],
            'new2Gewog'                    =>  $request['gewog1'],
            'new2Chiwog'                   =>  $request['chiwog1'],
            'new2Location'                 =>  $request['location1'],
            'new2IsGeoLocated'             =>  $request['geoLocated1'],
            'new2IsSenSchool'              =>  $request['senSchool1'],
            'new2ParentSchool'             =>  $request['parentSchool1'],
            'new2IsCoLocated'              =>  $request['coLocated1'],
        ];
        $bifurcation = Bifurcation::create($bir);
        if($request->class!="" && sizeof($request->class)>0){
            foreach ($request->class as $cls){
                $class_data = [
                    'applicationNo'     => $application_no,
                    'classId'           => $cls,
                    'parent_for'        => '1',
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
                            'parent_for'        => '1',
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
        if($request->class1!="" && sizeof($request->class1)>0){
            foreach ($request->class1 as $cls){
                $class_data = [
                    'applicationNo'     => $application_no,
                    'classId'           => $cls,
                    'parent_for'        => '2',
                    'created_by'        => $request->user_id,
                    'created_at'        => date('Y-m-d h:i:s'),
                ];
                $class = ApplicationClassStream::create($class_data);
            }
        }
        $inserted_class1="";
        if($request->stream1!="" && sizeof($request->stream1)>0){
            foreach ($request->stream1 as $stm){
                foreach ($request->class1 as $cls){
                    if(explode('##',$stm)[0]==$cls){
                        $stream_data = [
                            'applicationNo'     => $application_no,
                            'classId'           => $cls,
                            'parent_for'        => '2',
                            'streamId'          => explode('##',$stm)[1],
                            'created_by'        => $request->user_id,
                            'created_at'        => date('Y-m-d h:i:s'),
                        ];
                        if(strpos($inserted_class1,$cls)===false){
                            $inserted_class1.=$cls;
                        }
                        $strm = ApplicationClassStream::create($stream_data);
                    }
                }
            }
        }
        return $this->successResponse($bifurcation, Response::HTTP_CREATED);

    }
    
    public function loadbifurcationForVerification($appNo=""){
        $response_data=Bifurcation::where('applicationNo',$appNo)->first();

        $response_data->application_date=date_format(Carbon::parse($response_data->created_at), 'Y-m-d h:i:s');
        $response_data->new1Level=Level::where('id',$response_data->new1Level)->first()->name;
        $response_data->new2Level=Level::where('id',$response_data->new2Level)->first()->name;
        $response_data->new1Location=Location::where('id',$response_data->new1Location)->first()->name;
        $response_data->new2Location=Location::where('id',$response_data->new2Location)->first()->name;
        $response_data->parent_school1=OrganizationDetails::where('id',$response_data->new1ParentSchool)->first()->name;
        $response_data->parent_school2=OrganizationDetails::where('id',$response_data->new2ParentSchool)->first()->name;
        
        // $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        $class1=ApplicationClassStream::where('applicationNo',$appNo)->where('parent_for','1')->groupBy('classId')->get();
        $stream1=ApplicationClassStream::where('applicationNo',$appNo)->where('parent_for','1')->where('streamId','!=',null)->get();
        foreach($class1 as $cls){
            $cls->class_name=Classes::where('id',$cls->classId)->first()->class;
        }
        foreach($stream1 as $sec){
            $sec->section_name=Stream::where('id',$sec->streamId)->first()->stream;
        }
        $response_data->class_det_1=$class1;
        $response_data->strm_set_1=$stream1;

        $class2=ApplicationClassStream::where('applicationNo',$appNo)->where('parent_for','2')->groupBy('classId')->get();
        $stream2=ApplicationClassStream::where('applicationNo',$appNo)->where('parent_for','2')->where('streamId','!=',null)->get();
        foreach($class2 as $cls){
            $cls->class_name=Classes::where('id',$cls->classId)->first()->class;
        }
        foreach($stream2 as $sec){
            $sec->section_name=Stream::where('id',$sec->streamId)->first()->stream;
        }
        $response_data->class_det_2=$class2;
        $response_data->strm_set_2=$stream2;
        return $this->successResponse($response_data); 
    }
    /**
     * method to load organization details
     */
    // public function loadBifurcation(){
    //     $orgDetails = OrganizationDetails::all();
    //     return $orgDetails;
    // }
}
