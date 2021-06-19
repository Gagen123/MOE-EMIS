<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentHealthController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function addDewormingRecords(Request $request){

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
            'id'                    => $request->id,
            'term_id'               => $request->term_id,
            'date'                  => $request->date,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_screened'          => $request->std_screened,
            'organization_id'       => $this->getWrkingAgencyId(),
            'user_id'               =>  $this->userId() 
        ];


        try{
            $response_data= $this->apiService->createData('emis/students/addDewormingRecords', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadDewormingRecords($param=""){
        $student_records = $this->apiService->listData('emis/students/loadDewormingRecords/'.$param);
        return $student_records;
    }

    /*
    * Supplementation Records
    */

    public function addSupplementationRecords(Request $request){
        // dd($request);
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
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_screened'          => $request->std_screened,
            'organization_id'       => $this->getWrkingAgencyId(),
            'user_id'               =>  $this->userId() 
        ];
       
            $response_data= $this->apiService->createData('emis/students/addSupplementationRecords', $data);
            return $response_data;
        
    }

    public function loadSupplementationRecords($param=""){
        $student_records = $this->apiService->listData('emis/students/loadSupplementationRecords/'.$param);
        return $student_records;
    }

    /*
    * Health Screening Records
    */

    public function addHealthScreeningRecords(Request $request){
        dd($request);
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
            'id'                    => $request->id,
            'screening'             => $request->screening,
            'prepared_by'           => $request->prepared_by,
            'screening_position'    => $request->screening_position,
            'date'                  => $request->date,
            'screening_endorsed_by' => $request->screening_endorsed_by,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_screened'          => $request->std_screened,
            'std_referred'          => $request->std_referred,
            'organization_id'       => $this->getWrkingAgencyId(),
            'user_id'               =>  $this->userId() 
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/addHealthScreeningRecords', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadHealthScreeningRecords($param=""){
        $param = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/loadHealthScreeningRecords/'.$param);
        return $student_records;
    }

    public function listScreeningSummary($param=""){
        $param = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/listScreeningSummary/'.$param);
        return $student_records;
    }

    public function getHealthScreeningSummary($param=""){
        $param = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/getHealthScreeningSummary/'.$param);
        return $student_records;
    }

    public function getHealthScreeningDetails($param=""){
        $student_records = $this->apiService->listData('emis/students/getHealthScreeningDetails/'.$param);
        return $student_records;
    }

    public function getStudentScreenedDetails($param=""){
        $student_records = $this->apiService->listData('emis/students/getStudentScreenedDetails/'.$param);
        return $student_records;
    }

    public function getStudentReferredDetails($param=""){
        $student_records = $this->apiService->listData('emis/students/getStudentReferredDetails/'.$param);
        return $student_records;
    }

    /*
    * Update Health Screening Records
    */

    public function updateHealthScreeningRecords(Request $request){

        dd('in the UI');

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
            'id'                    => $request->id,
            'screening'             => $request->screening,
            'prepared_by'           => $request->prepared_by,
            'screening_position'    => $request->screening_position,
            'date'                  => $request->date,
            'screening_endorsed_by' => $request->screening_endorsed_by,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_screened'          => $request->std_screened,
            'std_referred'          => $request->std_referred,
            'organization_id'       => $this->getWrkingAgencyId(),
            'user_id'               =>  $this->userId() 
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/addHealthScreeningRecords', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    /*
    * BMI Records
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
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'            => $request->std_id,
            'height'                => $request->height,
            'weight'          => $request->weight,
            'remarks'        => $request->remarks,
            'organization_id'       => $this->getWrkingAgencyId(),
            'user_id'               =>  $this->userId() 
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/addBmiRecords', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    
    public function loadBmiSummary($param=""){
        $student_records = $this->apiService->listData('emis/students/loadBmiSummary/'.$param);
        return $student_records;
    }

    /**
     * Load the health details of the view
     * The param takes 4 parameters - class, stream, section and health id separated by __ (double underscore)
     */

    public function loadViewScreeningDetails($param=''){
        $student_records = $this->apiService->listData('emis/students/loadViewScreeningDetails/'.$param);
        return $student_records;
    }

    /**
     * Load the health details of a student to edit
     * The is health screening id and student id separated by __ (double underscore)
     */

    public function getScreeningDetails($id=''){
        $student_records = $this->apiService->listData('emis/students/getScreeningDetails/'.$id);
        return $student_records;
    }
    /**
     * Load the health deworming details of the view
     * The param takes 4 parameters - class, stream, section and health id separated by __ (double underscore)
     */

    public function loadViewDewormingDetails($param=''){
        $student_records = $this->apiService->listData('emis/students/loadViewDewormingDetails/'.$param);
        return $student_records;
    }

    /**
     * Load the health details of a student to edit
     * The is health screening id and student id separated by __ (double underscore)
     */

    public function getDewormingDetails($id=''){
        $student_records = $this->apiService->listData('emis/students/getDewormingDetails/'.$id);
        return $student_records;
    }
    /**
     * Load the health supplementation details of the view
     * The param takes 4 parameters - class, stream, section and health id separated by __ (double underscore)
     */

    public function loadViewSupplementationDetails($param=''){
        $student_records = $this->apiService->listData('emis/students/loadViewSupplementationDetails/'.$param);
        return $student_records;
    }

    /**
     * Load the health details of a student to edit
     * The is health screening id and student id separated by __ (double underscore)
     */

    public function getSupplementationDetails($id=''){
        $student_records = $this->apiService->listData('emis/students/getSupplementationDetails/'.$id);
        return $student_records;
    }
}
