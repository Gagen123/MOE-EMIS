<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class HrDevelopmentController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function getRoles($param=""){
        $system = $this->apiService->listData('system/get_roles/'.$param);
        return $system;
    }
    
    public function saveprogramDetails(Request $request){
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

        $files = $request->attachments;
        // dd($files);
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'HrDevelopment';
        if($files!=null && $files!=""){
            if(sizeof($files)>0 && !is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            if(sizeof($files)>0){
                foreach($files as $index => $file){
                    $file_name = time().'_' .$file->getClientOriginalName();
                    move_uploaded_file($file,$file_store_path.'/'.$file_name);
                    array_push($attachment_details,
                        array(
                            'path'        =>  $file_store_path,
                            'original_name'           =>  $file_name,
                            'user_defined_name'       =>  $filenames[$index],
                        )
                    );
                }
            }
        }
        
        $request_data =[
            'id'                                =>  $request->id,
            'training_type'                     =>  $request->training_type,
            'files'                             =>  $request->files,
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
            'attachment_details'                =>  $attachment_details,
            'status'                            =>  $request->status,
            'user_id'                           =>  $this->userId() 
        ];
        // dd($request_data);
        $response_data= $this->apiService->createData('emis/staff/saveprogramDetails', $request_data);
        return $response_data;
    }
    
    public function loadDraftDetails(){
        $response_data= $this->apiService->listData('emis/staff/loadDraftDetails/'.$this->userId());
        return $response_data;
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
        $request_data =[
            'id'                               =>  $request->id,
            'nomination_start_date'            =>  $request->nomination_start_date,
            'nomination_end_date'              =>  $request->nomination_end_date,
            'nature_of_participant'            =>  $request->nature_of_participant,
            'target_group'                     =>  $request->target_group,
            'org_level'                        =>  $request->org_level,
            'role_action_mapp'                 =>  $request->role_action_mapp,
            'remarks'                          =>  $request->remarks,
            'user_id'                           =>  $this->userId() 
            
        ];
        // dd($request_data);
        $response_data= $this->apiService->createData('emis/staff/saveprogramFinalDetails', $request_data);
        return $response_data;
    }
}
