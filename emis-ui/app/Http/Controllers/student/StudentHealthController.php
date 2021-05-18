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
            'id'               => $request->id,
            'term_id'          => $request->term_id,
            'date'             => $request->date,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_screened'          => $request->std_screened,

            //'user_id'        => $this->user_id() 
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

            //'user_id'        => $this->user_id() 
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/addSupplementationRecords', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadSupplementationRecords($param=""){
        $student_records = $this->apiService->listData('emis/students/loadSupplementationRecords/'.$param);
        return $student_records;
    }

    /*
    * Health Screening Records
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

            //'user_id'        => $this->user_id()
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
            'remarks'        => $request->remarks

            //'user_id'        => $this->user_id() 
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
}
