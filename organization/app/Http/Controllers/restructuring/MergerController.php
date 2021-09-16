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
use App\Models\establishment\ApplicationAttachments;
use App\Models\ApplicationSequence;
use App\Models\HistoryForOrganizaitonDetail;
use App\Models\OrganizationDetails;

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
            'establishment_type'   =>  'Merger',
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
            'proposedName'                  =>       $request['newOrgName'],
            'levelId'                       =>       $request['newOrgLevel'],
            'Category'                      =>       $request['newOrgCategory'],
            'Dzo'                           =>       $request['newOrgDzo'],
            'Gewog'                         =>       $request['newOrgchiwog'],
            'chiwog'                        =>       $request['newOrgchiwog'],
            'locationId'                    =>       $request['newOrgLocation'],
            'OrgType'                       =>       $request['OrgType'],
            'created_by'                    =>       $request->user_id,
            'status'                        =>       'Submitted',
            'created_at'                    =>       date('Y-m-d h:i:s')
        ];

        $merger_data = ApplicationEstMerger::create($merger_data);
        
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }
    
    public function loadMergerForVerification($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        $response_data->application_date=date_format(Carbon::parse($response_data->created_at), 'Y-m-d h:i:s');
        $merger=ApplicationEstMerger::where('ApplicationDetailsId',$response_data->id)->first();
        
        $response_data->merger=$merger;
       
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

    /**
     * to update after approving/rejecting
     */

    public function updateMergerDetails(Request $request){
        $estd =[
            'status'                        =>   $request->status,
            'remarks'                       =>   $request->remarks,
            'updated_by'                    =>   $request->user_id, 
        ];
        ApplicationDetails::where('application_no', $request->application_number)->update($estd);
        if($request->status=="Approved"){
            if($request->OrgType=="org1"){
                $org_details=OrganizationDetails::where('id',$request->org1)->first();
                $org_data =[
                    'id'                        =>  $org_details->id,
                    'name'                      =>  $org_details->name,
                    'updated_by'                =>  $org_details->updated_by,
                    'updated_at'                =>  $org_details->updated_at,
                    'recorded_on'               =>  date('Y-m-d h:i:s'),
                    'recorded_for'              =>  'Name Change', 
                    'recorded_by'               =>  $request->user_id, 
                ];
                $merger_details_data = HistoryForOrganizaitonDetail::create($org_data);
                $org_update_data =[
                    // 'name'                      =>  $request->proposedName,
                    'updated_by'                =>  date('Y-m-d h:i:s'),
                    'updated_at'                =>  $request->user_id, 
                ];
                $merger_details_data=OrganizationDetails::where('id',$request->org1)->update($org_update_data);
            }

            if($request->OrgType=="org2"){
                $org_details=OrganizationDetails::where('id',$request->org2)->first();
                $org_data =[
                    'id'                        =>  $org_details->id,
                    'name'                      =>  $org_details->name,
                    'updated_by'                =>  $org_details->updated_by,
                    'updated_at'                =>  $org_details->updated_at,
                    'recorded_on'               =>  date('Y-m-d h:i:s'),
                    'recorded_for'              =>  'Name Change', 
                    'recorded_by'               =>  $request->user_id, 
                ];
                $merger_details_data = HistoryForOrganizaitonDetail::create($org_data);
                $org_update_data =[
                    // 'name'                      =>  $request->proposedName,
                    'updated_by'                =>  date('Y-m-d h:i:s'),
                    'updated_at'                =>  $request->user_id, 
                ];
                $merger_details_data=OrganizationDetails::where('application_no',$request->org1)->update($org_update_data);
            }

            if($request->OrgType=="newOrg"){
                $estd =[
                        'dzongkhagId'                   =>   $request->Dzo,
                        'gewogId'                       =>   $request->Gewog,
                        'chiwogId'                      =>   $request->chiwog,
                        'updated_by'                    =>   $request->user_id, 
                ];
                ApplicationDetails::where('application_no', $request->application_number)->update($estd);
            }
            return $this->successResponse($merger_details_data, Response::HTTP_CREATED);
        }
        // ata tshewang old code
        // if($request->attachment_details!="" ){
        //     $type="Verification";
        //     if($request->status=="Approved"){
        //         $type="Approval";
        //     }
        //     if(sizeof($request->attachment_details)>0){
        //         $application_details=  ApplicationDetails::where('application_no',$request->application_number)->first();
        //         foreach($request->attachment_details as $att){
        //             $attach =[
        //                 'ApplicationDetailsId'      =>  $application_details->id,
        //                 'path'                      =>  $att['path'],
        //                 'user_defined_file_name'    =>  $att['user_defined_name'],
        //                 'name'                      =>  $att['original_name'],
        //                 'upload_type'               =>  $type,
        //                 'created_by'                =>  $request->user_id, 
        //             ];
        //             $doc = ApplicationAttachments::create($attach);
        //         }
        //     }
        // }

        // $app_details = ApplicationDetails::where('application_no', $request->application_number)->first();

        // $merger_details=ApplicationEstMerger::where('ApplicationDetailsId',$app_details->id)->first();
        // $org_details=OrganizationDetails::where('id',$merger_details->OldOrganizationId2)->first();
        // $merger_details_data="";

        // $org_data =[
        //     'id'                        =>  $org_details->id,
        //     'name'                      =>  $org_details->name,
        //     'updated_by'                =>  $org_details->updated_by,
        //     'updated_at'                =>  $org_details->updated_at,
        //     'recorded_on'               =>  date('Y-m-d h:i:s'),
        //     'recorded_for'              =>  'Name Change', 
        //     'recorded_by'               =>  $request->user_id, 
        // ];
        // $merger_details_data = HistoryForOrganizaitonDetail::create($org_data);
        // if($merger_details->proposedName != "" && $merger_details->proposedName != NULL){
        //     $org_update_data =[
        //         'name'                      =>  $merger_details->proposedName,
        //         'updated_by'                =>  date('Y-m-d h:i:s'),
        //         'updated_at'                =>  $request->user_id, 
        //     ];
        //     $merger_details_data=OrganizationDetails::where('id',$merger_details->OldOrganizationId)->update($org_update_data);
            
        // }
        
    }

}
