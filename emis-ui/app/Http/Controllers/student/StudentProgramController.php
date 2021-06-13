<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentProgramController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentProgram(Request $request){

        $rules = [
            // 'program'            => 'required',
            'supporter'            => 'required',
            'year'            => 'required',
        ];

        $customMessages = [
            // 'program.required'  => 'This field is required',
            'supporter.required'     => 'This field is required',
            'year.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                => $request->id,
            'organisation_id'   => $this->getWrkingAgencyId(),
            'program'           => $request->program,
            'supporter'         => $request->supporter,
            'year'              => $request->year,
            'remarks'           => $request->remarks,
            'assigned_staff'    => $request->assigned_staff,
            'user_id'        => $this->userId() 
        ];

        // try{
            $response_data= $this->apiService->createData('emis/students/saveStudentProgram', $data);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentPrograms($param=""){
        $student_records = $this->apiService->listData('emis/students/listStudentPrograms/'.$param);
        return $student_records;
    }

    /*
    * Function is to load the list of student Programs
    */

    public function loadStudentPrograms($param=""){
        $student_records = $this->apiService->listData('emis/students/loadStudentPrograms/'.$param);
        return $student_records;
    }

     /*
    * Function is to list Clubs for drop down
    */

    public function listStudentClubs($param=""){
        $student_records = $this->apiService->listData('emis/students/listStudentClubs/'.$param);
        return $student_records;
    }

    /*
    * Function is to load the list of student clubs
    */

    public function loadStudentClubs($param=""){
        $student_records = $this->apiService->listData('emis/students/loadStudentClubs/'.$param);
        return $student_records;
    }

    /**
     * Get the program details based on id while editing
     * 
     */

     public function getProgramDetails($param=""){
        $student_records = $this->apiService->listData('emis/students/getProgramDetails/'.$param);
        return $student_records;
     }

    /*
    * Save Program Members
    */

    public function saveProgramMembers(Request $request){
        $rules = [
            'student'                    => 'required',
            'program'                    => 'required',
            'responsibilities'           => 'required',
        ];

        $customMessages = [
            'student.required'            => 'This field is required',
            'program.required'            => 'This field is required',
            'responsibilities.required'   => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'organizationId'        => $this->getWrkingAgencyId(), 
            'id'                    => $request->id,
            'status'                => $request->status,
            'student'               => $request->student,
            'program'               => $request->program,
            'date'                  => $request->date,
            'responsibilities'      => $request->responsibilities,
            'role'                  => $request->role

            //'user_id'        => $this->user_id() 
        ];
            $response_data= $this->apiService->createData('emis/students/saveProgramMembers', $data);
            return $response_data;
       
    }
    /*
    Function to save Club members 
    */
    public function saveClubMembers(Request $request){
        $rules = [
            'student'                      => 'required',
            // 'program'                  => 'required',
            'responsibilities'            => 'required',
        ];

        $customMessages = [
            'student.required'  => 'This field is required',
            // 'program.required'     => 'This field is required',
            'responsibilities.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'organizationId'        => $this->getWrkingAgencyId(), 
            'id'                    => $request->id,
            'status'                => $request->status,
            'student'               => $request->student,
            'program'               => $request->program,
            'date'                  => $request->date,
            'responsibilities'      => $request->responsibilities,
            'role'                  => $request->role

            //'user_id'        => $this->user_id() 
        ];
       // dd($data);
            $response_data= $this->apiService->createData('emis/students/saveClubMembers', $data);
            return $response_data;
       
    }

    public function listClubMember($orgId=""){
        $student_records = $this->apiService->listData('emis/students/listClubMember/'.$orgId);
        return $student_records;
    }




    /*
    * Function is to list Program Members 
    */

    public function listProgramMembers($param=""){
        $student_records = $this->apiService->listData('emis/students/listProgramMembers/'.$param);
        return $student_records;
    }


    /*
    * Save Program Inventory
    */

    public function saveProgramInventory(Request $request){

        $rules = [
            'program'            => 'required',
            'month'            => 'required',
        ];

        $customMessages = [
            'program.required'     => 'This field is required',
            'month.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                    => $request->id,
            'organisation_id'       => $this->getWrkingAgencyId(),
            'program'               => $request->program,
            'month'                 => $request->month,
            'inventoryDetails'      => $request->inventoryDetails,
            'productionDetails'     => $request->productionDetails,
            'expenditureDetails'    => $request->expenditureDetails,

            //'user_id'        => $this->user_id() 
        ];
      //  dd( $data);

        // try{
            $response_data= $this->apiService->createData('emis/students/saveProgramInventory', $data);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
    }

    /*
    * Function is to load inventory of the programs
    */

    public function loadProgramInventory($param=""){
        $student_records = $this->apiService->listData('emis/students/loadProgramInventory/'.$param);
        return $student_records;
    }

    /*
    * Save Program Action Plan
    */

    public function saveProgramActionPlan(Request $request){

        $rules = [
            'program'            => 'required',
            'from_date'            => 'required',
            'to_date'           => 'required'
        ];

        $customMessages = [
            'program.required'     => 'This field is required',
            'from_date.required'  => 'This field is required',
            'to_date.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                    => $request->id,
            'organisation_id'       => $this->getWrkingAgencyId(),
            'program'               => $request->program,
            'from_date'             => $request->from_date,
            'to_date'               => $request->to_date,
            'action_plan'           => $request->action_plan,
            'user_id'           => $this->userId()
        ];


        // try{
            $response_data= $this->apiService->createData('emis/students/saveProgramActionPlan', $data);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
    }

    /*
    * Function is to load the student Programs Action Plan
    */

    public function loadProgramActionPlan($param=""){
        $student_records = $this->apiService->listData('emis/students/loadProgramActionPlan/'.$param);
        return $student_records;
    }
}
