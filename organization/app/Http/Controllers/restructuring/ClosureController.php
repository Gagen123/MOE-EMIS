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
use App\Models\establishment\ApplicationAttachments;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\establishment\ApplicationEstClosure;
use App\Models\HistoryForOrganizaitonDetail;
use App\Models\OrganizationDetails;

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
        
        ApplicationEstClosure::create($closure);
        if($request->attachment_details!=null && $request->attachment_details!=""){
            foreach($request->attachment_details as $att){
                $attach =[
                    'ApplicationDetailsId'      =>  $establishment->id,
                    'path'                      =>  $att['path'],
                    'user_defined_file_name'    =>  $att['user_defined_name'],
                    'name'                      =>  $att['original_name'],
                    'updoad_type'               =>  'Applicant',
                ];
                ApplicationAttachments::create($attach);
            }
        }

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
        $response_data->attachments= ApplicationAttachments::where('ApplicationDetailsId',$response_data->id)->get();

        return $this->successResponse($response_data);
    }

    /**
     * Updating the closure details
     */

    public function updateClosureDetails(Request $request){

        //Code is copied from updateChangeBasicDetails
        // to update the applications table
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

        $change_details=ApplicationEstClosure::where('ApplicationDetailsId',$app_details->id)->first();
        $org_details=OrganizationDetails::where('id',$change_details->organizationId)->first();
        $change_details_data="";

        $org_data =[
            'id'                        =>  $org_details->id,
            'status'                    =>  $org_details->status,
            'updated_by'                =>  $org_details->updated_by,
            'updated_at'                =>  $org_details->updated_at,
            'recorded_on'               =>  date('Y-m-d h:i:s'),
            'recorded_for'              =>  'Closure',
            'recorded_by'               =>  $request->user_id,
        ];
        HistoryForOrganizaitonDetail::create($org_data);
        $org_update_data =[
            'status'                    =>  'Closed',
            'updated_by'                =>  date('Y-m-d h:i:s'),
            'updated_at'                =>  $request->user_id,
        ];
        $change_details=OrganizationDetails::where('id',$change_details->organizationId)->update($org_update_data);

        return $this->successResponse($change_details_data, Response::HTTP_CREATED);
    }
}
