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

    /*
    * Supplementation Records
    */

    public function addSupplementationRecords(Request $request){
        $rules = [
            'term_id'                       => 'required',
            'date'                          => 'required',
            'supplementation'               => 'required',
        ];

        $customMessages = [
            'term_id.required'                      => 'This field is required',
            'date.required'                         => 'This field is required',
            'supplementation.required'              => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                            => $request->id,
            'term_id'                       => $request->term_id,
            'supplementation'               => $request->supplementation,
            'date'                          => $request->date,
            'std_class'                     => $request->std_class,
            'std_stream'                    => $request->std_stream,
            'std_section'                   => $request->std_section,
            'std_id'                        => $request->std_id,
            'std_screened'                  => $request->std_screened,
            'organization_id'               => $this->getWrkingAgencyId(),
            'user_id'                       =>  $this->userId()
        ];

            $response_data= $this->apiService->createData('emis/students/addSupplementationRecords', $data);
            return $response_data;

    }

    public function loadSupplementationRecords($param=""){
        $student_records = $this->apiService->listData('emis/students/loadSupplementationRecords/'.$param);
        return $student_records;
    }

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
            'user_id'                       =>  $this->userId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/updateHealthSupplementationRecords', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    /*
    * Health Screening Records
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
            'id'                    => $request->id,
            'screening'             => $request->screening,
            'date'                  => $request->date,
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
            'isScreened'            => $request->isScreened,
            'isReferred'            => $request->isReferred,
            'user_id'               =>  $this->userId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/updateHealthScreeningRecords', $data);
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
            'std_class'        => $request->std_class,
            'std_stream'       => $request->std_stream,
            'std_section'      => $request->std_section,
            'std_id'           => $request->std_id,
            'height'           => $request->height,
            'weight'           => $request->weight,
            'remarks'          => $request->remarks,
            'studentList'      => $request->studentList,
            'organization_id'  => $this->getWrkingAgencyId(),
            'user_id'          => $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/students/addBmiRecords', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    /*
    * Update BMI Record of a student
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
            'user_id'      => $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/students/updateBmiRecord', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadBmiSummary(){
        $student_records = $this->apiService->listData('emis/students/loadBmiSummary/'.$this->userId());
        return $student_records;
    }

    public function loadBmidetails($id=""){
        $student_records = $this->apiService->listData('emis/students/loadBmidetails/'.$id);
        return $student_records;
    }

    public function loadViewBmiDetails($param=""){
        $student_records = $this->apiService->listData('emis/students/loadViewBmiDetails/'.$param);
        return $student_records;
    }

    public function getHealthBmiDetails($param=""){
        $student_records = $this->apiService->listData('emis/students/getHealthBmiDetails/'.$param);
        return $student_records;
    }

    public function getBmiDetails($id=""){
        $student_records = $this->apiService->listData('emis/students/getBmiDetails/'.$id);
        return $student_records;
    }

    public function loadresult($months="",$gender="",$bmi=""){
        $student_records = $this->apiService->listData('emis/students/loadresult/'.$months.'/'.$gender.'/'.$bmi);
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
     * Load the health supplementation details of the view
     * The param takes 4 parameters - class, stream, section and health id separated by __ (double underscore)
     */

    public function loadViewSupplementationDetails($param=''){
        $student_records = $this->apiService->listData('emis/students/loadViewSupplementationDetails/'.$param);
        return $student_records;
    }

    public function getHealthSupplementationDetails($param=""){
        $student_records = $this->apiService->listData('emis/students/getHealthSupplementationDetails/'.$param);
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

    /**
     * Add Vaccination Records
     */

    public function addVaccinationRecords(Request $request){
        $rules = [
            'vaccination'           => 'required',
            'dose'                  => 'required',
            'std_class'             => 'required',
            'std_section'           => 'required',
        ];

        $customMessages = [
            'vaccination.required'              => 'This field is required',
            'dose.required'                     => 'This field is required',
            'std_class.required'                => 'This field is required',
            'std_section.required'              => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        

        $data =[
            'id'                    => $request->id,
            'vaccination'           => $request->vaccination,
            'dose'                  => $request->dose,
            'date'                  => $request->date,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_vaccinated'        => $request->std_vaccinated,
            'organization_id'       => $this->getWrkingAgencyId(),
            'user_id'               =>  $this->userId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/addVaccinationRecords', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    /**
     * load the vaccination records for listing
     */

    public function loadVaccinationRecords(){
        $param = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/loadVaccinationRecords/'.$param);
        return $student_records;
    }

    public function getHealthVaccinationDetails($param=""){
        $student_records = $this->apiService->listData('emis/students/getHealthVaccinationDetails/'.$param);
        return $student_records;
    }

    
    public function loadViewVaccinationDetails($param=''){
        $student_records = $this->apiService->listData('emis/students/loadViewVaccinationDetails/'.$param);
        return $student_records;
    }
    
    public function getVaccinationDetails($id=''){
        $student_records = $this->apiService->listData('emis/students/getVaccinationDetails/'.$id);
        return $student_records;
    }

    /**
     * Functions for Endorsing health records
     */

    
    public function saveHealthEndorsement(Request $request){
        $data =[
            'id'                            => $request->id,
            'endorsed_by'                   => $this->userId(),
            'health_record_type'            => $request->health_record_type,
            'organization_id'               => $this->getWrkingAgencyId(),
            'user_id'                       => $this->userId()
        ];

        $response_data= $this->apiService->createData('emis/students/saveHealthEndorsement', $data);
        return $response_data;
    }

    public function loadHealthSummary(){
        $org_id = $this->getWrkingAgencyId();
        $health_records = $this->apiService->listData('emis/students/loadHealthSummary/'.$org_id);
        return $health_records;
    }

    public function loadScreeningEndorsement(){
        $org_id = $this->getWrkingAgencyId();
        $health_records = $this->apiService->listData('emis/students/loadScreeningEndorsement/'.$org_id);
        return $health_records;
    }

    public function loadVaccinationEndorsement(){
        $org_id = $this->getWrkingAgencyId();
        $health_records = $this->apiService->listData('emis/students/loadVaccinationEndorsement/'.$org_id);
        return $health_records;
    }

    public function loadSupplementationEndorsement(){
        $org_id = $this->getWrkingAgencyId();
        $health_records = $this->apiService->listData('emis/students/loadSupplementationEndorsement/'.$org_id);
        return $health_records;
    }
}
