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

    public function loadBasicStudentList($param=""){
        $param = $this->getWrkingAgencyId();
        $student_list = $this->apiService->listData('emis/students/loadStudentList/'.$param);
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
    
}
