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
        
        if($request->action_type=="add"){
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
        if($request->record_type=="Service" || $request->record_type=="Category" || $request->record_type=="Question"){
            $rules=array_merge($rules,
                array('parent_field'      =>  'required',)
            );
            $customMessages =array_merge($customMessages,
                array( 'parent_field.required'  => 'this field is required',)
            );
        }
        if($request->record_type=="Category" || $request->record_type=="Question"){
            $rules=array_merge($rules,
                array('grant_parent_field'      =>  'required',)
            );
            $customMessages =array_merge($customMessages,
                array( 'grant_parent_field.required'  => 'this field is required',)
            );
        }
        if($request->record_type=="Question"){
            $rules=array_merge($rules,
                array('category'        =>  'required',
                'answer_type'           =>  'required',)
            );
            $customMessages =array_merge($customMessages,
                array( 'category.required'  => 'this field is required',
                'answer_type.required'      => 'this field is required',)
            );
        }
        
        $this->validate($request, $rules,$customMessages);
        $data =[ 
            'name'                      =>  $request['name'],
            'grant_parent_field'        =>  $request['grant_parent_field'],
            'parent_field'              =>  $request['parent_field'],
            'category'                  =>  $request['category'],
            'answer_type'               =>  $request['answer_type'],
            'code'                      =>  $request['code'],
            'status'                    =>  $request['status'],
            'actiontype'                =>  $request['action_type'],
            'record_type'               =>  $request['record_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/questionAnswers/saveQuestionaries', $data);
        return $response_data;
    }

    public function loadQuestionaries($type=""){
        $response_data = $this->apiService->listData('emis/questionAnswers/loadQuestionaries/'.$type);
        return $response_data;
    }
    
    public function saveAnswers(Request $request){
        $rules = [
            'grant_parent_field'        =>  'required',
            'parent_field'              =>  'required',
            'category'                  =>  'required',
            'question_field'            =>  'required',
        ];
        $customMessages = [
            'grant_parent_field.required'   => 'this field is required',
            'parent_field.required'         => 'this field is required',
            'category.required'             => 'this field is required',
            'question_field.required'       => 'this field is required',
        ];
        
        $this->validate($request, $rules,$customMessages);
        $data =[ 
            'grant_parent_field'        =>  $request['grant_parent_field'],
            'parent_field'              =>  $request['parent_field'],
            'category'                  =>  $request['category'],
            'question_field'            =>  $request['question_field'],
            'answer'                    =>  $request['answer'],
            'id'                        =>  $request['id'],
            'actiontype'                =>  $request['action_type'],
            'user_id'                   =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/questionAnswers/saveAnswers', $data);
        return $response_data;
    }
    
    public function deleteAns($id=""){
        $response_data = $this->apiService->deleteData('emis/questionAnswers/deleteAns/'.$id,$this->userId());
        return $response_data;
    }
    
}
