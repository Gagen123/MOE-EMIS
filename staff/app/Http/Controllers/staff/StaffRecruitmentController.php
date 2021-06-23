<?php

namespace App\Http\Controllers\staff;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\staff\ApplicationDetails;
use App\Models\staff\ApplicationSequence;
use App\Models\staff\ApplicationAttachments;


class StaffRecruitmentController extends Controller
{
    use ApiResponser;
    public $database="staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function savePrincipalApproval(Request $request){
        $application_details_data =[
            'application_no'       =>  $this->generateApplicationNo(),
            'organizationId'       =>  $request['organizationId'],
            'name'                 =>  $request['name'],
            'DateOfBirth'          =>  $request['dob'],
            'dzongkhag'            =>  $request['dzongkhag'],
            'gewog'                =>  $request['gewog'],
            'village'              =>  $request['village'],
            'presentAddress'       =>  $request['paddress'],
            'EmailAddress'         =>  $request['email'],
            'contact_number'       =>  $request['contact_number'],
            'application_for'      =>  $request['application_for'],
            'application_type'     =>  $request['application_type'],
            'action_type'          =>  $request['action_type'],
            'status'               =>  $request['status'],
            'created_by'           =>  $request['user_id']
        ];
        $inserted_application_data = ApplicationDetails::create($application_details_data);
        $applicationDetailsId = $inserted_application_data->id;
        if($request->attachment_details!=null && $request->attachment_details!=""){
            foreach($request->attachment_details as $att){
                $attach =[
                    'ApplicationDetailsId'      =>  $applicationDetailsId,
                    'path'                      =>  $att['path'],
                    'user_defined_file_name'    =>  $att['user_defined_name'],
                    'name'                      =>  $att['original_name'],
                    'updoad_type'               =>  'Applicant',
                ];
                ApplicationAttachments::create($attach);
            }
        } 
        return $application_details_data;

        

    }
    public function saveExpatriateRecuritment(Request $request){
        $application_details_data =[
            'application_no'       =>  $this->generateApplicationNoForExpatriate(),
            'organizationId'       =>  $request['organizationId'],
            'passport/emigration'  =>  $request['passport'],
            'name'                 =>  $request['name'],
            'DateOfBirth'          =>  $request['dob'],
            'CountryOfExpatriate'  =>  $request['country'],
            'AddressOfExpatriate'  =>  $request['address'],
            'EmailAddress'         =>  $request['email'],
            'contact_number'       =>  $request['contact_number'],
            'application_for'      =>  $request['application_for'],
            'application_type'     =>  $request['application_type'],
            'action_type'          =>  $request['action_type'],
            'status'               =>  $request['status'],
            'created_by'           =>  $request['user_id']
        ];
        $inserted_application_data = ApplicationDetails::create($application_details_data);
        $applicationDetailsId = $inserted_application_data->id;
        if($request->attachment_details!=null && $request->attachment_details!=""){
            foreach($request->attachment_details as $att){
                $attach =[
                    'ApplicationDetailsId'      =>  $applicationDetailsId,
                    'path'                      =>  $att['path'],
                    'user_defined_file_name'    =>  $att['user_defined_name'],
                    'name'                      =>  $att['original_name'],
                    'updoad_type'               =>  'Applicant',
                ];
                ApplicationAttachments::create($attach);
            }
        } 
        return $application_details_data;

    }

    public function loadPrincipalRecuritmentApplication($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        if($response_data!="" && $response_data!=null){
            $response_data->attachments=ApplicationAttachments::where('ApplicationDetailsId',$response_data->id)->get();
        }
        return $this->successResponse($response_data);
    }
    
    public function updatePrincipalApproval(Request $request){
        $data =[
            'status'                        =>   $request->status,
            'remarks'                       =>   $request->remarks,
            'updated_by'                    =>   $request->user_id,
        ];
        ApplicationDetails::where('application_no', $request->application_number)->update($data);

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
                    ApplicationAttachments::create($attach);
                }
            }
        }
        $application_details=ApplicationDetails::where('application_no',$request->application_number)->first();
        return $application_details;
    }
    public function UpdateExpatriateRecuritment(Request $request){
        $data =[
            'status'                        =>   $request->status,
            'remarks'                       =>   $request->remarks,
            'updated_by'                    =>   $request->user_id,
        ];
        ApplicationDetails::where('application_no', $request->application_number)->update($data);

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
                    ApplicationAttachments::create($attach);
                }
            }
        }
        
        $application_details=ApplicationDetails::where('application_no',$request->application_number)->first();
        return $application_details;
    }

    private function generateApplicationNo(){
        $last_seq=ApplicationSequence::where('service_name','Principal Recuritment')->first();

        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Principal Recuritment',
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::where('service_name', 'Principal Recuritment')->update($app_details);
        }
        $application_no='Recu-';
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

    private function generateApplicationNoForExpatriate(){
        $last_seq=ApplicationSequence::where('service_name','Expatriate_Recuritment')->first();

        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Expatriate_Recuritment',
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];
            ApplicationSequence::where('service_name', 'Expatriate_Recuritment')->update($app_details);
        }
        $application_no='Expat-';
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
}
