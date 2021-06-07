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
use App\Models\establishment\ApplicationEstMerger;
use App\Models\establishment\ApplicationClassStream;
use App\Models\establishment\ApplicationProprietorDetails;
use App\Models\establishment\ApplicationNoMeals;
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
        $data =[
            'application_no'       =>  $application_no,
            'establishment_type'   =>  'public_school',
            'application_type'     =>  'Merger',
            'dzongkhagId'          =>   '',
            'gewogId'              =>   '',
            'chiwogId'             =>   '',
            'year'                 =>   date('Y'),
            'status'               =>  'Submitted',
            'created_by'           =>  $request['user_id'],
            'created_at'           =>  date('Y-m-d h:i:s')
        ];
        
        $establishment = ApplicationDetails::create($data);

        $merger_data = [
            'ApplicationDetailsId'          =>       $establishment->id,
            'service'                       =>       'Merger',
            'OldOrganizationId'             =>        $request['orgId1'],
            'OldOrganizationId2'            =>       $request['orgId2'],
            'proposedName'                  =>       $request['proposedName'],
            'created_by'                    =>       $request->user_id,
            'status'                        =>       'Submitted',
            'created_at'                    =>       date('Y-m-d h:i:s')
        ];

        $merger = ApplicationEstMerger::create($merger_data);
        
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }
    
    public function loadMergerForVerification($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        $response_data->application_date=date_format(Carbon::parse($response_data->created_at), 'Y-m-d h:i:s');
        $merger=ApplicationEstMerger::where('ApplicationDetailsId',$response_data->id)->first();
        
        $response_data->merger=$merger;
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
    
    public function updateMergerApplication(Request $request){
        // if($request->attachment_details!="" ){
        //     if(sizeof($request->attachment_details)>0){
        //         $application_details=  ApplicationDetails::where('application_no',$request->application_number)->first();
        //         foreach($request->attachment_details as $att){
        //             $attach =[
        //                 'ApplicationDetailsId'      =>  $application_details->id,
        //                 'path'                      =>  $att['path'],
        //                 'user_defined_file_name'    =>  $att['user_defined_name'],
        //                 'name'                      =>  $att['original_name'],
        //                 'upload_type'               =>  $request->update_type,
        //             ];
        //             $doc = ApplicationAttachments::create($attach);
        //         }
        //     }
        // }
        $merger =[
            'status'                       =>   $request->status,
            'remarks'                      =>   $request->remarks,
            'updated_by'                   =>   $request->user_id,
            'updated_at'                   =>   date('Y-m-d h:i:s'),
        ]; 
        $establishment = ApplicationDetails::where('application_no', $request->application_number)->update($merger);
        //update the main organizaiton 
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

}
