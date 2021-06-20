<?php

namespace App\Http\Controllers\student;

use App\Traits\AuthUser;
use App\Helper\EmisService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;


class SenQuestionnaireController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    //GET SEN STUDENT LSIT
    public function getQuestionnaire($StudentId){
        $sen_student_list = $this->apiService->listData('emis/students/sen/getquestionnaire/'.$StudentId);
        return $sen_student_list;
    }

    public function saveQuestionnaire(Request $request){
        // dd($request['data']);
        // 'id',
        // 'org_id',
        // 'staff_id',
        // 'student_id',
        // 'question_id',
        // 'answer_id',
        // 'answer',
        // 'remarks',
        // 'sen_data_config_id',
        // 'created_at',
        // 'created_by',
        // 'updated_at',
        // 'updated_by',
        $data = [];
        $i = 0;
        foreach ($request['data'] as $key => $qa) {
            // dd($qa);
            if (empty($qa['chk_val'])) {
                $ans_txt=$qa['default']['answer_id'];
                $ans_id = null;
                $answer = null;
                if (Str::contains($ans_txt, '__')) {
                    $arr = explode("__", $ans_txt, 2);
                    $ans_id = $arr[0];
                    $answer = $arr[1];
                }else{
                    $ans_id = $ans_txt;
                    $answer = $qa['default']['display_text'];
                }
                $data[$i]['id'] = $qa['default']['id'];
                $data[$i]['org_id'] = $qa['org_id'];
                $data[$i]['staff_id'] = $qa['staff_id'];
                $data[$i]['student_id'] = $qa['student_id'];
                $data[$i]['question_id'] = $qa['qu_id'];
                $data[$i]['answer_id'] = $ans_id;
                $data[$i]['answer'] =  $answer;
                $data[$i]['remarks'] = $qa['remarks'];
                $data[$i]['created_by'] = $this->userId();
                $data[$i]['updated_by'] = $this->userId();
                $i++;
            }
            foreach ($qa['chk_val'] as $k => $checkval) {
                // dd($checkval);
                $arr = explode("__", $checkval, 2);
                $data[$i]['id'] = $qa['default']['id'];
                $data[$i]['org_id'] = $qa['org_id'];
                $data[$i]['staff_id'] = $qa['staff_id'];
                $data[$i]['student_id'] = $qa['student_id'];
                $data[$i]['question_id'] = $qa['qu_id'];
                $data[$i]['answer_id'] = $arr[0];
                $data[$i]['answer'] =  $arr[1];
                $data[$i]['remarks'] = $qa['remarks'];
                $data[$i]['created_by'] = $this->userId();
                $data[$i]['updated_by'] = $this->userId();
                $i++;
            }
        }

        $q_answer = [
            'data'=> $data,
        ];
        // dd($q_answer);

        $response_data= $this->apiService->createData('emis/students/sen/savequestionnaire/', $q_answer);
        return $response_data;

    }


}
