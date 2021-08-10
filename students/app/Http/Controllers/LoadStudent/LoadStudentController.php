<?php

namespace App\Http\Controllers\LoadStudent;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoadStudentController extends Controller{
    use ApiResponser;
    public $database="student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function loadStudents($type="",$param=""){
        parse_str($param,$orgclassids);
        if($type=="ECCD"){
            $records = DB::table('std_student')
            ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId')
            ->select('std_student.id AS id', 'std_student.Name', 'std_student.student_code', 'std_student.DateOfBirth',
            'std_student.CmnSexId', 'std_student_class_stream.OrgClassStreamId', 'std_student_class_stream.SectionDetailsId')
            ->whereIn('std_student_class_stream.OrgClassStreamId',$orgclassids)
            ->get();
            return $records;
        }

    }

}
