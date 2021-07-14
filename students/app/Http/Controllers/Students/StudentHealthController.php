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
use App\Models\Students\StudentSupplementation;
use App\Models\Students\StudentVaccination;
use App\Models\Students\StudentDeworming;
use App\Models\Students\StudentScreening;
use App\Models\Students\StudentBmi;
use App\Models\Students\CeaRoleStaff;
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
            'id'                    => $request->id,
            'StdHealthTermId'       => $request->term_id,
            'date'                  => $request->date,
            'class'                 => $request->std_class,
            'section'               => $request->std_section,
            'stream'                => $request->std_stream,
            'std_id'                => $request->std_id,
            'std_screened'          => $request->std_screened
        ];

        $std_ids = $data['std_id'];
        $std_screened = $data['std_screened'];
        
        unset($data['std_id']);
        unset($data['std_screened']);

        $response_data = StudentHealthDeworming::create($data);
        $lastInsertId = $response_data->id;

        //insert students that are not given
        foreach($std_screened as $key => $value){
            $data = [
                'StdHealthDewormingId'  => $lastInsertId,
                'StdStudentId'          => $value,
                'status'                => 'Not Given'
            ];
            StudentDeworming::create($data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    /**
     * method to list students deworming records
    */

    public function loadDewormingRecords($param=""){

        $id =$param;

        $records = DB::table('std_health_deworming')
                    ->select('std_health_deworming.id', 'std_health_deworming.StdHealthTermId','std_health_deworming.date', 
                                'std_student_class_stream.OrgClassStreamId', 'std_student_class_stream.SectionDetailsId', 'std_health_term.name AS term')
                    ->join('std_health_term', 'std_health_deworming.StdHealthTermId', '=', 'std_health_term.id')
                    ->leftjoin('std_student_deworming', 'std_health_deworming.id', '=', 'std_student_deworming.StdHealthDewormingId')
                    ->leftjoin('std_student_class_stream', 'std_student_class_stream.SectionDetailsId', '=', 'std_health_deworming.section')
                    ->groupBy('std_student_class_stream.SectionDetailsId', 'std_health_deworming.date', 'std_student_class_stream.SectionDetailsId')
                    ->get();

        for($i=0; $i<sizeof($records); $i++){
            $not_given = DB::table("std_student_deworming")
                        ->select( DB::raw("COUNT(CASE WHEN std_student_deworming.status = 'Not Given' THEN 1 END) as not_given"))
                        ->where('StdHealthDewormingId', $records[$i]->id)
                        ->get();
            
            
            $total_student = DB::table("std_student_class_stream")
                            ->select( DB::raw("COUNT(std_student_class_stream.SectionDetailsId) as total_student"))
                            ->where('SectionDetailsId', $records[$i]->SectionDetailsId)
                            ->get();
            
            $records[$i]->not_given = $not_given[0]->not_given;
            $records[$i]->total_student = $total_student[0]->total_student;
        }
        
        return $this->successResponse($records);

    }


    /** 
     * method to save or update student Supplementation
    */

    public function addSupplementationRecords(Request $request){
        
        $rules = [
            'term_id'                       => 'required',
            'date'                          => 'required',
            'supplementation'               => 'required',
            'supplementation_position'      => 'required',
            'supplementation_endorsed_by'   => 'required'
        ];

        $customMessages = [
            'term_id.required'                      => 'This field is required',
            'date.required'                         => 'This field is required',
            'supplementation.required'              => 'This field is required',
            'supplementation_position.required'     => 'This field is required',
            'supplementation_endorsed_by.required'  => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                                => $request->id,
            'OrgOrganizationId'                 => $request->organization_id,
            'StdHealthTermId'                   => $request->term_id,
            'StdHealthSupplementationTypeId'    => $request->supplementation,
            'StdScreeningPositionTitleId'       => $request->supplementation_position,
            'StdScreeningEndorsedById'          => $request->supplementation_endorsed_by,
            'date'                              => $request->date,
            'class'                             => $request->std_class,
            'stream'                            => $request->std_stream,
            'section'                           => $request->std_section,
            'std_id'                            => $request->std_id,
            'std_screened'                      => $request->std_screened,
        ];

        $std_ids = $data['std_id'];
        $std_screened = $data['std_screened'];
        
        unset($data['std_id']);
        unset($data['std_screened']);

        $response_data = StudentHealthSupplementation::create($data);
        $lastInsertId = $response_data->id;

        //insert students that are not given
        foreach($std_screened as $key => $value){
            $data = [
                'StdHealthSupplementationId'    => $lastInsertId,
                'StdStudentId'                  => $value,
                'status'                        => 'Not Given'
            ];
            StudentSupplementation::create($data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    /**
     * method to list students Supplementation records
    */

    public function loadSupplementationRecords($param=""){

        $id =$param;

        $records = DB::table('std_health_supplementation')
                    ->select('std_health_supplementation.id', 'std_health_supplementation.StdHealthTermId','std_health_supplementation.date', 
                                'std_student_class_stream.OrgClassStreamId', 'std_student_class_stream.SectionDetailsId', 'std_health_term.name AS term',
                                'std_health_supplementation_type.Name as supplementation_type')
                    ->join('std_health_term', 'std_health_supplementation.StdHealthTermId', '=', 'std_health_term.id')
                    ->leftjoin('std_student_health_supplementation', 'std_health_supplementation.id', '=', 'std_student_health_supplementation.StdHealthSupplementationId')
                    ->leftjoin('std_student_class_stream', 'std_student_class_stream.SectionDetailsId', '=', 'std_health_supplementation.section')
                    ->join('std_health_supplementation_type', 'std_health_supplementation_type.id', '=', 'std_health_supplementation.StdHealthSupplementationTypeId')
                    ->groupBy('std_student_class_stream.SectionDetailsId', 'std_health_supplementation.date', 'std_student_class_stream.SectionDetailsId')
                    ->get();

        for($i=0; $i<sizeof($records); $i++){
            $not_given = DB::table("std_student_health_supplementation")
                        ->select( DB::raw("COUNT(CASE WHEN std_student_health_supplementation.status = 'Not Given' THEN 1 END) as not_given"))
                        ->where('StdHealthSupplementationId', $records[$i]->id)
                        ->get();
            
            
            $total_student = DB::table("std_student_class_stream")
                            ->select( DB::raw("COUNT(std_student_class_stream.SectionDetailsId) as total_student"))
                            ->where('SectionDetailsId', $records[$i]->SectionDetailsId)
                            ->get();
            
            $records[$i]->not_given = $not_given[0]->not_given;
            $records[$i]->total_student = $total_student[0]->total_student;
        }
        
        return $this->successResponse($records);

    }

    /** 
     * method to save or update student health screening records
     * 
     * The record of those that are "NOT SCREENED" and "REFERRED" are stored
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
        ];

        $std_ids = $data['std_id'];
        $std_screened = $data['std_screened'];
        $std_referred = $data['std_referred'];
        
        unset($data['std_id']);
        unset($data['std_screened']);
        unset($data['std_referred']);
			

        $response_data = StudentHealthScreening::create($data);
        $lastInsertId = $response_data->id;

        //insert students that are not screened
        foreach($std_screened as $key => $value){
            $screened_data = [
                'StdHealthScreeningId'  => $lastInsertId,
                'StdStudentId'          => $value,
                'screening_status'      => 'Not Screened'
            ];
            StudentScreening::create($screened_data);
        }

        //insert referred students
        foreach($std_referred as $key => $value){
            $screened_data = [
                'StdHealthScreeningId'  => $lastInsertId,
                'StdStudentId'          => $value,
                'screening_status'      => 'Screened',
                'referral_status'      => 'Referred'
            ];
            StudentScreening::create($screened_data);
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

        $records = DB::table('std_health_screening_type')
                            ->select('std_health_screening.id', 'std_health_screening.date', 'std_health_screening.class', 
                                        'std_health_screening.section', 'std_health_screening.stream', 'std_health_screening_type.name AS screening_type')
                            ->join('std_health_screening', 'std_health_screening.StdHealthScreeningTypeId', '=', 'std_health_screening_type.id')
                            ->leftjoin('std_student_health_screening', 'std_health_screening.id', '=', 'std_student_health_screening.StdHealthScreeningId')
                            ->leftjoin('std_student_class_stream', 'std_student_class_stream.SectionDetailsId', '=', 'std_health_screening.section')
                            ->groupBy('std_health_screening.class', 'std_health_screening.StdHealthScreeningTypeId', 'std_health_screening.date',
                                            'std_student_class_stream.SectionDetailsId')
                            ->get();
        
        for($i=0; $i<sizeof($records); $i++){
            $screened = DB::table("std_student_health_screening")
                        ->select( DB::raw("COUNT(CASE WHEN std_student_health_screening.screening_status = 'Not Screened' THEN 1 END) as not_screened"))
                        ->where('StdHealthScreeningId', $records[$i]->id)
                        ->get();

            $referred = DB::table("std_student_health_screening")
                            ->select( DB::raw("COUNT(CASE WHEN std_student_health_screening.referral_status = 'Referred' THEN 1 END) as referred"))
                            ->where('StdHealthScreeningId', $records[$i]->id)
                            ->get();
            
            
            $total_student = DB::table("std_student_class_stream")
                            ->select( DB::raw("COUNT(std_student_class_stream.SectionDetailsId) as total_student"))
                            ->where('SectionDetailsId', $records[$i]->section)
                            ->get();
            
            $records[$i]->not_screened = $screened[0]->not_screened;
            $records[$i]->referred = $referred[0]->referred;
            $records[$i]->total_student = $total_student[0]->total_student;
        }
        
        
        
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

        $org_id = $param;

        $records = DB::table('std_health_bmi')
                ->join('std_health_term', 'std_health_bmi.StdHealthTermId', '=', 'std_health_term.id')
                ->join('std_student', 'std_health_bmi.StdStudentId', '=', 'std_student.id')
                ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
                ->select('std_health_bmi.*', 'std_health_term.name AS term', 'std_student_class_stream.OrgClassStreamId AS class', 'std_student_class_stream.SectionDetailsId AS section')
                ->groupBy('std_health_bmi.StdHealthTermId', 'std_student_class_stream.SectionDetailsId')
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

    /**
     * Load the health details of the view
     * The param takes 4 parameters - class, section, stream and health id separated by __ (double underscore)
     */

    public function loadViewScreeningDetails($param=''){
        $param_details = explode('__', $param);
        
        $records = DB::table('std_health_screening')
                    ->select('std_health_screening.*', 'std_student_health_screening.screening_status as screened',
                                'std_student_health_screening.referral_status as referred','std_student.id AS StdStudentId', 
                                'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->leftjoin('std_student_class_stream', 'std_health_screening.section', '=', 'std_student_class_stream.SectionDetailsId')
                    ->leftjoin('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->leftjoin('std_student_health_screening', 'std_student_health_screening.StdStudentId', '=', 'std_student.id')
                    ->where('std_health_screening.id', $param_details[3])
                    ->where('std_health_screening.section', $param_details[1])
                    ->get();

        return $this->successResponse($records); 
    }

    /**
     * Load the health screening details of an individual student
     * The is health screening id and student id separated by __ (double underscore)
     */

    public function getScreeningDetails($id=''){
        $param_details = explode('__', $id);
        
        $records = DB::table('std_health_screening')
                    ->select('std_health_screening.*', 'std_student_health_screening.screening_status as screened',
                            'std_student_health_screening.referral_status as referred','std_student.id AS StdStudentId',
                            'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->leftjoin('std_student_class_stream', 'std_health_screening.section', '=', 'std_student_class_stream.SectionDetailsId')
                    ->leftjoin('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->leftjoin('std_student_health_screening', 'std_student_health_screening.StdStudentId', '=', 'std_student.id')
                    ->where('std_health_screening.id', $param_details[0])
                    ->where('std_student.id', $param_details[1])
                    ->first();

        return $this->successResponse($records); 
    }

    /**
     * Load the deworming details of the view
     * The param takes 4 parameters - class, section, stream and health id separated by __ (double underscore)
     */

    public function loadViewDewormingDetails($param=''){
        $param_details = explode('__', $param);
        
        $records = DB::table('std_health_deworming')
                    ->select('std_health_deworming.*', 'std_student.id AS StdStudentId', 'std_student.Name', 'std_student.student_code', 
                                'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->leftjoin('std_student_class_stream', 'std_health_deworming.section', '=', 'std_student_class_stream.SectionDetailsId')
                    ->leftjoin('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->leftjoin('std_student_deworming', 'std_student_deworming.StdStudentId', '=', 'std_student.id')
                    ->where('std_health_deworming.section', $param_details[1])
                    ->where('std_health_deworming.id', $param_details[3])
                    ->get();

        return $this->successResponse($records); 
    }


    /**
     * Load the deworming details of an individual student
     * The is deworming id and student id separated by __ (double underscore)
     */

    public function getDewormingDetails($id=''){
        $param_details = explode('__', $id);
        
        $records = DB::table('std_health_deworming')
                    ->select('std_health_deworming.*', 'std_health_not_screened.StdStudentId as screened','std_health_referred.StdStudentId as referred',
                        'std_student.id AS StdStudentId', 'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->leftjoin('std_student_class_stream', 'std_health_deworming.section', '=', 'std_student_class_stream.SectionDetailsId')
                    ->leftjoin('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->where('std_health_deworming.id', $param_details[0])
                    ->where('std_student.id', $param_details[1])
                    ->get();

        return $this->successResponse($records); 
    }

    /**
     * Load the supplementation details of the view
     * The param takes 4 parameters - class, section, stream and health id separated by __ (double underscore)
     */

    public function loadViewSupplementationDetails($param=''){
        $param_details = explode('__', $param);
        
        $records = DB::table('std_health_supplementation')
                    ->select('std_health_supplementation.*', 'std_student.id AS StdStudentId', 'std_student.Name', 'std_student.student_code', 
                                'std_student.DateOfBirth', 'std_student.CmnSexId', 'std_health_supplementation_type.Name as supplementation_type')
                    ->leftjoin('std_student_class_stream', 'std_health_supplementation.section', '=', 'std_student_class_stream.SectionDetailsId')
                    ->leftjoin('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->leftjoin('std_student_health_supplementation', 'std_student_health_supplementation.StdStudentId', '=', 'std_student.id')
                    ->join('std_health_supplementation_type', 'std_health_supplementation_type.id', '=', 'std_health_supplementation.StdHealthSupplementationTypeId')
                    ->where('std_health_supplementation.section', $param_details[1])
                    ->where('std_health_supplementation.id', $param_details[3])
                    ->get();

        return $this->successResponse($records); 
    }


    /*
    * Vaccination Records for students
    */

    public function addVaccinationRecords(Request $request){
        
        $data =[
            'StdVaccineTypeId'      => $request->vaccination,
            'dose'                  => $request->dose,
            'date'                  => $request->date,
            'class'                 => $request->std_class,
            'stream'                => $request->std_stream,
            'section'               => $request->std_section,
            'std_id'                => $request->std_id,
            'std_vaccinated'        => $request->std_vaccinated,
            'organization_id'       => $request->organization_id,
            'user_id'               => $request->user_id 
        ];

        $std_ids = $data['std_id'];
        $std_vaccinated = $data['std_vaccinated'];
        $dose = $data['dose'];
        
        unset($data['std_id']);
        unset($data['dose']);
        unset($data['std_vaccinated']);

        $response_data = StudentHealthVaccination::create($data);
        $lastInsertId = $response_data->id;

        //insert students that are not given
        foreach($std_vaccinated as $key => $value){
            $data = [
                'StdHealthVaccinationId'    => $lastInsertId,
                'StdStudentId'              => $value,
                'dose'                      => $dose,
                'status'                    => 'vaccinated'
            ];
            StudentVaccination::create($data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    public function loadVaccinationRecords($param=""){
        //
    }

    public function updateVaccinationRecords($param=""){
        //
    }
}
