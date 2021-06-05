<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\StudentHealthScreening;
use App\Models\Students\StudentHealthDeworming;
use App\Models\Students\StudentHealthSupplementation;
use App\Models\Students\StudentHealthVaccination;
use App\Models\Students\StudentReferred;
use App\Models\Students\StudentScreened;
use App\Models\Students\StudentBmi;
use App\Models\Students\Student;

class StudentHealthController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update student deworming
    */

    public function addDewormingRecords(Request $request){
        
        $rules = [
            'term_id'            => 'required',
            'date'               => 'required',
            'std_class'             => 'required',
            'std_section'           => 'required',
        ];

        $customMessages = [
            'term_id.required'  => 'This field is required',
            'date.required'     => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'StdHealthTermId'          => $request->term_id,
            'date'             => $request->date,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_screened'          => $request->std_screened,

            //'user_id'        => $this->user_id() 
        ];

        $std_ids = $data['std_id'];
        $std_screened = $data['std_screened'];
        
        unset($data['std_id']);
        unset($data['std_screened']);
        unset($data['std_class']);
        unset($data['std_stream']);
        unset($data['std_section']);

        foreach($std_ids as $index => $student_id){
            if($student_id != 'on'){
                $screened_data = [
                    'StdStudentId'=> $student_id,
                    'status' => 'not given'
                ];
                $data = $data + $screened_data;
                    
                $response_data = StudentHealthDeworming::create($data);
            }
        }
        
        

        // foreach($request->input('dewormingByClass') as $key=> $value){
        //     if(array_key_exists('class', $data)){
        //         unset($data['class']);
        //         unset($data['boys_given']);
        //         unset($data['girls_given']);
        //         $details = array();
        //     }
        //     $details = array(
        //         'class'         =>$value['std_class'],
        //         'boys_given'    =>$value['boys_given'],
        //         'girls_given'   =>$value['girls_given'],
        //     );
        //     $data = $data + $details;
        //     $response_data = StudentHealthDeworming::create($data);
        // }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    /**
     * method to list students deworming records
    */

    public function loadDewormingRecords($param=""){

        $id =$param;

        $records = DB::table('std_health_deworming')
                    ->select('std_health_deworming.id', 'std_health_deworming.date', 'std_health_deworming.class', 
                                'std_health_deworming.section', 'std_health_deworming.stream',
                                DB::raw('COUNT(std_health_not_screened.StdStudentId) as not_screened'), 
                                DB::raw('COUNT(std_health_referred.StdStudentId) as referred'))
                    ->join('std_health_screening', 'std_health_screening.StdHealthScreeningTypeId', '=', 'std_health_screening_type.id')
                    ->leftjoin('std_health_not_screened', 'std_health_screening.id', '=', 'std_health_not_screened.StdHealthScreeningId')
                    ->leftjoin('std_health_referred', 'std_health_screening.id', '=', 'std_health_referred.StdHealthScreeningId')
                    ->groupBy('std_health_screening.class', 'std_health_screening.StdHealthScreeningTypeId', 'std_health_screening.date')
                    ->get();

        // $records = DB::table('std_health_deworming')
        //             ->join('std_health_term', 'std_health_deworming.StdHealthTermId', '=', 'std_health_term.id')
        //             ->select('std_health_deworming.*', 'std_health_term.name AS term')
        //             ->groupBy('std_health_deworming.StdHealthTermId', 'std_health_deworming.date')
        //             ->get();
        
        return $this->successResponse($records);

    }


    /** 
     * method to save or update student Supplementation
    */

    public function addSupplementationRecords(Request $request){
        
        $rules = [
            'term_id'            => 'required',
            'date'               => 'required',
            'std_class'             => 'required',
            'std_section'           => 'required',
        ];

        $customMessages = [
            'term_id.required'  => 'This field is required',
            'date.required'     => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'StdHealthTermId'          => $request->term_id,
            'date'             => $request->date,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_screened'          => $request->std_screened,

            //'user_id'        => $this->user_id() 
        ];

        $std_ids = $data['std_id'];
        $std_screened = $data['std_screened'];
        
        unset($data['std_id']);
        unset($data['std_screened']);
        unset($data['std_class']);
        unset($data['std_stream']);
        unset($data['std_section']);

        foreach($std_ids as $index => $student_id){
            if($student_id != 'on'){
                $screened_data = [
                    'StdStudentId'=> $student_id,
                    'status' => 'not given'
                ];
                $data = $data + $screened_data;
                    
                $response_data = StudentHealthSupplementation::create($data);
            }
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    /**
     * method to list students Supplementation records
    */

    public function loadSupplementationRecords($param=""){

        $id ="2fea1ad2-824b-434a-a608-614a482e66c1";

        $records = DB::table('std_health_supplementation')
                    ->join('std_health_term', 'std_health_supplementation.StdHealthTermId', '=', 'std_health_term.id')
                    ->select('std_health_supplementation.*', 'std_health_term.name AS term')
                    ->groupBy('std_health_supplementation.StdHealthTermId', 'std_health_supplementation.date')
                    ->get();
        
        return $this->successResponse($records);

    }

    /** 
     * method to save or update student health screening records
    */

    public function addHealthScreeningRecords(Request $request){
        $rules = [
            'screening'             => 'required',
            'date'                  => 'required',
            'screening_endorsed_by' => 'required',
            'prepared_by'           => 'required',
            'screening_position'    => 'required',
            'std_class'             => 'required',
            'std_section'           => 'required',
        ];

        $customMessages = [
            'screening.required'                => 'This field is required',
            'date.required'                     => 'This field is required',
            'screening_endorsed_by.required'    => 'This field is required',
            'prepared_by.required'              => 'This field is required',
            'screening_position.required'       => 'This field is required',
            'std_class.required'                => 'This field is required',
            'std_section.required'              => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                                    => $request->id,
            'OrgOrganizationId'                     => $request->organization_id,
            'StdHealthScreeningTypeId'              => $request->screening,
            'prepared_by'                           => $request->prepared_by,
            'StdScreeningPositionTitleId'           => $request->screening_position,
            'date'                                  => $request->date,
            'StdScreeningEndorsedById'              => $request->screening_endorsed_by,
            'class'                                 => $request->std_class,
            'stream'                                => $request->std_stream,
            'section'                               => $request->std_section,
            'std_id'                                => $request->std_id,
            'std_screened'                          => $request->std_screened,
            'std_referred'                          => $request->std_referred,

            //'user_id'        => $this->user_id()
        ];

        $std_ids = $data['std_id'];
        $std_screened = $data['std_screened'];
        $std_referred = $data['std_referred'];
        
        unset($data['std_id']);
        unset($data['std_screened']);
        unset($data['std_referred']);
			

        $response_data = StudentHealthScreening::create($data);
        $lastInsertId = $response_data->id;

        foreach($std_ids as $index => $stdStudentId){
            if(!array_key_exists($index, $std_screened)){
                $screened_data = [
                    'StdHealthScreeningId' => $lastInsertId,
                    'StdStudentId'=> $stdStudentId,
                ];
                
                StudentScreened::create($screened_data);
            }
            if(array_key_exists($index, $std_referred)){
                $screened_data = [
                    'StdHealthScreeningId' => $lastInsertId,
                    'StdStudentId'=> $stdStudentId,
                ];
                
                StudentReferred::create($screened_data);
            }
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    /**
     * method to list students health screening records
    */

    public function loadHealthScreeningRecords($param=""){

        $id = $param;

        $records = DB::table('std_health_screening')
                    ->join('std_health_screening_type', 'std_health_screening.StdHealthScreeningTypeId', '=', 'std_health_screening_type.id')
                    ->select('std_health_screening.*', 'std_health_screening_type.name AS screening_type')
                    ->groupBy('std_health_screening.StdHealthScreeningTypeId', 'std_health_screening.date')
                    ->get();
        
        return $this->successResponse($records);

    }

    public function listScreeningSummary($param=""){

        $id =$param;

        // $records=StudentHealthScreening::where('OrgOrganizationId',$id)->first();
        // $records->screening_type = DB::table('std_health_screening_type')->where('id', $records->StdHealthScreeningTypeId)->select('name')->first();
        // $records->not_screened = DB::table('std_health_not_screened')->where('StdHealthScreeningId', $records->id)->count();
        // return $this->successResponse($records); 

        $records = DB::table('std_health_screening_type')
                    ->select('std_health_screening.id', 'std_health_screening.date', 'std_health_screening.class', 
                                'std_health_screening.section', 'std_health_screening.stream', 'std_health_screening_type.name AS screening_type',
                                DB::raw('COUNT(std_health_not_screened.StdStudentId) as not_screened'), 
                                DB::raw('COUNT(std_health_referred.StdStudentId) as referred'))
                    ->join('std_health_screening', 'std_health_screening.StdHealthScreeningTypeId', '=', 'std_health_screening_type.id')
                    ->leftjoin('std_health_not_screened', 'std_health_screening.id', '=', 'std_health_not_screened.StdHealthScreeningId')
                    ->leftjoin('std_health_referred', 'std_health_screening.id', '=', 'std_health_referred.StdHealthScreeningId')
                    ->groupBy('std_health_screening.class', 'std_health_screening.StdHealthScreeningTypeId', 'std_health_screening.date')
                    ->get();
        
        return $this->successResponse($records);

    }

    public function getHealthScreeningSummary($param=""){
        $id = $param;

        $response_data=StudentHealthScreening::where('id',$id)->first();
        $response_data->roles=CeaRoleStaff::where('CeaSchoolProgrammeId',$id)->get();
        return $this->successResponse($response_data); 
    }

    public function getHealthScreeningDetails($param=""){
        $id = $param;

        $records = DB::table('std_health_screening_type')
                    ->select('std_health_screening.id', 'std_health_screening.date', 'std_health_screening.class', 
                                'std_health_screening.section', 'std_health_screening.stream', 'std_health_screening_type.name AS screening_type',
                                'std_screening_endorsed_by.Name AS endorsed_by', 'std_screening_position_title.Name AS position')
                    ->join('std_health_screening', 'std_health_screening.StdHealthScreeningTypeId', '=', 'std_health_screening_type.id')
                    ->leftjoin('std_screening_position_title', 'std_health_screening.StdScreeningPositionTitleId', '=', 'std_screening_position_title.id')
                    ->leftjoin('std_screening_endorsed_by', 'std_health_screening.StdScreeningEndorsedById', '=', 'std_screening_endorsed_by.id')
                    ->where('std_health_screening.id', $id)
                    ->get();
        return $this->successResponse($records); 
    }

    public function getStudentScreenedDetails($param=""){
        $id = $param;

        $records = DB::table('std_health_not_screened')
                    ->select('StdStudentId')
                    ->where('StdHealthScreeningId', $id)
                    ->get();
        return $this->successResponse($records); 
    }

    public function getStudentReferredDetails($param=""){
        $id = $param;

        $records = DB::table('std_health_referred')
                    ->select('StdStudentId')
                    ->where('StdHealthScreeningId', $id)
                    ->get();
        return $this->successResponse($records); 
    }

    /*
    * BMI Records for students
    */

    public function addBmiRecords(Request $request){
        $rules = [
            'term_id'            => 'required',
            'date'               => 'required'
        ];

        $customMessages = [
            'term_id.required'  => 'This field is required',
            'date.required'     => 'This field is required',
        ];
        
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'term_id'          => $request->term_id,
            'date'             => $request->date,
            'std_id'                => $request->std_id,
            'height'                => $request->height,
            'weight'          => $request->weight,
            'remarks'        => $request->remarks

            //'user_id'        => $this->user_id() 
        ];
        
        $std_ids = $data['std_id'];
        $std_height = $data['height'];
        $std_weight = $data['weight'];
        $std_remarks = $data['remarks'];

        unset($data['std_id']);
        unset($data['height']);
        unset($data['weight']);
        unset($data['remarks']);

        foreach($std_ids as $index => $student_id){
            $screened_data = [
                'StdHealthTermId' => $data['term_id'],
                'StdStudentId'=> $student_id,
                'date' => $data['date'],
                'height' => $std_height[$index],
                'weight' => $std_weight[$index],
                'bmi' => 0,
                'remarks' => $std_remarks[$index]
            ];

            $response_data = StudentBmi::create($screened_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadBmiSummary($param=""){

        $id ="2fea1ad2-824b-434a-a608-614a482e66c1";

        $records = DB::table('std_health_bmi')
                ->join('std_health_term', 'std_health_bmi.StdHealthTermId', '=', 'std_health_term.id')
                ->join('std_student', 'std_health_bmi.StdStudentId', '=', 'std_student.id')
                ->join('std_student_school_detail', 'std_student.id', '=', 'std_student_school_detail.StdStudentId')
                ->select('std_health_bmi.*', 'std_health_term.name AS term', 'std_student_school_detail.OrgClassId AS class', 'std_student_school_detail.OrgClassSectionId AS section')
                ->groupBy('std_health_bmi.StdHealthTermId', 'std_student_school_detail.OrgClassId', 'std_student_school_detail.OrgClassSectionId')
                ->get();
        
        return $this->successResponse($records);

    }

    /**
     * Delete this function if not used
     * 
     * 
     * Function to insert data into the respective tables
     */

    private function updateData($dataRequest, $databaseModel){

        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();

        $data = $model::find($dataRequest['id']);

        //Audit Trails
        // $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
        // $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','master_working_agency','".$request['id']."','".$msg_det."','".$request->input('user_id')."','Edit')");
        
        //data to be updated
        $data->name = $dataRequest['name'];
        $data->description = $dataRequest['description'];
        $data->status = $dataRequest['status'];
        $data->updated_by = $dataRequest['created_by'];
        $data->updated_at = date('Y-m-d h:i:s');
        $data->update();
        
        return $data;

    }
}
