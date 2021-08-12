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
        $male='353db3f5-1b97-406b-88ba-a68dbe53b2aa';
        $female='86164859-5be8-4ac8-8b40-7616d222229e';
        $orgclas="";
        foreach($orgclassids as $cls){
            $orgclas.="'".$cls['id']."', ";
        }
        //Need to change mcnsecid as master as and when change in master data
        $query = "SELECT COUNT(CASE WHEN s.CmnSexId='".$male."' THEN 1 END) malecount,
        COUNT(CASE WHEN s.CmnSexId='".$female."' THEN 1 END) femalecount,COUNT(*) totalstd
        FROM std_student s JOIN std_student_class_stream c ON s.id=c.StdStudentId
        WHERE c.OrgClassStreamId IN (".rtrim($orgclas,', ').")";
        $records=DB::select($query);
        return $records;

    }

}
