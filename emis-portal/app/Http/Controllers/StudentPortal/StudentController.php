<?php

namespace App\Http\Controllers\StudentPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helper\EmisService;
use App\Traits\AuthUser;

/**
 * Controller for student related activities
 */

class StudentController extends Controller
{
    public $apiService;
    use AuthUser;
    
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function getstudentdetailsbyCid($cid=""){
        $response_data= $this->apiService->listData('emis/students/admission/getstudentdetailsbyCid/'.$cid);
        return $response_data;
    }

    public function getStudentClassId($std_id=""){
        $response_data= $this->apiService->listData('emis/students/getStudentClassId/'.$std_id);
        return $response_data;
    }

    /**
     * Load the marks for a students (Class X Results)
     */

    public function loadStudentMarks($std_code){
        $response_data= $this->apiService->listData('emis/students/admission/loadStudentMarks/'.$std_code);
        return $response_data;
    }
}
