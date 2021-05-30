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
        return $this->successResponse(Student::where('OrgOrganizationId',$id)->take(10)
                            ->get(['id', 'Name', 'student_code']));
    }

    /**
     * Get the student list by stream and section (id, name, student code, class, section, stream)
     */

    public function loadStudentBySection($param1){
        $id = $param1;
        
        return $this->successResponse(Student::where('OrgOrganizationId',$id)->take(10)
                            ->get(['id', 'Name', 'DateOfBirth']));
    }
    public function getStudents($org_id,Request $request){
        $query = "SELECT t1.org_id, t2.id AS std_student_id, t2.Name, t2.CidNo, t1.org_class_id, t1.org_stream_id, t1.org_section_id
                FROM std_class_detils t1 
                LEFT JOIN std_student t2 ON t1.student_id = t2.id WHERE t1.org_id = ? AND t1.org_class_id = ?";
        $params = [$org_id,$request->classId];


        if($request->streamId){
            $query .= ' AND t1.org_stream_id = ?';
            array_push($params,$request->streamId);
        }
        if($request->sectionId){
            $query .= ' AND t1.org_section_id = ?';
            array_push($params,$request->sectionId);
        }
      
        return $this->successResponse (DB::select($query,$params)); 
       
        
        
    }
    
}
