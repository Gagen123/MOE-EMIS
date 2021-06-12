<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\CeaTraining;
use App\Models\Students\CeaTrainingParticipant;
use Exception;
use Mockery\Expectation;

class StudentTrainingController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveStudentTraining(Request $request){
        $rules = [
            'name'            => 'required',
            'training_type'   => 'required',
            'program'         => 'required',
            'place'           => 'required',
            'country'         => 'required',
            'from_date'       => 'required',
            'to_date'         => 'required'
        ];
        $customMessages = [
            'name.required'             => 'This field is required',
            'place.required'            => 'This field is required',
            'training_type.required'    => 'This field is required',
            'program.required'          => 'This field is required',
            'country.required'          => 'This field is required',
            'from_date.required'        => 'This field is required',
            'to_date.required'          => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'TrainingTypeName'              => $request->name,
            'place'             => $request->place,
            'CeaTrainingId'     => $request->training_type,
            'program_id'        => $request->program,
            'country'           => $request->country,
            'from_date'         => $request->from_date,
            'to_date'           => $request->to_date,
            'details'           => $request->details,
            'created_at'        => date('Y-m-d h:i:s'),
            'created_by'        => $request->user_id 
        ];
        $response_data = CeaTraining::create($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    

    /*
    * Function is to list Trainings for drop down
    */
    // public function listStudentTrainings($param="",$orgId){
    //     $response_data= $this->successResponse($this->studentservice->listData('students/listStudentTrainings/'.$param.'/'.$orgId));
    //     return $response_data;
    // }

    public function listStudentTrainings($param="",$orgId){
        // cea_student_training

        $records = DB::table('cea_training')
                ->join('cea_training_type', 'cea_training.CeaTrainingTypeId', '=', 'cea_training_type.id')
                ->join('cea_programme', 'cea_training.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_training.*', 'cea_training_type.name AS training_type', 'cea_programme.name AS program_name')
                ->get();

        return $this->successResponse($records);
        
    }

    /*
    * Save Training Members
    */

    public function saveTrainingParticipants(Request $request){

        $rules = [
            'student'            => 'required',
            'program'            => 'required',
        ];

        $customMessages = [
            'student.required'  => 'This field is required',
            'program.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
     
        $data =[
            'StdStudentId'          => $request->student,
            'CeaStudentTrainingId'  => $request->program,
            'Remarks'               =>$request->remarks
            // 'organization_id'  => $request['organization_id'],
            // 'user_id'        => $request['user_id']
        ];
      try{ 
          $response_data = CeaTrainingParticipant::create($data);
       } catch(Exception $e){
          dd($e);
      }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}
