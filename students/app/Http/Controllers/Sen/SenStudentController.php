<?php

namespace App\Http\Controllers\Sen;

use App\Http\Controllers\Controller;
use App\Models\Students\Student;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

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


}
