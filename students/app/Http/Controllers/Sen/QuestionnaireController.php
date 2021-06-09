<?php

namespace App\Http\Controllers\Sen;

use App\Http\Controllers\Controller;
use App\Models\Students\Student;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    use ApiResponser;

    //retrive questions
    public function getQuestionnaire($StudentId){
       
        $isM_id = DataMatrix::select('id')->where('isactive', '1')->first();
        
        $questions = Question_types::with(['question' => function ($query) use ($studentId, $isM_id) {
            $query->with('answeroption')->orderBy('display_order');
            $query->with(['questionanswer'=> function($q) use ($studentId, $isM_id){
                $q->where('matrix_id', '=', $isM_id->id)
                ->where('student_id', '=', $StudentId);
            }]);
        }])
        ->where('entity_type_id', '=', '3')
        ->get();

        return response()->json($questions);
    }
}
