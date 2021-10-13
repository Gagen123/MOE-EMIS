<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\OrganizationDetails;
use App\Models\ApplicationSequence;
use App\Models\establishment\ApplicationAttachments;
use App\Models\restructuring\Bifurcation;
use App\Models\establishment\ApplicationClassStream;
use App\Models\establishment\ApplicationDetails;
use App\Models\Masters\Classes;
use App\Models\Masters\Stream;
use Illuminate\Support\Carbon;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\HistoryForOrganizaitonDetail;
use Illuminate\Support\Facades\DB;

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
        if($request->action_type!="edit"){
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
            $data =[
                'application_no'       =>  $application_no,
                'establishment_type'   =>  $request['application_for'],
                'application_type'     =>  $request['application_type'],
                'dzongkhagId'          =>  $request['dzongkhag1'],
                'gewogId'              =>  $request['gewog1'],
                'chiwogId'             =>  $request['chiwog1'],
                'year'                 =>  date('Y'),
                'status'               =>  $request['status'],
                'created_by'           =>  $request['action_by'],
                'created_at'           =>  date('Y-m-d h:i:s'),

            ];

            $establishment = ApplicationDetails::create($data);
            $lastInsertId = $establishment->id;

            if($request->attachment_details!=null && $request->attachment_details!=""){
                foreach($request->attachment_details as $att){
                    $attach =[
                        'ApplicationDetailsId'      =>  $lastInsertId,
                        'path'                      =>  $att['path'],
                        'user_defined_file_name'    =>  $att['user_defined_name'],
                        'name'                      =>  $att['original_name'],
                        'updoad_type'               =>  'Applicant',
                    ];
                    ApplicationAttachments::create($attach);
                }
            }

            $bir = [
                'ApplicationDetailsId'         =>  $lastInsertId,
                'organizationId'               =>  $request['parent_id'],
                'proposedName'                 =>  $request['name'],
                'proposedName1'                =>  $request['name1'],
                'dateOfBifurcation'            =>  date('Y-m-d'),
                'levelId'                      =>  $request['level1'],
                'locationId'                   =>  $request['location1'],
                'isGeoPoliticallyLocated'      =>  $request['geoLocated1'],
                'isSenSchool'                  =>  $request['senSchool1'],
                'isFeedingSchool'              =>  $request['parentSchool1']
            ];

            $bifurcation = Bifurcation::create($bir);

            if($request->class1!="" && sizeof($request->class1)>0){
                foreach ($request->class1 as $cls){
                    $class_data = [
                        'foreignKeyFor'     => 'Bifurcation',
                        'ApplicationDetailsId'     =>$lastInsertId,
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
                                'foreignKeyFor'     => 'Bifurcation',
                                'ApplicationDetailsId'     =>$lastInsertId,
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
        }
        else{
            $data =[
                'dzongkhagId'          =>  $request['dzongkhag1'],
                'gewogId'              =>  $request['gewog1'],
                'chiwogId'             =>  $request['chiwog1'],
            ];
            ApplicationDetails::where('id',$request->appId)->update($data);
            $establishment = ApplicationDetails::where('id',$request->appId)->first();
            $lastInsertId=$request->appId;
            if($request->attachment_details!=null && $request->attachment_details!=""){
                foreach($request->attachment_details as $att){
                    $attach =[
                        'ApplicationDetailsId'      =>  $lastInsertId,
                        'path'                      =>  $att['path'],
                        'user_defined_file_name'    =>  $att['user_defined_name'],
                        'name'                      =>  $att['original_name'],
                        'updoad_type'               =>  'Applicant',
                    ];
                    ApplicationAttachments::create($attach);
                }
            }

            $bir = [
                'ApplicationDetailsId'         =>  $lastInsertId,
                'organizationId'               =>  $request['parent_id'],
                'proposedName'                 =>  $request['name1'],
                'proposedName1'                =>  $request['name'],
                'dateOfBifurcation'            =>  date('Y-m-d'),
                'levelId'                      =>  $request['level1'],
                'locationId'                   =>  $request['location1'],
                'isGeoPoliticallyLocated'      =>  $request['geoLocated1'],
                'isSenSchool'                  =>  $request['senSchool1'],
                'isFeedingSchool'              =>  $request['parentSchool1']
            ];
            Bifurcation::where('ApplicationDetailsId',$lastInsertId)->update($bir);
            if($request->class1!="" && sizeof($request->class1)>0){
                ApplicationClassStream::where('ApplicationDetailsId',$lastInsertId)->delete();
                foreach ($request->class1 as $cls){
                    $class_data = [
                        'foreignKeyFor'     => 'Bifurcation',
                        'ApplicationDetailsId'     =>$lastInsertId,
                        'classId'           => $cls,
                        'created_by'        => $request->user_id,
                        'created_at'        => date('Y-m-d h:i:s'),
                    ];

                    ApplicationClassStream::create($class_data);
                }
            }
            $inserted_class="";
            if($request->stream1!="" && sizeof($request->stream1)>0){
                foreach ($request->stream1 as $stm){
                    foreach ($request->class1 as $cls){
                        if(explode('##',$stm)[0]==$cls){
                            $stream_data = [
                                'foreignKeyFor'     => 'Bifurcation',
                                'ApplicationDetailsId'     =>$lastInsertId,
                                'classId'           => $cls,
                                'streamId'          => explode('##',$stm)[1],
                                'created_by'        => $request->user_id,
                                'created_at'        => date('Y-m-d h:i:s'),
                            ];
                            if(strpos($inserted_class,$cls)===false){
                                $inserted_class.=$cls;
                            }
                            ApplicationClassStream::create($stream_data);
                        }
                    }
                }
            }
        }

        //This might not be needed as we have only one class stream

        // if($request->class1!="" && sizeof($request->class1)>0){
        //     foreach ($request->class1 as $cls){
        //         $class_data = [
        //             'foreignKeyFor'     => 'Bifurcation2',
        //             'ApplicationDetailsId'     =>$bifurcation->id,
        //             'classId'           => $cls,
        //             'created_by'        => $request->user_id,
        //             'created_at'        => date('Y-m-d h:i:s'),
        //         ];
        //         $class = ApplicationClassStream::create($class_data);
        //     }
        // }

        // $inserted_class1="";
        // if($request->stream1!="" && sizeof($request->stream1)>0){
        //     foreach ($request->stream1 as $stm){
        //         foreach ($request->class1 as $cls){
        //             if(explode('##',$stm)[0]==$cls){
        //                 $stream_data = [
        //                     'foreignKeyFor'     => 'Bifurcation2',
        //                     'ApplicationDetailsId'     =>$bifurcation->id,
        //                     'classId'           => $cls,
        //                     'streamId'          => explode('##',$stm)[1],
        //                     'created_by'        => $request->user_id,
        //                     'created_at'        => date('Y-m-d h:i:s'),
        //                 ];
        //                 if(strpos($inserted_class1,$cls)===false){
        //                     $inserted_class1.=$cls;
        //                 }
        //                 $strm = ApplicationClassStream::create($stream_data);
        //             }
        //         }
        //     }
        // }

        return $this->successResponse($establishment, Response::HTTP_CREATED);

    }

    public function loadBifurcationForVerification($appNo=""){
        $response_data=ApplicationDetails::where('application_no',$appNo)->first();
        $response_data->application_date=date_format(Carbon::parse($response_data->created_at), 'Y-m-d h:i:s');
        $bifurcation=Bifurcation::where('ApplicationDetailsId',$response_data->id)->first();
        // $response_data->class_stream=ApplicationClassStream::where('ApplicationDetailsId',$response_data->id)->get();
        $response_data->class_stream=DB::table('classes as c')
        ->join('application_class_stream as cl', 'c.id', '=', 'cl.classId')
        ->select('cl.*', 'c.class', 'c.id AS classId')
        ->where('cl.ApplicationDetailsId',$response_data->id)
        ->orderBy('c.displayOrder', 'asc')
        ->get();
        $response_data->bifurcation = $bifurcation;
        $response_data->attachments= ApplicationAttachments::where('ApplicationDetailsId',$response_data->id)->get();

        return $this->successResponse($response_data);
    }
    /**
     * method to load organization details
     */
    // public function loadBifurcation(){
    //     $orgDetails = OrganizationDetails::all();
    //     return $orgDetails;
    // }

    public function updateBifurcation(Request $request){
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
        $estd =[
            'status'                       =>   $request->status,
            'remarks'                      =>   $request->remarks,
            'updated_by'                   =>   $request->user_id,
            'updated_at'                   =>   date('Y-m-d h:i:s'),
        ];
        $establishment = Bifurcation::where('applicationNo', $request->application_number)->update($estd);
        //update the main organizaiton
        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

/**
     * to update after approving/rejecting
     */

    public function updateBifurcationDetails(Request $request){
        if($request->status=="Approved"){
            $response_data = OrganizationDetails::where('id', $request->ParentOrganizationId)->first();
                $data =[
                    'id'                         =>   $response_data->id,
                    'name'                       =>   $response_data->name,
                    'code'                       =>   $response_data->code,
                    'organizationType'           =>   $response_data->organizationType,
                    'zestAgencyCode'             =>   $response_data->zestAgencyCode,
                    'yearOfEstablishment'        =>   $response_data->yearOfEstablishment,
                    'category'                   =>   $response_data->category,
                    'levelId'                    =>   $response_data->levelId,
                    'dzongkhagId'                =>   $response_data->dzongkhagId,
                    'gewogId'                    =>   $response_data->gewogId,
                    'chiwogId'                   =>   $response_data->chiwogId,
                    'locationId'                 =>   $response_data->locationId,
                    'created_by'                 =>   $request->user_id,
                ];
             HistoryForOrganizaitonDetail::create($data);
                $updatedData =[
                    'name'                        =>  $request->ParentOrgName,
                    'updated_at'                  =>  date('Y-m-d h:i:s'),
                    'updated_by'                  =>  $request->user_id,
                ];
            $response_data=OrganizationDetails::where('id', $request->ParentOrganizationId)->update($updatedData);

        //generating the organization code
        // $last_seq=ApplicationSequence::where('service_name','Organization Code')->first();
        //     if($last_seq==null || $last_seq==""){
        //         $last_seq=1;
        //         $app_details = [
        //             'service_name'                  =>  'Organization Code',
        //             'last_sequence'                 =>  $last_seq,
        //         ];
        //         ApplicationSequence::create($app_details);
        //     }
        //     else{
        //         $last_seq=$last_seq->last_sequence+1;
        //         $app_details = [
        //             'last_sequence'                 =>  $last_seq,
        //         ];
        //         ApplicationSequence::where('service_name', 'Organization Code')->update($app_details);
        //     }
        //         $org_code='';
        //         if(strlen($last_seq)==1){
        //             $org_code= $org_code.date('Y').'.'.date('m').'.000'.$last_seq;
        //         }
        //         else if(strlen($last_seq)==2){
        //             $org_code= $org_code.date('Y').'.'.date('m').'.00'.$last_seq;
        //         }
        //         else if(strlen($last_seq)==3){
        //             $org_code= $org_code.date('Y').'.'.date('m').'.0'.$last_seq;
        //         }
        //         else if(strlen($last_seq)==4){
        //             $org_code= $org_code.date('Y').'.'.date('m').'.'.$last_seq;
        //         }
        //     $newOrgDet =[
        //         'name'                       =>   $request->ProposedOrgName,
        //         'code'                       =>   $org_code,
        //         'organizationType'           =>   $response_data->organizationType,
        //         'bifOrgId'                   =>   $request->ParentOrganizationId,
        //         'levelId'                    =>   $request->ProposedOrglevelId,
        //         'dzongkhagId'                =>   $request->ProposedOrgdzongkhagId,
        //         'gewogId'                    =>   $request->ProposedOrgGewogName,
        //         'locationId'                 =>   $request->ProposedOrglocationId,
        //         'created_at'                 =>   $request->dateOfBifurcation,
        //     ];
        // $response_data = OrganizationDetails::create($newOrgDet);
        
        //updating to application details tables
            $app_details = [
                'status'                      =>  $request->status,
                'remarks'                     =>  $request->remarks,
                'updated_at'                  =>  date('Y-m-d h:i:s'),
                'updated_by'                  =>  $request->user_id,
            ];
            $response_data=ApplicationDetails::where('application_no',$request->application_number)->update($app_details);
            return $response_data;
        
        //saving attachments
        if(sizeof($request->attachment_details)>0){
            $application_details=  ApplicationDetails::where('application_no',$request->application_number)->first();
            foreach($request->attachment_details as $att){
                $attach =[
                    'ApplicationDetailsId'      =>  $application_details->id,
                    'path'                      =>  $att['path'],
                    'user_defined_file_name'    =>  $att['user_defined_name'],
                    'name'                      =>  $att['original_name'],
                    'upload_type'               =>  $request->status,
                    'created_by'                =>  $request->user_id,
                ];
                $response_data = ApplicationAttachments::create($attach);
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

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

        // $change_details=ApplicationEstDetailsChange::where('ApplicationDetailsId',$app_details->id)->first();
        // $org_details=OrganizationDetails::where('id',$change_details->organizationId)->first();
        // $change_details_data="";

        // $org_data =[
        //     'id'                        =>  $org_details->id,
        //     'name'                      =>  $org_details->name,
        //     'updated_by'                =>  $org_details->updated_by,
        //     'updated_at'                =>  $org_details->updated_at,
        //     'recorded_on'               =>  date('Y-m-d h:i:s'),
        //     'recorded_for'              =>  'Name Change',
        //     'recorded_by'               =>  $request->user_id,
        // ];
        // HistoryForOrganizaitonDetail::create($org_data);
        // $org_update_data =[
        //     'name'                      =>  $change_details->proposedChange,
        //     'updated_by'                =>  date('Y-m-d h:i:s'),
        //     'updated_at'                =>  $request->user_id,
        // ];
        // $change_details=OrganizationDetails::where('id',$change_details->organizationId)->update($org_update_data);

        // return $this->successResponse($change_details_data, Response::HTTP_CREATED);
    }
}
