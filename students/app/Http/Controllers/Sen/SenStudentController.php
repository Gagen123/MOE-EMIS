<?php

namespace App\Http\Controllers\Sen;

use Throwable;
use App\Models\Sen\Answer;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Sen\DataConfig;
use App\Models\Students\Student;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SenStudentController extends Controller
{
    use ApiResponser;

    //GET SEN STUDENT LIST
    public function getSenStudentList(){
        $data = Student::select('id','Name','student_code','OrgOrganizationId')->where('isSenStudent',1)->get();
        return response()->json($data);
        // $records = DB::table('std_student')
        //             ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
        //             ->select('std_student.id AS id', 'std_student.Name', 'std_student.student_code', 'std_student_class_stream.OrgClassStreamId', 'std_student_class_stream.SectionDetailsId')
        //             ->where('isSenStudent',1)
        //             ->get();
        // return $records;
    }

    //GET SEN STUDENT LIST
    public function saveStudentQuestionnaire(Request $request){
        // dd($request['data']);

        try {
            $isM_id = DataConfig::select('id')->where('isactive', '1')->first();
            $c_id = $isM_id->id;
            foreach ($request['data'] as $key => $ans) {
                // dd($ans);
                $qans = [
                    'org_id' => $ans['org_id'],
                    'staff_id' => isset($ans['staff_id']) ? $ans['staff_id'] : null,
                    'student_id' => $ans['student_id'],
                    'question_id' => $ans['question_id'],
                    'answer_id' => $ans['answer_id'],
                    'answer' => $ans['answer'],
                    'remarks' => isset($ans['remarks']) ? $ans['remarks'] : null,
                    'sen_data_config_id' => $c_id,
                ];

                if (isset($ans['id'])) {
                    $answers = Answer::findOrFail($ans['id']);

                    $answers->fill($qans);
                    // dd($answers);
                    if (!$answers->isClean()) {
                        $answers['updated_by'] = $ans['updated_by'];
                        $answers->save();
                    }
                }else{
                    $qans['created_by'] = $ans['created_by']; 
                    Answer::create($qans);
                }
                // dd($qans);           
            }
            return response()->json(1); 
        } catch (\Throwable $th) {
            return $this->errorResponse("error", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }


}
