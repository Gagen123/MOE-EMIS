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
            'program'         => 'required',
            'supporter'       => 'required',
          //  'year'            => 'required|min:4|max:4',
        ];

        $customMessages = [
            'program.required'      => 'This field is required',
            'supporter.required'    => 'This field is required',
           // 'year.required'         => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                => $request->id,
            'organisation_id'   => $this->getWrkingAgencyId(),
            'program'           => $request->program,
            'program_type'      => $request->program_type,
            'supporter'         => $request->supporter,
            'year'              => $request->year,
            'remarks'           => $request->remarks,
            'data_type'         => 'school_program',
            'record_type'       => $request->record_type,
            'assigned_staff'    => $request->assigned_staff,
            'user_id'           => $this->userId(),
            'id'                => $request->id
        ];
       // dd( $data );
        //Validate to ensure that there is no duplication of entries
        //Not creating but using the createData service as we are sending the $data
        $validate_data= $this->apiService->createData('emis/students/validateStudentData', $data);

        if(json_decode($validate_data)->data == 'exist'){
            //this is to offset the data and send it back to the view
            $request->offsetUnset('program');

            $rules = [
                'supporter'     => 'required',
                'program'       => 'required'
            ];
            if($request->record_type == 'add'){
                $customMessages = [
                    'supporter.required'        => 'Field is required',
                    'program.required'          => 'Program/Club has already been created for School'
                ];
            } else{
                $customMessages = [
                    'supporter.required'        => 'Field is required',
                    'program.required'          => 'You are performing an edit. No fields have been changed.'
                ];
            }


            $this->validate($request, $rules, $customMessages);
        }

        $response_data= $this->apiService->createData('emis/students/saveStudentProgram', $data);
        return $response_data;
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentPrograms($param=""){
        $param = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/listStudentPrograms/'.$param);
        return $student_records;
    }

    /*
    * Function is to load the list of student Programs
    */

    public function loadStudentPrograms($param=""){
        $param = $this->getWrkingAgencyId();
        //dd($param);
        $student_records = $this->apiService->listData('emis/students/loadStudentPrograms/'.$param);
        return $student_records;
    }

     /*
    * Function is to list Clubs for drop down
    */

    public function listStudentClubs($param=""){
        $param = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/listStudentClubs/'.$param);
        return $student_records;
    }

    /*
    * Function is to load the list of student clubs
    */

    public function loadStudentClubs($param=""){
        $param = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/loadStudentClubs/'.$param);
        return $student_records;
    }

    /**
     * Get the program details based on id while editing
     *
     */

     public function getProgramDetails($id=""){
        $student_records = $this->apiService->listData('emis/students/getProgramDetails/'.$id);
        //dd($student_records);
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
            'id'                    => $request->id,
            'status'                => $request->status,
            'student'               => $request->student,
            'program'               => $request->program,
            'date'                  => $request->date,
            'responsibilities'      => $request->responsibilities,
            'role'                  => $request->role,
            'organizationId'        => $this->getWrkingAgencyId(),
            'user_id'               => $this->userId()
        ];
        // dd($data);
        $response_data= $this->apiService->createData('emis/students/saveProgramMembers', $data);
        return $response_data;

    }

    /*
    * Function is to list Program Members
    */

    public function listProgramMembers($param=""){
        $orgId = $this->getWrkingAgencyId();
        $staffId = $this->staffId();
        $class_teacher_class =  $this->apiService->listData('emis/academics/getClassTeacherClasss/'.$orgId.'/'.$staffId);
        $data_parameters = [];
        foreach(json_decode($class_teacher_class) as $details){
            foreach($details as $value){
                $data_parameters['org_class_stream_id'][] = $value->org_class_stream_id;
                $data_parameters['stream_id'][] =  $value->org_stream_id;
                $data_parameters['section_id'][] = $value->org_section_id;
            }
        }
        $param = http_build_query($data_parameters);
        $student_records = $this->apiService->listData('emis/students/listProgramMembers/'.$param);
        return $student_records;
    }

    /*
    Function to save Club members
    */
    public function saveClubMembers(Request $request){
        //First - check the basic validation of the forms

        $rules = [
            'student'                 => 'required',
            'club'                    => 'required'
        ];

        $customMessages = [
            'student.required'          => 'This field is required',
            'club.required'             => 'This field is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'organizationId'        => $this->getWrkingAgencyId(),
            'id'                    => $request->id,
            'status'                => $request->status,
            'student'               => $request->student,
            'club'                  => $request->club,
            'date'                  => $request->date,
            'responsibilities'      => $request->responsibilities,
            'role'                  => $request->role,
            'data_type'             =>  'club_members',
            'user_id'               =>  $this->userId(),
        ];

        //Validate to ensure that there is no duplication of entries
        //Not creating but using the createData service as we are sending the $data
        $validate_data= $this->apiService->createData('emis/students/validateStudentData', $data);

        // if(json_decode($validate_data)->data == 'exist'){
        //     //this is to offset the data and send it back to the view
        //     $request->offsetUnset('student');

        //     $rules = [
        //         'student'       => 'required',
        //         'program'       => 'required'
        //     ];
        //     $customMessages = [
        //         'student.required'          => 'Student already belongs to a club',
        //         'program.required'          => 'Duplication of Clubs for Student'
        //     ];

        //     $this->validate($request, $rules, $customMessages);
        // }
        $response_data= $this->apiService->createData('emis/students/saveClubMembers', $data);
        return $response_data;

    }

    public function listClubMembers($param=""){
        $orgId = $this->getWrkingAgencyId();
        $staffId = $this->staffId();
        $class_teacher_class =  $this->apiService->listData('emis/academics/getClassTeacherClasss/'.$orgId.'/'.$staffId);
        $data_parameters = [];
        foreach(json_decode($class_teacher_class) as $details){
            foreach($details as $value){
                $data_parameters['org_class_stream_id'][] = $value->org_class_stream_id;
                $data_parameters['stream_id'][] =  $value->org_stream_id;
                $data_parameters['section_id'][] = $value->org_section_id;
            }
        }
        $param = http_build_query($data_parameters);
        $student_records = $this->apiService->listData('emis/students/listClubMembers/'.$param);
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
            'id'                    => $request->inventoryId,
            'actionType'            => $request->actionType,
            'organisation_id'       => $this->getWrkingAgencyId(),
            'program'               => $request->program,
            'month'                 => $request->month,
            'inventoryDetails'      => $request->inventoryDetails,
            'productionDetails'     => $request->productionDetails,
            'expenditureDetails'    => $request->expenditureDetails,
        ];

        $response_data= $this->apiService->createData('emis/students/saveProgramInventory', $data);
        return $response_data;
    }

    /*
    * Function is to load inventory of the programs
    */

    public function loadProgramInventory($param=""){
        $student_records = $this->apiService->listData('emis/students/loadProgramInventory/'.$param);
        return $student_records;
    }


    public function loadInventoryDetials($param=""){
        $student_records = $this->apiService->listData('emis/students/loadInventoryDetials/'.$param);
        return $student_records;
    }

    /*
    * Save Program Action Plan
    */

    public function saveProgramActionPlan(Request $request){

        $rules = [
            'program'            => 'required'
        ];

        $customMessages = [
            'program.required'     => 'This field is required'
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
