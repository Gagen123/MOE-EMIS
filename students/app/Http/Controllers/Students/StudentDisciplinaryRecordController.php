<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\DisciplinaryRecord;
use App\Models\Students\Student;

class StudentDisciplinaryRecordController extends Controller
{
    //
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update student awards
    */
    public function addStudentRecord(Request $request){
        $id = $request->id;
        $student = $request->student;
        if( $id != null && $student != null){
            $rules = [
                'student'               => 'required',
                'offence_type'          => 'required',
                'date'                  => 'required',
                'severity'              => 'required',
                'action_taken'          => 'required',
                'offence_description'   => 'required',
                'remarks'               => 'required',
            ];
            $customMessages = [
                'student.required'                      => 'This field is required',
                'offence_type.required'                 => 'This field is required',
                'date.required'                         => 'This field is required',
                'severity.required'                     => 'This field is required',
                'action_taken.required'                 => 'This field is required',
                'offence_description.required'          => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);
            $data =[
                //   'id'                            => $request->id,
                   'OrgOrganizationId'             => $request->working_agency_id,
                   'StdStudentId'                  => $request->student,
                   'StdDisciplinaryOffenceTypeId'  => $request->offence_type,
                   'StdDisciplinarySeverityId'     => $request->severity,
                   'OffenceDate'                   => $request->date,
                   'OffenceDescription'            => $request->offence_description,
                   'StdDisciplinaryActionTypeId'   => $request->action_taken,
                   'ActionDescription'             => $request->remarks
       
                   //'user_id'           => $this->user_id() 
               ];
               $response_data = DisciplinaryRecord::where('id', $id)->update($data);
           }else{
            $rules = [
                'student'               => 'required',
                'offence_type'          => 'required',
                'date'                  => 'required',
                'severity'              => 'required',
                'action_taken'          => 'required',
                'offence_description'   => 'required',
                'remarks'               => 'required',
            ];
            $customMessages = [
                'student.required'                      => 'This field is required',
                'offence_type.required'                 => 'This field is required',
                'date.required'                         => 'This field is required',
                'severity.required'                     => 'This field is required',
                'action_taken.required'                 => 'This field is required',
                'offence_description.required'          => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);
            $data =[
                'id'                            => $request->id,
                'OrgOrganizationId'             => $request->working_agency_id,
                'StdStudentId'                  => $request->student,
                'StdDisciplinaryOffenceTypeId'  => $request->offence_type,
                'StdDisciplinarySeverityId'     => $request->severity,
                'OffenceDate'                   => $request->date,
                'OffenceDescription'            => $request->offence_description,
                'StdDisciplinaryActionTypeId'   => $request->action_taken,
                'ActionDescription'             => $request->remarks
    
                //'user_id'           => $this->user_id() 
            ];
            $response_data = DisciplinaryRecord::create($data);

        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);  
    }
    public function loadStudentRecords($param=""){
        parse_str($param, $class_details);

        $records = DB::table('std_student_disciplinary')
                ->join('std_student', 'std_student_disciplinary.StdStudentId', '=', 'std_student.id')
                ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId') 
                ->join('std_disciplinary_action_type', 'std_student_disciplinary.StdDisciplinaryActionTypeId', '=', 'std_disciplinary_action_type.id')
                ->join('std_disciplinary_offence_type', 'std_student_disciplinary.StdDisciplinaryOffenceTypeId', '=', 'std_disciplinary_offence_type.id')
                ->join('std_disciplinary_severity', 'std_student_disciplinary.StdDisciplinarySeverityId', '=', 'std_disciplinary_severity.id')
                ->select('std_student_disciplinary.*', 'std_student.Name','std_disciplinary_action_type.name AS action_type', 
                            'std_disciplinary_offence_type.name AS offence_type', 'std_disciplinary_severity.name AS severity')
                ->whereIn('std_student_class_stream.OrgClassStreamId',$class_details['org_class_stream_id']) 
                ->whereIn('std_student_class_stream.SectionDetailsId',$class_details['section_id']) 
                ->get();
        
        return $this->successResponse($records);

    }

    /**
     * Function to insert data into the respective tables
     */

    private function updateData($dataRequest, $databaseModel){

        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();

        $data = $model::find($dataRequest['id']);

        //Audit Trails
        // $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
        // $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','master_working_agency','".$request['id']."','".$msg_det."','".$request->input('user_id')."','Edit')");
        
        //data to be updated
        $data->name = $dataRequest['name'];
        $data->description = $dataRequest['description'];
        $data->status = $dataRequest['status'];
        $data->updated_by = $dataRequest['created_by'];
        $data->updated_at = date('Y-m-d h:i:s');
        $data->update();
        
        return $data;

    }   

}   

