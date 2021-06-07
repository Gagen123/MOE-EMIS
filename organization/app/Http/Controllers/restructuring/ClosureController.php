<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\restructuring\Closure;
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationProprietorDetails;
use App\Models\ApplicationSequence;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\establishment\ApplicationEstClosure;



class ClosureController extends Controller
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
     * method to submit school for closure
     */
    public function saveClosure(Request $request){
        $last_seq=ApplicationSequence::where('service_name','Closure')->first();
            if($last_seq==null || $last_seq==""){
                $last_seq=1;
                $app_details = [
                    'service_name'                  =>  'Closure',
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::create($app_details);
            }
            else{
                $last_seq=$last_seq->last_sequence+1;
                $app_details = [
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::where('service_name', 'Closure')->update($app_details);
            }
            $application_no='Cls-';
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
            'application_type'     =>  'Closure',
            'dzongkhagId'          =>   '',
            'gewogId'              =>   '',
            'chiwogId'             =>   '',
            'year'                 =>   date('Y'),
            'status'               =>  'Submitted',
            'created_by'           =>  $request['user_id'],
            'created_at'           =>  date('Y-m-d h:i:s')
        ];

        $establishment = ApplicationDetails::create($data);

        $closure =[
        'ApplicationDetailsId'     =>  $establishment->id,
        'organizationId'           =>  $request['organizationId'],
        'remarksForClosure'        =>  $request['reason'],
        'remark'                   =>  $request['remark'],
        'dateOfClosure'            =>  date('Y-m-d'),
        'id'                       =>  $request['id'],
        'user_id'                  =>  $request['user_id']
        ];

        $closure_data = ApplicationEstClosure::create($closure);

        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    /**
     * method to load closure application for verification process
     */
    public function loadClosureApplicationDetails($appNo=""){
        $response_data=ApplicationDetails::where('applicationNo',$appNo)->first();
        $response_data->level=Level::where('id',$response_data->levelId)->first()->name;
        $response_data->locationType=Location::where('id',$response_data->locationId)->first()->name;
        if($response_data->id!=null && $response_data->id!=""){
            $response_data->proprietor=ApplicationProprietorDetails::where('applicationId',$response_data->id)->get();
        }
        return $this->successResponse($response_data);
    }

    /**
     * method to update closure status in application table
     */
    public function updateClosure(Request $request){
        $estd =[
            'status'                       =>   $request->status,
            'updated_remarks'              =>   $request->yourRemark,
            'updated_by'                   =>   $request->user_id,
        ];
        $close = ApplicationDetails::where('applicationNo', $request->application_number)->update($estd);
        return $this->successResponse($close, Response::HTTP_CREATED);
    }

    /**
     * details of closure for verification
     */

    public function loadClosureForVerification($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        // $response_data->application_date=date_format(Carbon::parse($response_data->created_at), 'Y-m-d h:i:s');
        $closure = ApplicationEstClosure::where('ApplicationDetailsId',$response_data->id)->first();

        $response_data->closure=$closure;

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
