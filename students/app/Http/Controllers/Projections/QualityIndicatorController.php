<?php

namespace App\Http\Controllers\Projections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;

class QualityIndicatorController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * Load the class size
    */

    public function loadClassSize(Request $request){
        $class_params = $request->class_params;
        $dzo_id = $request->dzo_params;
        
        $records = (object)[];

        foreach($class_params as $key => $class_name){
            foreach($class_name as $key2 => $class_data){
                $records->$key2 =$this->getStudentCountBySection($class_name[$key2]);
            }
        } 

        return $this->successResponse($records);
        
    }

    /**
     * Get the Student Count by section
     */

    private function getStudentCountBySection($class_section_id){
        $section_count = DB::table('std_student_class_stream')
                        ->whereIn('OrgClassStreamId', $class_section_id)
                        ->select('SectionDetailsId')
                        ->distinct('SectionDetailsId')
                        ->count('SectionDetailsId');

        $student_count = DB::table('std_student_class_stream')
                    ->join('std_student', 'std_student.id','=', 'std_student_class_stream.StdStudentId')
                    ->whereIn('OrgClassStreamId', $class_section_id)
                    ->count();

        return round($student_count/$section_count,1);
    }
}
