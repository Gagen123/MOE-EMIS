<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Models\hr_development_masters\CourseType;
use App\Models\hr_development_masters\FinancialSource;
use App\Models\hr_development_masters\NatureOfParticipant;
use App\Models\hr_development_masters\OpenProgramme;
use App\Models\hr_development_masters\ProgrammeLevel;
use App\Models\hr_development_masters\ProgrammeType;
use App\Models\hr_development_masters\RelatedProgramme;
use App\Models\hr_development_masters\TrainingType;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff\HrDevelopment;
use App\Models\staff\DocumentDetails;
use App\Models\staff\HrWorkflow;
use App\Models\staff\Participant;
use App\Models\staff\ApplicationSequence;
use App\Models\staff\ParticipantsEID;
use App\Models\staff\PersonalDetails;
use App\Models\staff\ProgramApplication;
use App\Models\staff_masters\ChildGroupPosition;
use App\Models\staff_masters\PositionLevel;
use App\Models\staff_masters\PositionTitle;

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
            $procid=DB::select("CALL emis_program_detils_audit_proc('".$request->id."','".$request->user_id."','program_details')");
            $request_data=array_merge($request_data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->id==""){
            $response_data = HrDevelopment::create($request_data);
            if($request->attachment_details!="" && $request->attachment_details!=null){
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

        }
        else{
            $act_det = HrDevelopment::where ('id', $request->id)->first();
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
            $response_data = HrDevelopment::where ('id', $request->id)->first();
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
        // $rules = [
        //     'nomination_start_date'             =>  'required | date',
        //     'nomination_end_date'               =>  'required | date',
        //     'nature_of_participant'             =>  'required',
        //     // 'target_group'                      =>  'required',
        //     // 'role_action_mapp'                  =>  'required',

        // ];
        // $customMessages = [
        //     'nomination_start_date.required'              => 'Please select nomination start date',
        //     'nomination_end_date.required'                => 'Please select nomination end date',
        //     'nature_of_participant.required'              => 'Please select this field',
        //     // 'target_group.required'                       => 'Please select this field',
        //     // 'role_action_mapp.required'                   => 'This field is required',
        // ];
        // $this->validate($request, $rules,$customMessages);
        // $participant="";
        // if($request->nature_of_participant!=null && $request->nature_of_participant!=""){
        //     $participant=implode(', ',$request->nature_of_participant);
        // }
        // $target_group="";
        // if($request->target_group!=null && $request->target_group!=""){
        //     $target_group=implode(', ',$request->target_group);
        // }
        // $org_level="";
        // if($request->org_level!=null && $request->org_level!=""){
        //     $org_level=implode(', ',$request->org_level);
        // }
        // $request_data =[
        //     'nomination_start_date'            =>  $request->nomination_start_date,
        //     'nomination_end_date'              =>  $request->nomination_end_date,
        //     'nature_of_participant'            =>  $participant,
        //     // 'target_group'                     =>  $target_group,
        //     'org_level'                        =>  $org_level,
        //     'published_date'                   =>  date('Y-m-d h:i:s'),
        //     'remarks'                          =>  $request->remarks,
        //     'status'                           =>  'Created',
        // ];
        // $act_det = HrDevelopment::where ('id', $request->id)->first();

        // $act_det->fill($request_data);
        // $response_data=$act_det->save();
        // $workflow=HrWorkflow::where('program_id',$request->id)->get();
        // if(sizeof($workflow)>0){
        //     $procid=DB::select("CALL emis_program_detils_audit_proc('".$request->id."','".$request->user_id."','workflow')");
        //     HrWorkflow::where('program_id',$request->id)->delete();
        // }
        // foreach ($request->role_action_mapp as $i=> $rol){
        //     $work_details = array(
        //         'program_id'=>$request->id,
        //         'sequence'=>$rol['sequence'],
        //         'authority_type'=>$rol['authority'],
        //         'sys_role_id'=>$rol['role'],
        //     );
        //     $action_Id= HrWorkflow::create($work_details);
        // }
        $response_data=[];
        if($request->id==""){
            $rules = [
                'training_type'             =>  'required  ',
                'course_title'              =>  'required',
                'organizer'                 =>  'required',
                'start_date'                =>  'required | date',
                'end_date'                  =>  'required | date',
                'programme_level'           =>  'required',
                'programme_type'            =>  'required',
                'course_type'               =>  'required',
                'course_provider'           =>  'required',
                'vanue'                     =>  'required',
                'total_budget'              =>  'required',
                'financial_source'          =>  'required',
                'nature_of_participant'     =>  'required',

            ];
            $customMessages = [
                'training_type.required'                => 'Please select training type',
                'course_title.required'                 => 'Please mention course title ',
                'organizer.required'                    => 'Please select organizer',
                'start_date.required'                   => 'Please select start date',
                'end_date.required'                     => 'Please select end date',
                'programme_level.required'              => 'Please select programme level',
                'programme_type.required'               => 'Please select programme type',
                'course_type.required'                  => 'Please select couorse type',
                'course_provider.required'              =>  'Please select course provider',
                'vanue.required'                        =>  'Plese mention place/vanue',
                'total_budget.required'                 =>  'Please provide total budget',
                'financial_source.required'             =>  'Please select financial source',
                'nature_of_participant.required'        =>  'Please select Nature of participant',
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
            'expenditurel_budget'               =>  $request->expenditurel_budget,
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
            'nature_of_participant'             =>  $request->nature_of_participant,
            'remarks'                           =>  $request->remarks,
            'status'                            =>  'Created',
        ];

        if($request->status=="Pending"){
            $request_data=array_merge($request_data,
                array('created_by'            =>  $request->user_id,
                      'created_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->status=="Created"){
            // $procid=DB::select("CALL emis_program_detils_audit_proc('".$request->id."','".$request->user_id."','program_details')");
            $request_data=array_merge($request_data,
                array('updated_by'            =>  $request->user_id,
                      'updated_at'            =>  date('Y-m-d h:i:s')
                )
            );
        }
        if($request->id==""){
            $response_data = HrDevelopment::create($request_data);
            if($request->attachment_details!="" && $request->attachment_details!=null){
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

        }
        else{
            $act_det = HrDevelopment::where ('id', $request->id)->first();
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
            $response_data = HrDevelopment::where ('id', $request->id)->first();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadprogramDetails($param=""){
        // $response_data="";
        // if(strpos($param,'SSS')){
        //     $access_level=explode('SSS',$param)[0];
        //     // if($access_level=="Ministry"){
        //     //     $response_data=HrDevelopment::all();
        //     // }
        //     // if($access_level=="Dzongkhag"){
        //     //     $response_data=HrDevelopment::all();
        //     // }
        //     // if($access_level=="Org"){
        //     //     $response_data=HrDevelopment::all();
        //     // }
        // }
        $response_data=HrDevelopment::all();
        return $this->successResponse($response_data);
    }

    public function loadDetails($id=""){
        parse_str($id,$param_array);
        $app_det=ProgramApplication::where('program_id',$param_array['id'])->where('org_id',$param_array['org'])->where('dzo_id',$param_array['dzongkhag'])->first();
        // if($app_det!=null && $app_det!=""){
        //     $hrdev= $app_det;
        // }
        // else{
        //     $hrdev=HrDevelopment::where('id',$param_array['id'])->where('status','Created')->first();
        //     if($hrdev!="" && $hrdev!=null){
        //         $hrdev->workflow=HrWorkflow::where('program_id',$param_array['id'])->orderBy('sequence')->get();
        //     }
        // }
        $hrdev=HrDevelopment::where('id',$param_array['id'])->first();
        if($hrdev!=null && $hrdev!=""){
            $training_typ=TrainingType::where('id',$hrdev->training_type)->first();
            if($training_typ!=null && $training_typ!=""){
                $hrdev->trainingtype=$training_typ->name;
            }

            $related=RelatedProgramme::where('id',$hrdev->related_programme)->first();
            if($related!=null && $related!=""){
                $hrdev->related=$related->name;
            }
            $hrdev->financial_source_id=$hrdev->financial_source;
            $financial_source=FinancialSource::where('id',$hrdev->financial_source)->first();
            if($financial_source!=null && $financial_source!=""){
                $hrdev->financial_source=$financial_source->name;
            }
            $hrdev->programme_level_id=$hrdev->programme_level;
            $programme_level=ProgrammeLevel::where('id',$hrdev->programme_level)->first();
            if($programme_level!=null && $programme_level!=""){
                $hrdev->programme_level=$programme_level->name;
            }
            $hrdev->programme_type_id=$hrdev->programme_type;
            $programme_type=ProgrammeType::where('id',$hrdev->programme_type)->first();
            if($programme_type!=null && $programme_type!=""){
                $hrdev->programme_type=$programme_type->name;
            }
            $hrdev->course_type_id=$hrdev->course_type;
            $course_type=CourseType::where('id',$hrdev->course_type)->first();
            if($course_type!=null && $course_type!=""){
                $hrdev->course_type=$course_type->name;
            }

            $nparticipate=[];
            $nparticipatefortransaction=[];
            if($hrdev->nature_of_participant!=null && $hrdev->nature_of_participant!=""){
                if(strpos($hrdev->nature_of_participant,',')){
                    $parti=explode(',',$hrdev->nature_of_participant);
                    foreach($parti as $par){
                        $partype=NatureOfParticipant::where('id',$par)->first();
                        if($partype!=null && $partype!=""){
                            array_push($nparticipate,$partype->name);
                            array_push($nparticipatefortransaction,$partype);
                        }
                    }
                }else{
                    $partype=NatureOfParticipant::where('id',$hrdev->nature_of_participant)->first();
                    if($partype!=null && $partype!=""){
                        array_push($nparticipate,$partype->name);
                        array_push($nparticipatefortransaction,$partype);
                    }
                }
            }
            $hrdev->participantType=$nparticipate;
            $hrdev->nparticipatefortransaction=$nparticipatefortransaction;

        }
        $hrdev->prog_app=ProgramApplication::where('program_id',$param_array['id'])->first();
        $hrdev->attachments=DocumentDetails::where('parent_id',$param_array['id'])->get();
        return $this->successResponse($hrdev);
    }

    public function loadProgramDetailsForNomination($param=""){
        $param = rtrim($param, ", ");
        $param=explode(',',$param);

        // $work_details=HrWorkflow::with('with_program')->wherein('sys_role_id',$param)->get();
        // foreach($work_details as $work){
        //     $work->pro_app=ProgramApplication::where('program_id',$work->program_id)->first();
        // }
        $work_details=HrDevelopment::where('status','Created')->get();


        // if(sizeof($work_details)>0){
        //     foreach($work_details as $work){
        //         $work->actiontype='Nominating';
        //     }
        // }
        // else{
        //     //selection
        //     $work_details=HrWorkflow::with('with_program')->wherein('sys_role_id',$param)->where('sequence',2)->get();
        //     foreach($work_details as $work){
        //         $work->actiontype='Shortlisting & Selection';
        //     }
        // }
        return $this->successResponse($work_details);
    }

    public function saveParticipant(Request $request){
        if($request->partifipant_from!="Excel"){
            $rules = [
                'programId'             =>  'required',
                'participant'           =>  'required',
                'contact'               =>  'required',
                'email'                 =>  'required',
                'nature_of_participant' =>  'required',
            ];
            $customMessages = [
                'programId.required'              => 'Please select nomination start date',
                'participant.required'            => 'Please select nomination end date',
                'contact.required'                => 'Please select this field',
                'email.required'                  => 'This field is required',
                'nature_of_participant.required'  => 'This field is required',
            ];
            $this->validate($request, $rules,$customMessages);
            if($request->action_type=="add"){
                $request_data =[
                    'program_id'                =>  $request->programId,
                    'org_id'                    =>  $request->org_id,
                    'dzo_id'                    =>  $request->dzo_id,
                    'participant_id'            =>  $request->participant,
                    'contact'                   =>  $request->contact,
                    'email'                     =>  $request->email,
                    'nature_of_participant'     =>  $request->nature_of_participant,
                    'created_by'                =>  $request->user_id,
                    'created_at'                =>  date('Y-m-d h:i:s')
                ];
                $response_data= Participant::create($request_data);
            }
            else{
                $request_data =[
                    'org_id'                    =>  $request->org_id,
                    'dzo_id'                    =>  $request->dzo_id,
                    'participant_id'            =>  $request->participant,
                    'contact'                   =>  $request->contact,
                    'email'                     =>  $request->email,
                    'nature_of_participant'     =>  $request->nature_of_participant,
                    'created_by'                =>  $request->user_id,
                    'created_at'                =>  date('Y-m-d h:i:s')
                ];
                $act_det = Participant::where ('id', $request->id)->first();
                $act_det->fill($request_data);
                $response_data=$act_det->save();
                $response_data= Participant::where('id',$request->id)->first();
            }

        }else{
            if($request->participantFile!=null && $request->participantFile!="" && sizeof($request->participantFile)>0){
                $response_data= ParticipantsEID::where('created_by',$request->user_id)->delete();
                foreach($request->participantFile as $par){
                    $is_match=1;
                    $name="";
                    $participant_id="";
                    $contact="";
                    $email="";
                    $parsonal=PersonalDetails::where('emp_id',$par)->first();
                    if($parsonal!=null && $parsonal!=""){
                        $name=$parsonal->name;
                        $participant_id=$parsonal->id;
                        $contact=$parsonal->contact_no;
                        $email=$parsonal->email;
                    }else{
                        $is_match=0;
                    }
                    $request_data =[
                        'eid'                       =>  $par,
                        'nature_of_participant'     =>  $request->nature_of_participant,
                        'is_match'                  =>  $is_match,
                        'name'                      =>  $name,
                        'program_id'                =>  $request->programId,
                        'org_id'                    =>  $request->org_id,
                        'dzo_id'                    =>  $request->dzo_id,
                        'participant_id'            =>  $participant_id,
                        'contact'                   =>  $contact,
                        'email'                     =>  $email,
                        'created_by'                =>  $request->user_id,
                        'created_at'                =>  date('Y-m-d h:i:s')
                    ];
                    $response_data= ParticipantsEID::create($request_data);
                    $response_data= ParticipantsEID::where('created_by',$request->user_id)->get();
                    if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
                        foreach($response_data as $data){
                            $nature=NatureOfParticipant::where('id',$data->nature_of_participant)->first();
                            if($nature!=null && $nature!=""){
                                $data->natureOfParticipant=$nature->name;
                            }
                            $response_data->id= $data->program_id; //for the attachment
                        }
                    }
                }
            }
        }
        if(!$request->attachment_details==null){
            foreach($request->attachment_details as $att){
                $doc_data =[
                    'parent_id'                        =>  $response_data->id,
                    'attachment_for'                   =>  'Participant',
                    'path'                             =>  $att['path'],
                    'original_name'                    =>  $att['name'],
                ];
                $doc = DocumentDetails::create($doc_data);
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function getParticipantDetails($param=""){
        parse_str($param,$param_array);
        if($param_array['action_type']=="nomination"){
            $response_details=Participant::where('dzo_id',$param_array['dzongkhag'])->where('org_id',$param_array['org'])->where('program_id',$param_array['program_id'])->get();
            foreach($response_details as $part){
                $part->StaffID=$part->participant_id;
                $part->document=DocumentDetails::where('parent_id',$part->id)->get();
                $parti=NatureOfParticipant::where('id',$part->nature_of_participant)->first();
                if($parti!=null && $parti!=""){
                    $part->participacingas=$parti->name;
                }
            }
            $response_details=$this->getstaff_positiondirectory($response_details,'Array');
        }
        else if($param_array['action_type']=="verification"){
            $response_details=Participant::where('program_id',explode('SSS',$param_array['program_id'])[0])->where('org_id',explode('SSS',$param_array['program_id'])[1])->get();
            foreach($response_details as $part){
                $part->StaffID=$part->participant_id;
                $part->document=DocumentDetails::where('parent_id',$part->id)->get();
                $parti=NatureOfParticipant::where('id',$part->nature_of_participant)->first();
                if($parti!=null && $parti!=""){
                    $part->participacingas=$parti->name;
                }
            }
            $response_details=$this->getstaff_positiondirectory($response_details,'Array');
        }
        else if($param_array['action_type']=="orgdetails"){
            if($param_array['accessLevel']=="Ministry"){
                $response_details=ProgramApplication::where('program_id',$param_array['program_id'])->get();
            }
            else{
                $response_details=ProgramApplication::where('program_id',$param_array['program_id'])->where('dzo_id',$param_array['dzongkhag'])->get();
            }
        }
        return $this->successResponse($response_details);
    }

    public function getParticipantDetailsById($id=""){
        $response_details=Participant::where('id',$id)->first();
        $response_details->document=DocumentDetails::where('parent_id',$response_details->id)->get();
        return $this->successResponse($response_details);
    }

    public function deleteParticipant($id=""){
        $response_data = Participant::findOrFail($id);
        $response_data->delete();
        return $this->successResponse($response_data);
    }

    public function submitParticipants(Request $request){
        $app_det=ProgramApplication::where('program_id',$request->programId)->where('org_id',$request->org_id)->where('dzo_id',$request->dzo_id)->first();
        if($app_det==""){
            $last_seq=ApplicationSequence::where('service_name','Hr Development')->first();
            if($last_seq==null || $last_seq==""){
                $last_seq=1;
                $app_details = [
                    'service_name'                  =>  'Hr Development',
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::create($app_details);
            }
            else{
                $last_seq=$last_seq->last_sequence+1;
                $app_details = [
                    'last_sequence'                 =>  $last_seq,
                ];
                ApplicationSequence::where('service_name', 'Hr Development')->update($app_details);
            }
            $appNo='';
            if(strlen($last_seq)==1){
                $appNo= $appNo.date('Y').'.'.date('m').'.000'.$last_seq;
            }
            else if(strlen($last_seq)==2){
                $appNo= $appNo.date('Y').'.'.date('m').'.00'.$last_seq;
            }
            else if(strlen($last_seq)==3){
                $appNo= $appNo.date('Y').'.'.date('m').'.0'.$last_seq;
            }
            else if(strlen($last_seq)==4){
                $appNo= $appNo.date('Y').'.'.date('m').'.'.$last_seq;
            }
            $request_data =[
                'program_id'                =>  $request->programId,
                'org_id'                    =>  $request->org_id,
                'dzo_id'                    =>  $request->dzo_id,
                'app_no'                    =>  $appNo,
                'remarks'                   =>  $request->remarks,
                'status'                    =>  'Nominated',
                'created_by'                =>  $request->user_id,
                'created_at'                =>  date('Y-m-d h:i:s')
            ];
            $response_data= ProgramApplication::create($request_data);
            $update_data =[
                'status'                    =>  'Completed',
                'updated_by'                =>  $request->user_id,
                'updated_at'                =>  date('Y-m-d h:i:s')
            ];
            HrDevelopment::where('id',$request->programId)->update($update_data);
        }
        else{
            $response_data="Already Submitted";
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function updateParticipant(Request $request){
        $response_data="";
        if(!$request->updatedata==null){
            foreach($request->updatedata as $participant){
                $update_data =[
                    'remarks'                  =>  $participant['remarks'],
                    'status'                   =>  $participant['status'],
                ];
                Participant::where('id', $participant['id'])->update($update_data);
            }
            $response_data="success";
            $update_data =[
                'remarks'                  =>  $participant['remarks'],
                'status'                   =>  $participant['status'],
            ];
            // ProgramApplication::where('id', $participant['id'])->update($update_data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function updateapplication(Request $request){
        $response_data="";
        $status="";
        if($request->status==2){
            $status="Shortlisted";
        }
        if($request->status==3){
            $status="Selected";
        }
        $update_data =[
            'remarks'                  =>  $request->remarks,
            'status'                   =>  $status,
            'updated_by'               =>  $request->user_id,
            'updated_at'               =>  date('Y-m-d h:i:s')
        ];
        $response_data=ProgramApplication::where('program_id', $request->programId)->update($update_data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function saveprogramOpenDetail(Request $request){
        $rules = [
            'staff'             =>  'required',
            'from_date'           =>  'required',
            'to_date'               =>  'required',
        ];
        $customMessages = [
            'staff.required'              => 'Please select staff',
            'from_date.required'          => 'Please select start date',
            'to_date.required'            => 'Please select end date',
        ];

        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'user_id'                   =>  $request->staff_user_id,
            'staff_id'                  =>  $request->staff,
            'start_date'                 =>  $request->from_date,
            'end_date'                   =>  $request->to_date,
            'remarks'                   =>  $request->remarks,
        ];
        if($request->action_type=="add"){
            $request_data=array_merge($request_data,
                array('created_by'            =>  $request->user_id,
                        'created_at'          =>  date('Y-m-d h:i:s')
                )
            );
            $response_data= OpenProgramme::create($request_data);
        }
        else{
            $request_data=array_merge($request_data,
                array('updated_by'            =>  $request->user_id,
                        'updated_at'          =>  date('Y-m-d h:i:s')
                )
            );
            $act_det = OpenProgramme::where ('id', $request->id)->first();
            // dd($request->id);
            $act_det->fill($request_data);
            $response_data=$act_det->save();
            $response_data= OpenProgramme::where('id',$request->id)->first();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function getprogramOpenDetail(){
        $response_details=OpenProgramme::get();
        if($response_details!=null && $response_details!="" && sizeof(($response_details))>0){
            foreach($response_details as $res){
                $res->StaffID=$res->staff_id;
            }
            $response_details=$this->getstaff_positiondirectory($response_details,'Array');
        }
        return $this->successResponse($response_details);
    }

    private function getstaff_positiondirectory($response_data,$type){
        if($type=="Single"){
            $person=PersonalDetails::where('zest_staff_id',$response_data->StaffID)->first();
            if($person!=null && $person!=""){
                $response_data->staff_name=$person->name;
                $response_data->emp_id=$person->emp_id;
                $response_data->working_agency_id=$person->working_agency_id;
            }
            $positions=ChildGroupPosition::where('id', $response_data->ChildGroupPositionID)->first();
            if($positions!=null && $positions!=""){
                $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                if($posi!=null && $posi!=""){
                    $response_data->position_title_name=$posi->name;
                    $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                    if($posiLev!=null && $posiLev!=""){
                        $response_data->positionlevel=$posiLev->name;
                    }
                }
            }
        }else{
            foreach($response_data as $res){
                $person=PersonalDetails::where('id',$res->StaffID)->first();
                if($person!=null && $person!=""){
                    $res->staff_name=$person->name;
                    $res->emp_id=$person->emp_id;
                    $res->working_agency_id=$person->working_agency_id;
                    $res->position_title_name='';
                    $res->positionlevel='';
                    $positions=ChildGroupPosition::where('id', $person->position_title_id)->first();
                    if($positions!=null && $positions!=""){
                        $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                        if($posi!=null && $posi!=""){
                            $res->position_title_name=$posi->name;
                            $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                            if($posiLev!=null && $posiLev!=""){
                                $res->positionlevel=$posiLev->name;
                            }
                        }
                    }
                }
            }
        }
        return $response_data;
    }

    public function checkProgramAccess($user_id=""){
        $response_details=OpenProgramme::where('user_id',$user_id)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();
        if($response_details!=null && $response_details!="" && sizeof(($response_details))>0){
            $response_details=true;
        }else{
            $response_details=false;
        }
        return $this->successResponse($response_details);
    }

    public function updateExcelfile($param="",$user_id=""){
        if($param=="Save"){
            $parsonal=ParticipantsEID::where('created_by',$user_id)->get();
            if($parsonal!=null && $parsonal!="" && sizeof($parsonal)>0){
                foreach($parsonal as $per){
                    if($per->participant_id!=null && $per->participant_id!=""){
                        $request_data =[
                            'program_id'                =>  $per->program_id,
                            'org_id'                    =>  $per->org_id,
                            'dzo_id'                    =>  $per->dzo_id,
                            'participant_id'            =>  $per->participant_id,
                            'contact'                   =>  $per->contact,
                            'email'                     =>  $per->email,
                            'nature_of_participant'     =>  $per->nature_of_participant,
                            'created_by'                =>  $per->user_id,
                            'created_at'                =>  date('Y-m-d h:i:s')
                        ];
                        $response_data= Participant::create($request_data);
                    }
                }
            }
        }
        $parsonal=ParticipantsEID::where('created_by',$user_id)->delete();
        return $this->successResponse($response_data);
    }
}
