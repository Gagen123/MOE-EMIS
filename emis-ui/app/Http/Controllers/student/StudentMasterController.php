<?php

namespace App\Http\Controllers\student;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentMasterController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentMasters(Request $request){

        $rules = [
            'name'          =>  'required',
        ];
        $customMessages = [
            'name.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data = $request->all();

        $response_data= $this->apiService->createData('emis/masters/students/saveStudentMasters', $data);
        return $response_data;

    }
    public function saveStreamSubject(Request $request){
        $rules = [
            
        ];
        $customMessages = [
            
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'id'                        => $request->id,
            'streamId'                  => $request->streamId,
            'subjectlist'               =>  $request->subjectlist,
            'user_id'                   =>  $this->userId()
        ];

        $response_data= $this->apiService->createData('emis/masters/students/saveStreamSubject', $data);
        return $response_data;
    }

    public function saveValidationcondition(Request $request){
        $rules = [
            'date'          =>  'required',
            'date1'         =>  'required',
            'status'        =>  'required',
            'no_months'     =>  'required',
            'no_months1'    =>  'required',
        ];
        $customMessages = [
            'date.required' => 'This field is required',
            'date1.required' => 'This field is required',
            'status.required' => 'This field is required',
            'no_months.required' => 'This field is required',
            'no_months1.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'id'                =>  $request->id,
            'date'              =>  $request->date,
            'date1'             =>  $request->date1,
            'status'            =>  $request->status,
            'no_months'         =>  $request->no_months,
            'no_months1'        =>  $request->no_months1,
            'user_id'           => $this->userId()
        ];

        $response_data= $this->apiService->createData('emis/masters/students/saveValidationcondition', $data);
        return $response_data;

    }

    //get Scouts Section
    public function getScoutSection(){
        $scout_section = $this->apiService->listData('emis/masters/students/getScoutSection');
        return $scout_section;
    }
    //by gagen
    public function loadstreamMarks(){
        $scout_section = $this->apiService->listData('emis/masters/students/loadstreamMarks');
        return $scout_section;
    }
    public function loadValidationcondition(){
        $student_masters = $this->apiService->listData('emis/masters/students/loadValidationcondition/');
        return $student_masters;
    }

    //get Scouts Section Level By Scouts Section Id
    public function getScoutSectionLevel($scoutSectionId){
        $student_masters = $this->apiService->listData('emis/masters/students/getScoutSectionLevel/'.$scoutSectionId);
        return $student_masters;
    }

     //get Scouts Badge By Scouts Section Id
     public function getScoutBadge($scoutSectionId){
        $student_masters = $this->apiService->listData('emis/masters/students/getScoutBadge/'.$scoutSectionId);
        return $student_masters;
    }

    public function loadStudentMasters($param=""){
        $student_masters = $this->apiService->listData('emis/masters/students/loadStudentMasters/'.$param);
        return $student_masters;
    }

    public function loadActiveStudentMasters($param=""){
        $student_masters = $this->apiService->listData('emis/masters/students/loadActiveStudentMasters/'.$param);
        return $student_masters;
    }

    public function allActiveStudentDropdowns($model="",$parent_id=""){
        $response_data = $this->apiService->listData('emis/masters/students/allActiveStudentDropdowns/'.$model."/".$parent_id);
        return $response_data;
    }

    public function saveCounsellingType(Request $request){
        //dd($request);
        $rules = [
            'name'          =>  'required',
          //  'description'   =>  'required',
            'status'        =>  'required',

        ];
        $customMessages = [
            'name.required'   => 'This field is required',
            'status.required' => 'This field is required',

        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'id'                =>  $request['id'],
            'name'              =>  $request['name'],
            'description'       =>  $request['description'],
            'status'            =>  $request['status'],
            'user_id'           => $this->userId()
        ];
      //  dd($data);

        $response_data= $this->apiService->createData('emis/masters/students/saveCounsellingType', $data);
        return $response_data;

    }
    public function loadActiveCounsellingMaster($param=""){
        // dd('m here');
         $student_masters = $this->apiService->listData('emis/masters/students/loadActiveCounsellingMaster/'.$param);
         return $student_masters;
    }

    /**
     * To get the list of program items based on the variety for Programs
     * the id is the program_item_variety id
     */

    public function getProgramItems($id=""){
        $program_items = $this->apiService->listData('emis/masters/students/getProgramItems/'.$id);
        return $program_items;
    }

    public function getStudentAwards($id=""){
        $awards = $this->apiService->listData('emis/masters/students/getStudentAwards/'.$id);
        return $awards;
    }

    public function getOffenceType($id=""){
        $awards = $this->apiService->listData('emis/masters/students/getOffenceType/'.$id);
        return $awards;
    }

    public function getActionTaken($id=""){
        $awards = $this->apiService->listData('emis/masters/students/getActionTaken/'.$id);
        return $awards;
    }
    
    
    public function saveFoodSourceType(Request $request){
        //dd($request);
        $rules = [
            'Name'          =>  'required',
          //  'description'   =>  'required',
            'Status'        =>  'required',

        ];
        $customMessages = [
            'Name.required'   => 'This field is required',
            'Status.required' => 'This field is required',

        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'id'                =>  $request['id'],
            'Name'              =>  $request['Name'],
            'Description'       =>  $request['Description'],
            'Status'            =>  $request['Status'],
            'user_id'           => $this->userId()
        ];
      // dd($data);

        $response_data= $this->apiService->createData('emis/masters/students/saveFoodSourceType', $data);
        return $response_data;

    }
   
    public function loadfoodSourceList(){
        // dd('m here');
         $student_masters = $this->apiService->listData('emis/masters/students/loadfoodSourceList');
         return $student_masters;
    }

    public function loadActiveFoodSourceMaster(){
        // dd('m here');
         $student_masters = $this->apiService->listData('emis/masters/students/loadActiveFoodSourceMaster');
         return $student_masters;
    }

}
