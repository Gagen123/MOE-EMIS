<?php

namespace App\Http\Controllers\question_answer;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;
use Illuminate\Http\Request;
class QuestionAnswerController extends Controller{

    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveQuestionaries(Request $request){
        $rules = [
            'name'          =>  'required',
            'status'        =>  'required',
        ];
        $customMessages = [
            'name.required'  => 'this field is required',
            'status.required'  => 'this field is required'
        ];

        if($request->action_type=="add" && $request->record_type!="CategoryType" && $request->record_type!="Question"){
            $rules=array_merge($rules,
                array('code'      =>  'required|numeric|digits:4',)
            );
            $customMessages =array_merge($customMessages,
                array( 'code.required'  => 'this field is required',
                'code.numeric'   => 'this field should be numeric.',
                'code.digits'    => 'this field should be of 4 digits .',
                )
            );
        }
        if($request->record_type=="Service" || $request->record_type=="Category" || $request->record_type=="CategoryType"
        || $request->record_type=="Question"){
            $rules=array_merge($rules,
                array('module_id'      =>  'required',)
            );
            $customMessages =array_merge($customMessages,
                array( 'module_id.required'  => 'this field is required',)
            );
        }
        if($request->record_type=="Category" || $request->record_type=="Question"){
            $rules=array_merge($rules,
                array('service_id'      =>  'required',)
            );
            $customMessages =array_merge($customMessages,
                array( 'service_id.required'  => 'this field is required',)
            );
        }
        if($request->record_type=="Question"){
            $rules=array_merge($rules,
                array(
                'answer_type'           =>  'required',)
            );
            $customMessages =array_merge($customMessages,
                array(
                'answer_type.required'      => 'this field is required',)
            );
        }

        //$this->validate($request, $rules,$customMessages);
        $data =[
            'module_id'                 =>  $request->module_id,
            'service_id'                =>  $request->service_id,
            'category_id'               =>  $request->category_id,
            'category_type_id'          =>  $request->category_type_id,
            'answer_type'               =>  $request->answer_type,
            'name'                      =>  $request['name'],
            'answer_type'               =>  $request['answer_type'],
            'code'                      =>  $request['code'],
            'status'                    =>  $request['status'],
            'actiontype'                =>  $request['action_type'],
            'record_type'               =>  $request['record_type'],
            'service_type'              =>  $request['service_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];
        // dd($data);
        $response_data= $this->apiService->createData('emis/questionAnswerController/saveQuestionaries', $data);
        return $response_data;
    }

    public function loadQuestionaries($type=""){
        $response_data = $this->apiService->listData('emis/questionAnswerController/loadQuestionaries/'.$type);
        return $response_data;
    }

    public function saveAnswers(Request $request){
        $rules = [
            'module_id'        =>  'required',
            'service_id'              =>  'required',
            'question_field'            =>  'required',
        ];
        $customMessages = [
            'module_id.required'   => 'this field is required',
            'service_id.required'         => 'this field is required',
            'question_field.required'       => 'this field is required',
        ];

        $this->validate($request, $rules,$customMessages);
        $data =[
            'module_id'                 =>  $request['module_id'],
            'service_id'                =>  $request['service_id'],
            'category'                  =>  $request['category'],
            'question_field'            =>  $request['question_field'],
            'answer'                    =>  $request['answer'],
            'id'                        =>  $request['id'],
            'actiontype'                =>  $request['action_type'],
            'user_id'                   =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/questionAnswerController/saveAnswers', $data);
        return $response_data;
    }

    public function deleteAns($id=""){
        $response_data = $this->apiService->deleteData('emis/questionAnswerController/deleteAns/'.$id,$this->userId());
        return $response_data;
    }

}
