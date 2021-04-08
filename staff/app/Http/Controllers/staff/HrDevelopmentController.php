<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff\HrDevelopment;
use App\Models\staff\DocumentDetails;
use App\Models\staff\HrWorkflow;

class HrDevelopmentController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function saveprogramDetails(Request $request){
        $response_data=[];
        if($request->id==""){
            $rules = [
                'training_type'             =>  'required  ',
                'course_title'              =>  'required',
                'organizer'                 =>  'required',
                'start_date'                =>  'required | date',
                'end_date'                  =>  'required | date',
            ];
            $customMessages = [
                'training_type.required'               => 'Please select training type',
                'course_title.required'                => 'Please mention course title ',
                'organizer.required'                   => 'Please select organizer',
            ];
            if(strpos($request->training_type_text,'qualification upgrad')!==false){
                $rules=array_merge($rules,
                    array('category'       =>  'required',
                    'donor_agency'         =>  'required',
                    'study_country'        =>  'required',
                    'coursemode'           =>  'required',
                    'degree'               =>  'required',
                    'subject1'             =>  'required',
                    'thesis_title'         =>  'required',)
                );
                $customMessages =array_merge($rules,
                    array(
                        'category.required'           => 'Please select category',
                        'donor_agency.required'       => 'Please select donor agency',
                        'study_country.required'      => 'Please select country',
                        'coursemode.required'         => 'Please select course mode',
                        'degree.required'             => 'Please select degree',
                        'subject1.required'           => 'Please select subject',
                        'thesis_title.required'       => 'Please mention title',
                    )
                );
            }
            if(strpos($request->training_type_text,'professional development')!==false){
                $rules=array_merge($rules,
                    array('programme_level'     =>  'required',
                        'programme_type'        =>  'required',
                        'course_type'           =>  'required',
                        'course_provider'       =>  'required',
                        'vanue'                 =>  'required',
                        'total_budget'          =>  'required',
                        'total_hrs'             =>  'required',
                        'financial_source'      =>  'required',
                    )
                );
                $customMessages =array_merge($rules,
                    array(
                        'programme_level.required'          => 'Please select programme level',
                        'programme_type.required'           => 'Please select programme type',
                        'course_type.required'              => 'Please select couorse type',
                        'course_provider.required'          =>  'Please select course provider',
                        'vanue.required'                    =>  'Plese mention place/vanue',
                        'total_budget.required'             =>  'Please provide total budget',
                        'total_hrs.required'                =>  'Please mention total hrs',
                        'financial_source.required'         =>  'Please select financial source',
                    )
                );
            }
            $this->validate($request, $rules,$customMessages);
        }
        $request_data =[
            'id'                                =>  $request->id,
            'training_type'                     =>  $request->training_type,
            'course_title'                      =>  $request->course_title,
            'organizer'                         =>  $request->organizer,
            'start_date'                        =>  $request->start_date,
            'end_date'                          =>  $request->end_date,
            'related_programme'                 =>  $request->related_programme,
            'programme_level'                   =>  $request->programme_level,
            'programme_type'                    =>  $request->programme_type,
            'course_type'                       =>  $request->course_type,
            'course_provider'                   =>  $request->course_provider,
            'vanue'                             =>  $request->vanue,
            'total_budget'                      =>  $request->total_budget,
            'total_hrs'                         =>  $request->total_hrs,
            'financial_source'                  =>  $request->financial_source,
            'category'                          =>  $request->category,
            'donor_agency'                      =>  $request->donor_agency,
            'projectofdonor'                    =>  $request->projectofdonor,
            'study_country'                     =>  $request->study_country,
            'coursemode'                        =>  $request->coursemode,
            'degree'                            =>  $request->degree,
            'subject1'                          =>  $request->subject1,
            'subject2'                          =>  $request->subject2,
            'thesis_title'                      =>  $request->thesis_title,
        ];
        if($request->status=="Pending"){
            $request_data=array_merge($request_data,
                array('created_by'            =>  $request->user_id,
                      'created_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->status=="Created"){
            $request_data=array_merge($request_data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->id==""){
            $response_data = HrDevelopment::create($request_data);
            foreach($request->attachment_details as $att){
                $doc_data =[
                    'parent_id'                        =>  $response_data->id,
                    'attachment_for'                   =>  'Hr Development Programme',
                    'path'                             =>  $att['path'],
                    'original_name'                    =>  $att['original_name'],
                    'user_defined_name'                =>  $att['user_defined_name'],
                ];
                $doc = DocumentDetails::create($doc_data);
            }
        }
        else{
            $act_det = HrDevelopment::where ('id', $request->id)->firstOrFail();
            $act_det->fill($request_data);
            $response_data=$act_det->save();
            if($request->attachment_details!=null && $request->attachment_details!=""){
                foreach($request->attachment_details as $att){
                    $doc_data =[
                        'parent_id'                        =>  $request->id,
                        'attachment_for'                   =>  'Hr Development Programme',
                        'path'                             =>  $att['path'],
                        'original_name'                    =>  $att['original_name'],
                        'user_defined_name'                =>  $att['user_defined_name'],
                    ];
                    $doc = DocumentDetails::create($doc_data);
                }
            }
            
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadDraftDetails($user_id=""){
        return $this->successResponse(HrDevelopment::where('created_by',$user_id)->where('status','Pending')->first());
    }
    public function loadDocuments($id=""){
        return $this->successResponse(DocumentDetails::where('parent_id',$id)->get());
    }
    
    public function deleteFile($id=""){
        $attachment = DocumentDetails::findOrFail($id);
        $attachment->delete();
        return $this->successResponse($attachment);
    }
    
    public function saveprogramFinalDetails(Request $request){
        $rules = [
            'nomination_start_date'             =>  'required | date',
            'nomination_end_date'               =>  'required | date',
            'nature_of_participant'             =>  'required',
            // 'target_group'                      =>  'required',
            'role_action_mapp'                  =>  'required',
            
        ];
        $customMessages = [
            'nomination_start_date.required'              => 'Please select nomination start date',
            'nomination_end_date.required'                => 'Please select nomination end date',
            'nature_of_participant.required'              => 'Please select this field',
            // 'target_group.required'                       => 'Please select this field',
            'role_action_mapp.required'                   => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $participant="";
        if($request->nature_of_participant!=null && $request->nature_of_participant!=""){
            $participant=implode($request->nature_of_participant,', ');
        }
        $target_group="";
        if($request->target_group!=null && $request->target_group!=""){
            $target_group=implode($request->target_group,', ');
        }
        $org_level="";
        if($request->org_level!=null && $request->org_level!=""){
            $org_level=implode($request->org_level,', ');
        }
        $request_data =[
            'nomination_start_date'            =>  $request->nomination_start_date,
            'nomination_end_date'              =>  $request->nomination_end_date,
            'nature_of_participant'            =>  $participant,
            'target_group'                     =>  $target_group,
            'org_level'                        =>  $org_level,
            'published_date'                   =>  date('Y-m-d h:i:s'),
            'remarks'                          =>  $request->remarks,
            'status'                           =>  'Created',
            
        ];
        $act_det = HrDevelopment::where ('id', $request->id)->firstOrFail();
        $act_det->fill($request_data);
        $response_data=$act_det->save();

        foreach ($request->role_action_mapp as $i=> $rol){
            $work_details = array(
                'program_id'=>$request->id,
                'sequence'=>$rol['sequence'],
                'authority_type'=>$rol['authority'],
                'sys_role_id'=>$rol['role'],
            );
            $action_Id= HrWorkflow::create($work_details);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}
