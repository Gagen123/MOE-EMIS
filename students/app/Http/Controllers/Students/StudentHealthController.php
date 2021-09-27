<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\StudentHealthScreening;
use App\Models\Students\StudentHealthSupplementation;
use App\Models\Students\StudentHealthVaccination;
use App\Models\Students\StudentSupplementation;
use App\Models\Students\StudentVaccination;
use App\Models\Students\StudentScreening;
use App\Models\Students\StudentBmi;
use App\Models\Students\CeaRoleStaff;
use App\Models\Students\Student;
use App\Models\Students\StudentBmiSummery;

class StudentHealthController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * Function kept for future reference
     *
     * Nice way to count records
     */

    // public function loadDewormingRecords($param=""){

    //     $id =$param;

    //     $records = DB::table('std_health_deworming')
    //                 ->select('std_health_deworming.id', 'std_health_deworming.StdHealthTermId','std_health_deworming.date',
    //                             'std_student_class_stream.OrgClassStreamId', 'std_student_class_stream.SectionDetailsId', 'std_health_term.name AS term')
    //                 ->join('std_health_term', 'std_health_deworming.StdHealthTermId', '=', 'std_health_term.id')
    //                 ->leftjoin('std_student_deworming', 'std_health_deworming.id', '=', 'std_student_deworming.StdHealthDewormingId')
    //                 ->leftjoin('std_student_class_stream', 'std_student_class_stream.SectionDetailsId', '=', 'std_health_deworming.section')
    //                 ->groupBy('std_student_class_stream.SectionDetailsId', 'std_health_deworming.date', 'std_student_class_stream.SectionDetailsId')
    //                 ->get();

    //     for($i=0; $i<sizeof($records); $i++){
    //         $not_given = DB::table("std_student_deworming")
    //                     ->select( DB::raw("COUNT(CASE WHEN std_student_deworming.status = 'Not Given' THEN 1 END) as not_given"))
    //                     ->where('StdHealthDewormingId', $records[$i]->id)
    //                     ->get();


    //         $total_student = DB::table("std_student_class_stream")
    //                         ->select( DB::raw("COUNT(std_student_class_stream.SectionDetailsId) as total_student"))
    //                         ->where('SectionDetailsId', $records[$i]->SectionDetailsId)
    //                         ->get();

    //         $records[$i]->not_given = $not_given[0]->not_given;
    //         $records[$i]->total_student = $total_student[0]->total_student;
    //     }

    //     return $this->successResponse($records);

    // }


    /**
     * method to save or update student Supplementation
    */

    public function addSupplementationRecords(Request $request){

        $rules = [
            'term_id'                       => 'required',
            'date'                          => 'required',
            'supplementation'               => 'required'
        ];

        $customMessages = [
            'term_id.required'                      => 'This field is required',
            'date.required'                         => 'This field is required',
            'supplementation.required'              => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                                => $request->id,
            'OrgOrganizationId'                 => $request->organization_id,
            'StdHealthTermId'                   => $request->term_id,
            'StdHealthSupplementationTypeId'    => $request->supplementation,
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

        parse_str($param, $class_details);

        $records = DB::table('std_health_supplementation')
                    ->select('std_health_supplementation.id', 'std_health_supplementation.StdHealthTermId','std_health_supplementation.date',
                                'std_student_class_stream.OrgClassStreamId', 'std_student_class_stream.SectionDetailsId', 'std_health_term.name AS term',
                                'std_health_supplementation_type.Name as supplementation_type')
                    ->join('std_health_term', 'std_health_supplementation.StdHealthTermId', '=', 'std_health_term.id')
                    ->leftjoin('std_student_health_supplementation', 'std_health_supplementation.id', '=', 'std_student_health_supplementation.StdHealthSupplementationId')
                    ->leftjoin('std_student_class_stream', 'std_student_class_stream.SectionDetailsId', '=', 'std_health_supplementation.section')
                    ->join('std_health_supplementation_type', 'std_health_supplementation_type.id', '=', 'std_health_supplementation.StdHealthSupplementationTypeId')
                    ->whereIn('std_health_supplementation.class',$class_details['org_class_stream_id']) 
                    ->whereIn('std_health_supplementation.section',$class_details['section_id'])
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
            'std_class'             => 'required',
            'std_section'           => 'required',
        ];

        $customMessages = [
            'screening.required'                => 'This field is required',
            'date.required'                     => 'This field is required',
            'std_class.required'                => 'This field is required',
            'std_section.required'              => 'This field is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                                    => $request->id,
            'OrgOrganizationId'                     => $request->organization_id,
            'StdHealthScreeningTypeId'              => $request->screening,
            'date'                                  => $request->date,
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
     * method to save or update student health screening records
     *
     * The record of those that are "NOT SCREENED" and "REFERRED" are stored
    */

    public function updateHealthScreeningRecords(Request $request){
        $rules = [
            'isScreened'                => 'required',
            'isReferred'                => 'required'
        ];

        $customMessages = [
            'isScreened.required'                => 'This field is required',
            'isReferred.required'                => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                    => $request->id,
            'StdHealthScreeningId'  => $request->StdHealthScreeningId,
            'StdStudentId'          => $request->StdStudentId,
            'screening_status'      => $request->isScreened,
            'referral_status'       => $request->isReferred,
            'user_id'               => $request->user_id
        ];

        // if id is null - record does not exists and its a new record
        if($data['id'] == NULL){
            if($data['referral_status'] == '1'){
                $screened_data = [
                    'StdHealthScreeningId'  => $request->StdHealthScreeningId,
                    'StdStudentId'          => $request->StdStudentId,
                    'screening_status'      => 'Screened',
                    'referral_status'      => 'Referred'
                ];
            } else if($data['screening_status'] == '0' || $data['referral_status'] == '0'){
                $screened_data = [
                    'StdHealthScreeningId'  => $request->StdHealthScreeningId,
                    'StdStudentId'          => $request->StdStudentId,
                    'screening_status'      => 'Screened',
                    'referral_status'       => 'Not Referred'
                ];
            }
            $response_data = StudentScreening::create($screened_data);

        } else {
            if($data['screening_status'] == '1' || $data['referral_status'] == '0'){
                $response_data = StudentScreening::where('id', '=', $data['id'])->delete();
            }
            if($data['referral_status'] == '1'){
                $screened_data = [
                    'StdHealthScreeningId'  => $request->StdHealthScreeningId,
                    'StdStudentId'          => $request->StdStudentId,
                    'screening_status'      => 'Screened',
                    'referral_status'      => 'Referred'
                ];
                $response_data = StudentScreening::where('id',$data['id'])->update($screened_data);
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

        parse_str($param, $class_details);

        $records = DB::table('std_health_screening_type')
                            ->select('std_health_screening.id', 'std_health_screening.date', 'std_health_screening.class',
                                        'std_health_screening.section', 'std_health_screening.stream', 'std_health_screening_type.name AS screening_type')
                            ->join('std_health_screening', 'std_health_screening.StdHealthScreeningTypeId', '=', 'std_health_screening_type.id')
                            ->leftjoin('std_student_health_screening', 'std_health_screening.id', '=', 'std_student_health_screening.StdHealthScreeningId')
                            ->leftjoin('std_student_class_stream', 'std_student_class_stream.SectionDetailsId', '=', 'std_health_screening.section')
                            ->whereIn('std_health_screening.class',$class_details['org_class_stream_id']) 
                            ->whereIn('std_health_screening.section',$class_details['section_id'])
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

    /**
     * get the health supplementation details
     */

    public function getHealthSupplementationDetails($param=""){
        $id = $param;
        $records = DB::table('std_health_supplementation_type')
                    ->select('std_health_supplementation.id', 'std_health_supplementation.date', 'std_health_supplementation.class',
                                'std_health_supplementation.section', 'std_health_supplementation.stream', 'std_health_supplementation_type.Name AS supplementation_type',
                                'std_screening_endorsed_by.Name AS endorsed_by', 'std_screening_position_title.Name AS position')
                    ->join('std_health_supplementation', 'std_health_supplementation.StdHealthSupplementationTypeId', '=', 'std_health_supplementation_type.id')
                    ->leftjoin('std_screening_position_title', 'std_health_supplementation.StdScreeningPositionTitleId', '=', 'std_screening_position_title.id')
                    ->leftjoin('std_screening_endorsed_by', 'std_health_supplementation.StdScreeningEndorsedById', '=', 'std_screening_endorsed_by.id')
                    ->where('std_health_supplementation.id', $id)
                    ->get();

        return $this->successResponse($records);
    }

    /**
     * Load the health supplementation details of an individual student
     * The is health supplementation id and student id separated by __ (double underscore)
     */

    public function getSupplementationDetails($id=''){
        $param_details = explode('__', $id);

        $records = DB::table('std_health_supplementation')
                    ->select('std_health_supplementation.*', 'std_student_health_supplementation.status as given','std_student.id AS StdStudentId',
                            'std_student_health_supplementation.id as supplementation_id',
                            'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->leftjoin('std_student_class_stream', 'std_health_supplementation.section', '=', 'std_student_class_stream.SectionDetailsId')
                    ->leftjoin('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->leftjoin('std_student_health_supplementation', 'std_student_health_supplementation.StdStudentId', '=', 'std_student.id')
                    ->where('std_health_supplementation.id', $param_details[0])
                    ->where('std_student.id', $param_details[1])
                    ->first();

        return $this->successResponse($records);
    }

    /**
     * method to save or update student health supplementation records
     *
    */

    public function updateHealthSupplementationRecords(Request $request){
        $rules = [
            'given'                => 'required'
        ];

        $customMessages = [
            'given.required'                => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                            => $request->id,
            'StdHealthSupplementationId'    => $request->StdHealthSupplementationId,
            'StdStudentId'                  => $request->StdStudentId,
            'given'                         => $request->given,
            'user_id'                       => $request->user_id
        ];

        // if id is null - record does not exists and its a new record
        if($data['id'] == NULL){
            if($data['given'] == '0'){
                $data = [
                    'StdHealthSupplementationId'    => $request->StdHealthSupplementationId,
                    'StdStudentId'                  => $request->StdStudentId,
                    'status'                        => 'Not Given'
                ];
                $response_data = StudentSupplementation::create($data);
            }

        } else {
            if($data['given'] == '1'){
                $response_data = StudentSupplementation::where('id', '=', $data['id'])->delete();
            }
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);

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
        // $data =[
        //     'id'               => $request->id,
        //     'term_id'          => $request->term_id,
        //     'date'             => $request->date,
        //     'std_id'                => $request->std_id,
        //     'height'                => $request->height,
        //     'weight'          => $request->weight,
        //     'remarks'        => $request->remarks

        //     //'user_id'        => $this->user_id()
        // ];

        // $std_ids = $data['std_id'];
        // $std_height = $data['height'];
        // $std_weight = $data['weight'];
        // $std_remarks = $data['remarks'];

        // unset($data['std_id']);
        // unset($data['height']);
        // unset($data['weight']);
        // unset($data['remarks']);
        $data =[
            'term_id'          => $request->term_id,
            'date'             => $request->date,
            'class_id'         => $request->std_class,
            'stream_id'        => $request->std_stream,
            'section_id'       => $request->std_section,
            'remarks'          => $request->remarks,
            'created_by'          => $request->user_id,
        ];
        $summ_data=StudentBmiSummery::create($data);
        foreach($request->studentList as $student_id){
        // foreach($std_ids as $index => $student_id){
            $height=0;
            if(isset($student_id['height'])){
                $height=$student_id['height'];
            }
            $weight=0;
            if(isset($student_id['weight'])){
                $weight=$student_id['weight'];
            }
            $bmi='NA';
            if($weight>0){
                $wight=(float) $weight;
                $temp_height=(float) $height/100;
                $bmi=number_format($wight/($temp_height *$temp_height), 2, '.', '');
            }
            $screened_data = [
                'StdHealthBmiId'        => $summ_data->id,
                'StdStudentId'          => $student_id['id'],
                'height'                => $height,
                'weight'                => $weight,
                'bmi'                   => $bmi,
                'result'                => $bmi
            ];
            $response_data = StudentBmi::create($screened_data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /*
    * Update BMI Records for students
    */

    public function updateBmiRecord(Request $request){
        $rules = [
            'weight'            => 'required',
            'height'            => 'required'
        ];

        $customMessages = [
            'weight.required'   => 'This field is required',
            'height.required'   => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'           => $request->id,
            'height'       => $request->height,
            'weight'       => $request->weight,
            'user_id'      => $request->user_id
        ];

        $height=0;
        if(isset($data['height'])){
            $height=$data['height'];
        }
        $weight=0;
        if(isset($data['weight'])){
            $weight=$data['weight'];
        }
        $bmi='NA';
        if($weight>0){
            $wight=(float) $weight;
            $temp_height=(float) $height/100;
            $bmi=number_format($wight/($temp_height *$temp_height), 2, '.', '');
        }
        $screened_data = [
            'height'                => $height,
            'weight'                => $weight,
            'bmi'                   => $bmi,
            'result'                => $bmi
        ];

        $response_data = StudentBmi::where('id',$data['id'])->update($screened_data);

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadBmiSummary($param=""){
        parse_str($param, $class_details);
        
        // $records = DB::table('std_health_bmi')
        //         ->join('std_health_term', 'std_health_bmi.StdHealthTermId', '=', 'std_health_term.id')
        //         ->join('std_student', 'std_health_bmi.StdStudentId', '=', 'std_student.id')
        //         ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
        //         ->select('std_health_bmi.*', 'std_health_term.name AS term', 'std_student_class_stream.OrgClassStreamId AS class', 'std_student_class_stream.SectionDetailsId AS section')
        //         ->groupBy('std_health_bmi.StdHealthTermId', 'std_student_class_stream.SectionDetailsId')
        //         ->get();
        $records = StudentBmiSummery::whereIn('class_id',$class_details['org_class_stream_id'])
                            ->whereIn('section_id',$class_details['section_id'])
                            ->get();
        return $this->successResponse($records);
    }

    public function loadBmidetails($id=""){
        $records = StudentBmiSummery::where('id',$id)->first();
         $rec = DB::table('std_student_bmi')
            ->join('std_student', 'std_student_bmi.StdStudentId', '=', 'std_student.id')
            ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
            ->select('std_student_bmi.*', 'std_student.*')
            ->where('std_student_bmi.StdHealthBmiId',$records->id)
            ->get();
        $records->bmiDetails=$rec;
        //StudentBmi::where('StdHealthBmiId',$records->id)->get();
        return $this->successResponse($records);
    }

    /**
     * Load the health screening details of an individual student
     * The is health screening id and student id separated by __ (double underscore)
     */

    public function getBmiDetails($id=''){
        $param_details = explode('__', $id);
        try{
            DB::table('std_student_bmi_summary')
                    ->select('std_student_bmi.*', 'std_student.id AS StdStudentId',
                            'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->leftjoin('std_student_class_stream', 'std_student_bmi_summary.section_id', '=', 'std_student_class_stream.SectionDetailsId')
                    ->leftjoin('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->leftjoin('std_student_bmi', 'std_student_bmi.StdStudentId', '=', 'std_student.id')
                    ->where('std_student.id', $param_details[1])
                    ->first();

            } catch(\Illuminate\Database\QueryException $ex){
                dd($ex->getMessage());
                // Note any method of class PDOException can be called on $ex.
            }

        $records = DB::table('std_student_bmi_summary')
                    ->select('std_student_bmi.*', 'std_student.id AS StdStudentId',
                            'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->leftjoin('std_student_class_stream', 'std_student_bmi_summary.section_id', '=', 'std_student_class_stream.SectionDetailsId')
                    ->leftjoin('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->leftjoin('std_student_bmi', 'std_student_bmi.StdStudentId', '=', 'std_student.id')
                    ->where('std_student.id', $param_details[1])
                    ->first();

        return $this->successResponse($records);
    }

    public function loadresult($months='',$gender="",$bmi=""){
        try{
            $num=(floatval($months)+0.5);
            $rewult=$months-intval($num);
            //alert(val+' : '+num+' : '+parseInt(num)+': '+parseFloat(rewult+0.5) );
            //calculating the incremental values
            $increment=round(floatval($rewult+0.5),2);

            $selectedrange1 = DB::select('SELECT * FROM master_cdc_bmi a WHERE a.age<= "'.($months+1).'" ORDER BY a.age DESC LIMIT 1 ');

            $selectedrange = DB::select('SELECT * FROM master_cdc_bmi a WHERE a.age<= "'.$months.'" ORDER BY a.age DESC LIMIT 1 ');

            // dd($selectedrange);
            //calculating values for L.M & S for male and female
            if($gender=="Male"){
                $L=($increment*floatval($selectedrange1[0]->maleL))+(1-$increment)*(floatval($selectedrange[0]->maleL));
                $M=($increment*floatval($selectedrange1[0]->maleM))+(1-$increment)*(floatval($selectedrange[0]->maleM));
                $S=($increment*floatval($selectedrange1[0]->maleS))+(1-$increment)*(floatval($selectedrange[0]->maleS));
            }
            if($gender=="Female"){
                $L=($increment*floatval($selectedrange1[0]->femaleL))+(1-$increment)*(floatval($selectedrange[0]->femaleL));
                $M=($increment*floatval($selectedrange1[0]->femaleM))+(1-$increment)*(floatval($selectedrange[0]->femaleM));
                $S=($increment*floatval($selectedrange1[0]->femaleS))+(1-$increment)*(floatval($selectedrange[0]->femaleS));
            }
            //calculating z_scores
            $z_scre=(pow(($bmi/$M),$L)-1)/($L*$S);
            //$percentile=$L*$z_scre*100;

            //result
            $result="";
            if($months<240 && !is_infinite($z_scre)){//20 years
                if($z_scre<-3){
                    $result="Severe Thinness";
                }
                if($z_scre>=-3 && $z_scre<-2){
                    $result="Thinness";
                }
                if($z_scre>=-2 && $z_scre<1){
                    $result="Normal";
                }
                if($z_scre>=1 && $z_scre<2){
                    $result="Overweight";
                }
                if($z_scre>=2){
                    $result="Obese";
                }
            }
            else{
                if($bmi<18.5){
                    $result="Underweight";
                }
                if($bmi>=18.5 && $bmi<=24.99){
                    $result="Normal";
                }
                if($bmi>25 && $bmi<30){
                    $result="Overweight";
                }
                if($bmi>=30){
                    $result="Obese";
                }
            }

        } catch(\Illuminate\Database\QueryException $ex){
            dd($ex->getMessage());
        }
        return $result;
    }

    /**
     * get the health bmi details
     */

    public function getHealthBmiDetails($param=""){
        $id = $param;
        $records = DB::table('std_student_bmi_summary')
                    ->select('std_student_bmi_summary.*')
                    ->where('std_student_bmi_summary.id', $id)
                    ->get();

        return $this->successResponse($records);
    }

    /**
     * Load the bmi details of the view
     * The param takes 4 parameters - class, section, stream and health id separated by __ (double underscore)
     */

    public function loadViewBmiDetails($param=''){
        $param_details = explode('__', $param);

        $records = DB::table('std_student_bmi_summary')
                    ->select('std_student_bmi.*', 'std_student.id AS StdStudentId', 'std_student.Name', 'std_student.student_code',
                                'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->leftjoin('std_student_class_stream', 'std_student_bmi_summary.section_id', '=', 'std_student_class_stream.SectionDetailsId')
                    ->leftjoin('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->leftjoin('std_student_bmi', 'std_student_bmi.StdStudentId', '=', 'std_student.id')
                    ->where('std_student_bmi_summary.section_id', $param_details[1])
                    ->where('std_student_bmi_summary.id', $param_details[3])
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
                    ->select('std_health_screening.id as id', 'std_student_health_screening.id as screen_id', 'std_student_health_screening.screening_status as screened',
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
     * Load the supplementation details of the view
     * The param takes 4 parameters - class, section, stream and health id separated by __ (double underscore)
     */

    public function loadViewSupplementationDetails($param=''){
        $param_details = explode('__', $param);

        $records = DB::table('std_health_supplementation')
                    ->select('std_health_supplementation.id as id', 'std_student.id AS StdStudentId', 'std_student.Name', 'std_student.student_code',
                                'std_student_health_supplementation.id as supplementation_id', 'std_student_health_supplementation.status as given',
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
            'user_id'               => $request->user_id
        ];

        $std_ids = $data['std_id'];
        $std_vaccinated = $data['std_vaccinated'];

        unset($data['std_id']);
        unset($data['std_vaccinated']);

        $response_data = StudentHealthVaccination::create($data);
        $lastInsertId = $response_data->id;

        //insert students that are given
        foreach($std_vaccinated as $key => $value){
            $vaccination_data = [
                'StdHealthVaccinationId'    => $lastInsertId,
                'StdStudentId'              => $value,
                'status'                    => 'vaccinated'
            ];
            StudentVaccination::create($vaccination_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);

    }

    public function loadVaccinationRecords($param=""){
        parse_str($param, $class_details);

        $records = DB::table('std_health_vaccination')
                    ->select('std_health_vaccination.id', 'std_health_vaccination.dose',
                                'std_student_class_stream.OrgClassStreamId', 'std_student_class_stream.SectionDetailsId',
                                'std_vaccine_type.Name as vaccine_type')
                    ->leftjoin('std_student_vaccination', 'std_health_vaccination.id', '=', 'std_student_vaccination.StdHealthVaccinationId')
                    ->leftjoin('std_student_class_stream', 'std_student_class_stream.SectionDetailsId', '=', 'std_health_vaccination.section')
                    ->join('std_vaccine_type', 'std_vaccine_type.id', '=', 'std_health_vaccination.StdVaccineTypeId')
                    ->whereIn('std_health_vaccination.class',$class_details['org_class_stream_id']) 
                    ->whereIn('std_health_vaccination.section',$class_details['section_id'])
                    ->groupBy('std_health_vaccination.StdVaccineTypeId','std_student_class_stream.SectionDetailsId', 'std_student_class_stream.SectionDetailsId')
                    ->get();

        return $this->successResponse($records);
    }

    public function updateVaccinationRecords($param=""){
        //
    }

    /**
     * Load the vaccination details of the view
     * The param takes 4 parameters - class, stream, section and health id separated by __ (double underscore)
     */

    public function loadViewVaccinationDetails($param=''){
        $param_details = explode('__', $param);

        $records = DB::table('std_health_vaccination')
                    ->select('std_health_vaccination.id as id', 'std_student.id AS StdStudentId', 'std_student.Name', 'std_student.student_code',
                                'std_student_vaccination.id as vaccination_id', 'std_student_vaccination.status as given',
                                'std_student.DateOfBirth', 'std_student.CmnSexId', 'std_vaccine_type.Name as vaccination_type')
                    ->leftjoin('std_student_class_stream', 'std_health_vaccination.section', '=', 'std_student_class_stream.SectionDetailsId')
                    ->join('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                    ->join('std_student_vaccination', 'std_student_vaccination.StdStudentId', '=', 'std_student.id')
                    ->join('std_vaccine_type', 'std_vaccine_type.id', '=', 'std_health_vaccination.StdVaccineTypeId')
                    ->where('std_health_vaccination.section', $param_details[1])
                    ->where('std_health_vaccination.id', $param_details[3])
                    ->get();

        return $this->successResponse($records);

    }

    /**
     * Load the health vaccination details of an individual student to edit
     * The is  vaccination id and student id separated by __ (double underscore)
     */

    public function getHealthVaccinationDetails($id=''){

        $response_data = DB::table('std_vaccine_type')
                    ->select('std_health_vaccination.id', 'std_health_vaccination.date', 'std_health_vaccination.class',
                                'std_health_vaccination.section', 'std_health_vaccination.stream', 'std_vaccine_type.Name AS vaccine_type')
                    ->join('std_health_vaccination', 'std_health_vaccination.StdVaccineTypeId', '=', 'std_vaccine_type.id')
                    ->where('std_health_vaccination.id', $id)
                    ->get();
        return $response_data;
    }

    public function getVaccinationDetails($param=""){
        $param_details = explode('__', $param);

        $response_data = DB::table('std_health_vaccination')
                            ->select('std_health_vaccination.*', 'std_student_vaccination.status as vaccinated','std_student.id AS StdStudentId',
                                    'std_student_vaccination.id as vaccination_id',
                                    'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId')
                            ->leftjoin('std_student_class_stream', 'std_health_vaccination.section', '=', 'std_student_class_stream.SectionDetailsId')
                            ->join('std_student', 'std_student_class_stream.StdStudentId', '=', 'std_student.id')
                            ->join('std_student_vaccination', 'std_student_vaccination.StdStudentId', '=', 'std_student.id')
                            ->where('std_health_vaccination.id', $param_details[0])
                            ->where('std_student.id', $param_details[1])
                            ->get();
        return $response_data;
    }

    /**
     * Functions for Summary of Health Records
     * the record type is also the name of the table
     */ 

    public function loadHealthSummary($data=''){
        //get the array from the url parameters
        parse_str($data, $data_parameters);
        
        $table_name = $data_parameters['record_type'];
        $health_type = $data_parameters['health_type'];
        $term = $data_parameters['term'];
        $org_id = $data_parameters['organization_id'];

        $class_details = DB::table("std_student_class_stream")
                    ->join('std_student', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
                    ->select('OrgClassStreamId', 'SectionDetailsID')
                    ->distinct('OrgClassStreamId')
                    ->where('OrgOrganizationId', $org_id)
                    ->get();
                    
        foreach($class_details as $record_details){
            $record_details->health_status = $this->getHealthSummaryStatus($table_name, $record_details->OrgClassStreamId, $record_details->SectionDetailsID, $term);
        }
        return $class_details;
    }

    /**
     * Get the status of the health summary i.e. whether checked or not
     */
    private function getHealthSummaryStatus($table_name, $class, $section, $term){
        $result = DB::table($table_name)
                    ->select('id')
                    ->where('class', $class)
                    ->where('section', $section)
                    ->first();
        
        if($result != null && $result != '')
            return 'Done';
        else 
            return 'Not Done';
    }
}
