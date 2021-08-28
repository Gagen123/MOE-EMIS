<?php

namespace App\Http\Controllers\common_services;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class GeneralStudentController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }



    /**
     * Get the basic student list (id, name, student code)
     */

    public function loadStudentList($param=""){
        $param = $this->getWrkingAgencyId();
        $student_list = $this->apiService->listData('emis/students/loadStudentList/'.$param);
        return $student_list;
    }

    /**
     * Get the basic details student list (id, name, student code, class, section, stream)
     */
    public function saveStudentRollNumber(Request $request){
        $data =[
            'id'                    => $request->id,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            //  'roll_no'              => $request->roll_no,
            'studentList'           => $request->studentList,
            'std_referred'          => $request->std_referred,
            'organization_id'       => $this->getWrkingAgencyId(),
            'user_id'               =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/students/saveStudentRollNumber',$data);
        return $response_data;

    }
    public function loadBasicStudentList($param=""){
        $param = $this->getWrkingAgencyId();
        $student_list = $this->apiService->listData('emis/students/loadBasicStudentList/'.$param);
        return $student_list;
    }

    public function getStudentClassId($std_id){
        $class = $this->apiService->listData('emis/students/getStudentClassId/'.$std_id);
        return $class;
    }

    /**
     * Get the student list by class
     *
     * This function gets all the basic details such as feeding, scholarship etc.
     * If you want only student and class, create another function
     */

    public function loadStudentByClass($class=""){
        $student_list = $this->apiService->listData('emis/students/loadStudentByClass/'.$class);
        return $student_list;
    }

    /**
     * Get the student list by stream and section (id, name, student code, class, section, stream)
     * the param is class, stream and section separated by __ (double underscore)
     */

    public function loadStudentBySection($param1=""){
        $student_list = $this->apiService->listData('emis/students/loadStudentBySection/'.$param1);
        return $student_list;
    }

    /**
     * load student list by type (i.e. Regular, CE etc)
     */

    public function loadStudentByType($type="", $class_id=""){
        $student_list = $this->apiService->listData('emis/students/loadStudentByType/'.$type.'/'.$class_id);
        return $student_list;
    }

    /**
     * Load student list by gender
     *
     * Takes class, stream, section and vaccine type as parameter separated by __ (double underscore)
     * We get the gender from master and pass it as an argument in an array
     */

    public function studentListByGender($param=""){
        $gender_list = json_decode($this->apiService->listData('emis/masters/loadGlobalMasters/all_gender'));
        $data_parameters['class_params'] = $param;
        $data_parameters['gender_params'] = $gender_list;
        $data_parameters['organization_id'] = $this->getWrkingAgencyId();

        $data = http_build_query($data_parameters);

        $student_list = $this->apiService->listData('emis/students/studentListByGender/'.$data);
        return $student_list;
    }

    /**
     * For Profile
     * Get Student, Parents, Roles and Responsibilities and Programme/Club Membership of the Student
     *
     * id is the student id
     */

    public function getStudentDetails($id){
        $student_record = $this->apiService->listData('emis/students/getStudentDetails/'.$id);
        return $student_record;
    }

    public function getStudentParentsDetails($id){
        $student_record = $this->apiService->listData('emis/students/getStudentParentsDetails/'.$id);
        return $student_record;
    }

    public function getStudentRoleDetails($id){
        $student_record = $this->apiService->listData('emis/students/getStudentRoleDetails/'.$id);
        return $student_record;
    }

    public function getStudentProgrammeDetails($id){
        $student_record = $this->apiService->listData('emis/students/getStudentProgrammeDetails/'.$id);
        return $student_record;
    }

    /**
     * Load the student information e.g. no. of boys and girls
     *
     * $param takes the value such as general, SEN etc
     */

    public function loadStudentInformation($param){
        $org_id = $this->getWrkingAgencyId();
        $student_record = $this->apiService->listData('emis/students/loadStudentInformation/'.$org_id.'/'.$param);
        return $student_record;
    }

}
