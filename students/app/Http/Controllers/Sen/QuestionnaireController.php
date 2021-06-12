<?php

namespace App\Http\Controllers\Sen;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\Sen\DataConfig;
use App\Models\Students\Student;
use App\Models\Sen\QuestionTypes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuestionnaireController extends Controller
{
    use ApiResponser;

    //retrive questions
    public function getQuestionnaire($StudentId){
       
        $isM_id = DataConfig::select('id')->where('isactive', '1')->first();
        // dd($isM_id);
        $questions = QuestionTypes::with(['questions' => function ($query) use ($StudentId, $isM_id) {
            $query->with('answerOptions')->orderBy('display_order');
            $query->with(['questionAnswers'=> function($q) use ($StudentId, $isM_id){
                $q->where('sen_data_config_id', '=', $isM_id->id)
                ->where('student_id', '=', $StudentId);
            }]);
        }])
        ->where('entity_type_id', '=', '3')
        ->get();

        return response()->json($questions);
    }
}
