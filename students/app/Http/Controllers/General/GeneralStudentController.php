<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Traits\ApiResponser;
use App\Models\Masters\StudentAwards;
use App\Models\Students\Student;

class GeneralStudentController extends Controller
{
    //
    use ApiResponser;
    public $database="student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * Get the basic student list (id, name, student code)
     */

    public function loadStudentList($param=""){
        $id = $param;
        return $this->successResponse(Student::where('OrgOrganizationId',$id)->where('IsTransferred','0')
                            ->get(['id', 'Name', 'student_code']));
    }

    /**
     * Get the basic student list (id, name, student code, class, section, stream, sex)
     */

    public function loadBasicStudentList($param=""){
        $id = $param;
        $records = DB::table('std_student')
                    ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
                    ->select('std_student.id AS id', 'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId',
                            'std_student.CmnSexId', 'std_student_class_stream.OrgClassStreamId', 'std_student_class_stream.SectionDetailsId')
                    ->where('std_student.OrgOrganizationId', $id)
                    ->where('IsTransferred','0')
                    ->get();
        return $records;
    }

    /**
     * Get the student list by stream and section (id, name, student code, class, section, stream)
     */

    public function loadStudentBySection($param1){
        $id = $param1;
        $class_details = explode('__', $id);
        
        $records = DB::table('std_student')
                    ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
                    ->select('std_student.id AS id', 'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->where('std_student_class_stream.OrgClassStreamId',$class_details[0])
                    ->where('std_student_class_stream.SectionDetailsId',$class_details[2])
                    ->get();
        return $records;
    }

    /**
     * load the student by class
     */

    public function loadStudentByClass($class){
        $id = $class;
        
        $records = DB::table('std_student')
                    ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
                    ->select('std_student.id AS id', 'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth', 'std_student.CmnSexId')
                    ->where('std_student_class_stream.OrgClassStreamId',$class)
                    ->get();
        return $records;
    }

    public function getStudents($org_id,Request $request){
        $query = "SELECT t1.OrgOrganizationId AS org_id, t1.id AS std_student_id, t1.Name, t1.CidNo, t2.OrgClassStreamId, t2.SectionDetailsId
        FROM std_student t1 
        LEFT JOIN std_student_class_stream t2 ON t1.id = t2.StdStudentId WHERE t1.OrgOrganizationId = ? AND t2.OrgClassStreamId = ?";
        $params = [$org_id,$request->OrgClassStreamId];

        if($request->sectionId){
            $query .= ' AND t2.SectionDetailsId = ?';
            array_push($params,$request->sectionId);
        }
  
        return $this->successResponse (DB::select($query,$params)); 
    }
    
}
