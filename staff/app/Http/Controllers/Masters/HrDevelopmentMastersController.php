<?php

namespace App\Http\Controllers\masters;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\hr_development_masters\TrainingType;
use App\Models\hr_development_masters\RelatedProgramme;
use App\Models\hr_development_masters\ProgrammeLevel;
use App\Models\hr_development_masters\ProgrammeType;
use App\Models\hr_development_masters\CourseType;
use App\Models\hr_development_masters\FinancialSource;
use App\Models\hr_development_masters\Category;
use App\Models\hr_development_masters\Donor;
use App\Models\hr_development_masters\ProjectDonor;
use App\Models\hr_development_masters\Degree;

class HrDevelopmentMastersController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public $audit_database="system_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveHrDevelopmentMasters(Request $request){
        $table_name="";
        $response_data="";
        if($request['record_type']=="training_type"){
            $table_name="master_training_type";
        }
        if($request['record_type']=="related_programme"){
            $table_name="master_related_programme";
        }
        if($request['record_type']=="programme_level"){
            $table_name="master_programme_level";
        }
        if($request['record_type']=="programme_type"){
            $table_name="master_programme_type";
        }
        if($request['record_type']=="course_type"){
            $table_name="master_course_type";
        }
        if($request['record_type']=="financial_source"){
            $table_name="master_financial_source";
        }
        if($request['record_type']=="category"){
            $table_name="master_category";
        }
        if($request['record_type']=="donor_agency"){
            $table_name="master_donor";
        }
        if($request['record_type']=="degree"){
            $table_name="master_degree";
        }
        if($request['record_type']=="project_donor_agency"){
            $table_name="master_donor_project";
        }
        $rules = [
            'name'      =>  'required:',
            'status'    =>  'required',
        ];
        $customMessages = [
            'name.required'     => 'This field is required',
            'status.required'   => 'This field is required',
        ];
        if($request->actiontype=="add"){
            $rules=array_merge($rules,
                array('code'    =>  'required|numeric|digits:4|unique:'.$table_name,)
            );
            $customMessages=array_merge($customMessages,
                array('code.required'   => 'This field is required',
                    'code.unique'       => 'This code is already taken.',
                    'code.numeric'      => 'The field must be numeric.',
                    'code.digits'       => 'The field should be of 4 digits.',)
            );
            if($request['record_type']=="project_donor_agency"){
                $rules=array_merge($rules,
                    array('parent_field'  =>  'required',)
                );
                $customMessages=array_merge($customMessages,
                    array('parent_field.required'  =>  'This field is required',)
                );
            }
        }
        $this->validate($request, $rules,$customMessages);
        $data = [
            'name'          =>  $request['name'],
            'status'        =>  $request['status'],
            'created_by'    =>  $request['user_id'],
            'created_at'    =>  date('Y-m-d h:i:s'),
        ];
        if($request['record_type']=="project_donor_agency"){
            $data=array_merge($data,
                array('donor_id'  =>  $request['parent_field'],)
            );
        }
        if($request->actiontype=="add"){
            $data=array_merge($data,
                array('code'    =>  $request['code'],)
            );
            if($request['record_type']=="training_type"){
                $response_data = TrainingType::create($data); 
            }
            if($request['record_type']=="related_programme"){
                $response_data = RelatedProgramme::create($data); 
            }
            if($request['record_type']=="programme_level"){
                $response_data = ProgrammeLevel::create($data); 
            }
            if($request['record_type']=="programme_type"){
                $response_data = ProgrammeType::create($data); 
            }
            if($request['record_type']=="course_type"){
                $response_data = CourseType::create($data); 
            }
            if($request['record_type']=="financial_source"){
                $response_data = FinancialSource::create($data); 
            }
            if($request['record_type']=="category"){
                $response_data = Category::create($data); 
            }
            if($request['record_type']=="donor_agency"){
                $response_data = Donor::create($data);
            }
            if($request['record_type']=="degree"){
                $response_data = Degree::create($data);
            }
            if($request['record_type']=="project_donor_agency"){
                $response_data = ProjectDonor::create($data);
            }
        }
        
        if($request->actiontype=="edit"){
            if($request['record_type']=="training_type"){
                $update_data = TrainingType::find($request->id);
            }
            if($request['record_type']=="related_programme"){
                $update_data = RelatedProgramme::find($request->id); 
            }
            if($request['record_type']=="programme_level"){
                $update_data = ProgrammeLevel::find($request->id);
            }
            if($request['record_type']=="programme_type"){
                $update_data = ProgrammeType::find($request->id); 
            }
            if($request['record_type']=="course_type"){
                $update_data = CourseType::find($request->id); 
            }
            if($request['record_type']=="financial_source"){
                $update_data = FinancialSource::find($request->id);  
            }
            if($request['record_type']=="category"){
                $update_data = Category::find($request->id);  
            }
            if($request['record_type']=="donor_agency"){
                $update_data = Donor::find($request->id);  
            }
            if($request['record_type']=="degree"){
                $update_data = Degree::find($request->id);  
            }
            if($request['record_type']=="project_donor_agency"){
                $update_data = ProjectDonor::find($request->id); 
            }
            $messs_det='name:'.$update_data->name.'; Status:'.$update_data->status.'; updated_by:'.$update_data->updated_by.'; updated_date:'.$update_data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','".$table_name."','".$request->id."','".$messs_det."','".$request->user_id."','Edit')");

            $update_data->name          = $request->name;
            $update_data->status        = $request->status;
            $update_data->updated_by    = $request->user_id;
            $update_data->updated_at    = date('Y-m-d h:i:s');
            $update_data->update();
            $response_data = $update_data;
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    public function loadHrDevelopmentMastersData($type=""){
        if($type=="all_training_type_list"){
            return $this->successResponse(TrainingType::all());
        }
        if($type=="active_training_type_list"){
            return $this->successResponse(TrainingType::where ('status', '1')->get());
        }

        if($type=="all_related_programme_list"){
            return $this->successResponse(RelatedProgramme::all());
        }
        if($type=="active_related_programme_list"){
            return $this->successResponse(RelatedProgramme::where ('status', '1')->get());
        }
        
        if($type=="all_programme_level_list"){
            return $this->successResponse(ProgrammeLevel::all());
        }
        if($type=="active_programme_level_list"){
            return $this->successResponse(ProgrammeLevel::where ('status', '1')->get());
        }
        
        if($type=="all_programme_type_list"){
            return $this->successResponse(ProgrammeType::all());
        }
        if($type=="active_programme_type_list"){
            return $this->successResponse(ProgrammeType::where ('status', '1')->get());
        }
        
        if($type=="all_course_type_list"){
            return $this->successResponse(CourseType::all());
        }
        if($type=="active_course_type_list"){
            return $this->successResponse(CourseType::where ('status', '1')->get());
        }
        
        if($type=="all_financial_source_list"){
            return $this->successResponse(FinancialSource::all());
        }
        if($type=="active_financial_source_list"){
            return $this->successResponse(FinancialSource::where ('status', '1')->get());
        }

        if($type=="all_category_list"){
            return $this->successResponse(Category::all());
        }
        if($type=="active_category_list"){
            return $this->successResponse(Category::where ('status', '1')->get());
        }

        if($type=="all_donor_list"){
            return $this->successResponse(Donor::all());
        }
        if($type=="active_donor_list"){
            return $this->successResponse(Donor::where ('status', '1')->get());
        }
        
        if($type=="all_project_donor_list"){
            return $this->successResponse(ProjectDonor::with('donor')->get());
        }
        if($type=="active_project_donor_list"){
            return $this->successResponse(ProjectDonor::where ('status', '1')->get());
        }
        
        if($type=="all_degree_list"){
            return $this->successResponse(Degree::all());
        }
        if($type=="active_degree_list"){
            return $this->successResponse(Degree::where ('status', '1')->get());
        }
        
    }
    public function loadHrDevelopmentDepedentMastersData($model="",$parent_id=""){
        if($model=="projectdonor"){
            return $this->successResponse(ProjectDonor::where('donor_id',$parent_id)->where ('status', '1')->get());
        }
    }
    
}
