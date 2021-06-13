<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;


class SenStudentController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    //GET SEN STUDENT LSIT
    public function getSenStudentList(){
        $sen_student_list = $this->apiService->listData('emis/students/sen/getSenStudentList');
        return $sen_student_list;
    }

}
