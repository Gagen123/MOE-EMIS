<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\question_answer\Module;
use App\Models\question_answer\Service;
use App\Models\question_answer\Category;
use App\Models\question_answer\Answer;

class QuestionAnswerController extends Controller{
    use ApiResponser;

    public $database="emis_system_admin";
    public $database_table="question_";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveQuestionaries(Request $request){
        if($request->record_type=="Question"){
            $this->database_table=$this->database_table.'details';
        }
        else{
            $this->database_table=$this->database_table.strtolower($request->record_type);
        }
        $rules =[
            'name'      =>  'required|string:',
            'status'    =>  'required',
        ];
        $customMessages = [
            'name.required'   => 'this field is required',
            'status.required' => 'this field is required'
        ];
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
        if($request->actiontype=="add" && $request->record_type!="CategoryType" && $request->record_type!="Question"){
            $rules=array_merge($rules,
                array('name'      =>  'unique:'.$this->database_table,
                    'code'      =>  'required|numeric|digits:4|unique:'.$this->database_table,)
            );
            $customMessages =array_merge($customMessages,
                array('name.unique'     => 'this field is already taken',
                    'code.required'   => 'this field is required',
                    'code.numeric'   => 'this field should be numeric.',
                    'code.digits'    => 'this field should be of 4 digits .',
                    'code.unique'     => 'this field is already taken',
                )
            );
        }
        $this->validate($request, $rules,$customMessages);
        $databaseModel=$request->record_type;
        $modelName = "App\\Models\\question_answer\\"."$databaseModel";
        $model = new $modelName();
        if($request->actiontype=="add"){
            $data =[
                'name'          =>  $request->name,
                'status'        =>  $request->status,
                'created_by'    =>  $request->user_id,
                'created_at'    =>  date('Y-m-d h:i:s'),
            ];
            if(strpos('Service_Category_CategoryType_Module_Question',$request->record_type)!==false){
                $data=$data+[
                    'module_id'      =>  $request->module_id,
                ];
                if($request->record_type!="CategoryType"){
                    $data=$data+[
                        'code'          =>  $request->code,
                    ];
                }
                if($request->record_type=="Service" || $request->record_type=="CategoryType"){
                    $data=$data+[
                        'type'              =>  $request->service_type,
                    ];
                }
                if($request->record_type=="Category"){
                    $data=$data+[
                        'service_id'              =>  $request->service_id,
                    ];
                }
            }
            if($request->record_type=="Question"){
                $data=array_merge($data,
                    array(
                    'service_id'            =>  $request->service_id,
                    'category_id'           =>  $request->category_id,
                    'category_type_id'      =>  $request->category_type_id,
                    'answer_type'           =>  $request->answer_type,)
                );
            }
            $response_data = $model::create($data);
        }
        if($request->actiontype=="edit"){
            $data = $model::find($request->id);
            //prepare data to save in audit
            $messs_det="";
            if($request->record_type=="Service" || $request->record_type=="Category" || $request->record_type=="CategoryType" || $request->record_type=="Question"){
                $messs_det.="module id:".$data->module_id;
            }
            if($request->record_type=="Question"){
                $messs_det.="answer_type id:".$data->answer_type;
            }
            $messs_det.='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            DB::select("CALL emis_audit_proc('".$this->database."','".$this->database_table."','".$request->id."','".$messs_det."','".$request->user_id."','Edit')");

            //replace the data by request data to update current detials
            $data->name             = $request->name;
            if($request->record_type=="Service" || $request->record_type=="Category" || $request->record_type=="CategoryType"){
                $data->module_id    =  $request->module_id;
                if($request->record_type=="Category"){
                    $data->service_id            =  $request->service_id;
                }
            }
            if($request->record_type=="Question"){
                $data->module_id            =  $request->module_id;
                $data->service_id           =  $request->service_id;
                $data->category_id          =  $request->category_id;
                $data->category_type_id     =  $request->category_type_id;
                $data->answer_type          =  $request->answer_type;
            }
            $data->status           = $request->status;
            if($request->record_type=="Service" || $request->record_type=="CategoryType"){
                $data->type           = $request->service_type;
            }
            $data->updated_by       = $request->user_id;
            $data->updated_at       = date('Y-m-d h:i:s');
            $data->update();
            return $this->successResponse($data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadQuestionaries($type=""){
        if(strpos($type, 'allData_')!==false){
            $databaseModel=explode("_",$type)[1];
            $modelName = "App\\Models\\question_answer\\"."$databaseModel";
            $model = new $modelName();
            return $this->successResponse($model::all());
        }
        if(strpos($type,"all_active_")!==false){
            $databaseModel=explode("_",$type)[2];
            $modelName = "App\\Models\\question_answer\\"."$databaseModel";
            $model = new $modelName();
            return $this->successResponse($model::where('status','1')->get());
        }
        if(strpos($type,"all_with_")!==false){
            $databaseModel=explode("_",$type)[3];
            $modelName = "App\\Models\\question_answer\\"."$databaseModel";
            $model = new $modelName();
            $response_data=$model::with(explode("_",$type)[2])->get();
            return $this->successResponse($response_data);
        }
        if(strpos($type,"all_2with_")!==false){ //all_2with_module_service_Category
            $databaseModel=explode("_",$type)[4];
            $modelName = "App\\Models\\question_answer\\"."$databaseModel";
            $model = new $modelName();
            $response_data=$model::with(explode("_",$type)[3],explode("_",$type)[2])->get();
            return $this->successResponse($response_data);
        }

        if(strpos($type,"byparentId_")!==false){ //byId_Service_moduleId
            $databaseModel=explode("_",$type)[1];
            $modelName = "App\\Models\\question_answer\\"."$databaseModel";
            $model = new $modelName();
            if($databaseModel=="Answer"){
                return $this->successResponse($model::where("parent_id",explode("_",$type)[2])->get());
            }
            else{
                return $this->successResponse($model::where("module_id",explode("_",$type)[2])->get());
            }
        }
        if(strpos($type,"loadQuestionDetails_")!==false){ //load question by id
            $modelName = "App\\Models\\question_answer\\Question";
            $model = new $modelName();
            return $this->successResponse($model::where("id",explode("_",$type)[1])->first());
        }
        if(strpos($type,"getquestionList_")!==false){ //load question by id
            $modelName = "App\\Models\\question_answer\\Question";
            $model = new $modelName();
            if(explode("_",$type)[1]=="category"){
                return $this->successResponse($model::where("category_id",explode("_",$type)[2])->get());
            }
            if(explode("_",$type)[1]=="categoryType"){
                return $this->successResponse($model::where("category_type_id",explode("_",$type)[2])->get());
            }
        }

        if(strpos($type,"actlistbyparent_")!==false){ //byId_Service_moduleId
            $databaseModel=explode("_",$type)[1];
            $modelName = "App\\Models\\question_answer\\"."$databaseModel";
            $model = new $modelName();
            $parant_id=explode("_",$type)[2];
            if($databaseModel=="Service"){
                return $this->successResponse($model::where("module_id",$parant_id)->where('status',1)->get());
            }
            else if($databaseModel=="Category"){
                return $this->successResponse($model::where("service_id",$parant_id)->where('status',1)->get());
            }
            else if($databaseModel=="CategoryType"){
                return $this->successResponse($model::where("module_id",$parant_id)->where('status',1)->get());
            }
            else{ //Service Module
                return $this->successResponse($model::where("parent_id",$parant_id)->where('status',1)->get());
            }
        }

        if(strpos($type,"washAndOthers_")!==false){
            $questionlist = DB::table('question_details as q')
                ->join('question_category as c', 'q.category_id', '=', 'c.id')
                ->select('q.name', 'q.id', 'q.answer_type')
                ->where('q.status', '=', 1)
                // ->where('c.name', '=', '%' . Input::get('name') . '%')
                ->where('c.name', 'LIKE',explode("_",$type)[1]. '%')
                ->groupby('q.id')->get();
            foreach($questionlist as $ques){
                $ques->ans_list=Answer::where('parent_id',$ques->id)->get();
            }
            return $this->successResponse($questionlist);
        }
        if(strpos($type,"getleadership_")!==false){
            $questionlist = DB::table('question_details as q')
                ->join('category_type as c', 'q.category_type_id', '=', 'c.id')
                ->join('question_service as s', 'q.service_id', '=', 's.id')
                ->select('q.name', 'q.id', 'q.answer_type')
                ->where('q.status', '=', 1)
                ->where('c.id',  explode("_",$type)[2])
                ->where('s.id', explode("_",$type)[1])
                ->groupby('q.id')->get();
            foreach($questionlist as $ques){
                $ques->ans_list=Answer::where('parent_id',$ques->id)->get();
            }
            return $this->successResponse($questionlist);
        }
        if(strpos($type,"loadServices_")!==false || strpos($type,"loadcategoryType_")!==false){ //services and categoy type by type
            $databaseModel=explode("_",$type)[2];
            $modelName = "App\\Models\\question_answer\\"."$databaseModel";
            $model = new $modelName();
            return $this->successResponse($model::where("type",explode("_",$type)[1])->get());
        }
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
        if($request->actiontype=="add"){
            $current_ans=Answer::where("parent_id",$request->question_field)->get();
            if(sizeof($current_ans)>0){
                $procid=DB::select("CALL emis_question_answers_audit_proc('".$request->question_field."','".$request->user_id."', 'add')");
                Answer::where('parent_id',$request->question_field)->delete();
            }
            foreach($request->answer as $data){
                $ans_data =[
                    'parent_id'          =>  $request->question_field,
                    'name'          =>  $data['name'],
                    'status'        =>  $data['status'],
                    'created_by'    =>  $request->user_id,
                    'created_at'    =>  date('Y-m-d h:i:s'),
                ];
                $response_data = Answer::create($ans_data);
            }
        }
        if($request->actiontype=="edit"){
            $data = $model::find($request->id);
            //prepare data to save in audit
            $messs_det="";
            if($request->record_type=="Service" || $request->record_type=="Category" || $request->record_type=="Question"){
                $messs_det.="parent id:".$data->parent_id;
            }
            if($request->record_type=="Question"){
                $messs_det.="answer_type id:".$data->answer_type;
            }
            $messs_det.='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL emis_audit_proc('".$this->database."','".$this->database_table."','".$request->id."','".$messs_det."','".$request->user_id."','Edit')");

            //replace the data by request data to update current detials
            $data->name             = $request->name;
            if($request->record_type=="Service" || $request->record_type=="Category"){
                $data->parent_id    =  $request->parent_field;
            }
            if($request->record_type=="Question"){
                $data->parent_id    =  $request->category;
                $data->answer_type  =  $request->answer_type;
            }
            $data->status           = $request->status;
            $data->updated_by       = $request->user_id;
            $data->updated_at       = date('Y-m-d h:i:s');
            $data->update();
            return $this->successResponse($data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function deleteAns($id="",$user_id=""){
        $current_ans=Answer::where("id",$id)->first();
        if($current_ans!=""){
            $procid=DB::select("CALL emis_question_answers_audit_proc('".$id."','".$user_id."', 'delete')");
            Answer::where('id',$id)->delete();
        }
    }
}
