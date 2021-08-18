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
        $query = "SELECT COUNT(CASE WHEN s.CmnSexId='".$male."' THEN 1 END) malecount,COUNT(CASE WHEN s.CmnSexId='".$female."' THEN 1 END) femalecount,COUNT(*) totalstd,";
        if($type=="ECCD"){
            $query =$query ."
            COUNT(CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<3) THEN 1 END) lessthen3,
            COUNT(CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<3 AND s.CmnSexId='".$male."') THEN 1 END) lessthen3male,
            COUNT(CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<3 AND s.CmnSexId='".$female."') THEN 1 END) lessthen3female,
            COUNT((CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>=3 AND FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<=5) THEN 1 END)) rightage,
            COUNT((CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>=3 AND FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<=5 AND s.CmnSexId='".$male."') THEN 1 END)) rightagemale,
            COUNT((CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>=3 AND FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<=5 AND s.CmnSexId='".$female."') THEN 1 END)) rightagefemale,
            COUNT(CASE WHEN FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>5 THEN 1 END) above,
            COUNT(CASE WHEN FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>5 AND s.CmnSexId='".$male."' THEN 1 END) abovemale,
            COUNT(CASE WHEN FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>5 AND s.CmnSexId='".$female."' THEN 1 END) abovefemale";
        }
        if($type=="School"){
            $query =$query ."
            COUNT(CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<5) THEN 1 END) lessthen3,
            COUNT(CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<5 AND s.CmnSexId='".$male."') THEN 1 END) lessthenmale,
            COUNT(CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<5 AND s.CmnSexId='".$female."') THEN 1 END) lessthenfemale,
            COUNT((CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>=5 AND FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<=16) THEN 1 END)) rightage,
            COUNT((CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>=5 AND FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<=16 AND s.CmnSexId='".$male."') THEN 1 END)) rightagemale,
            COUNT((CASE WHEN(FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>=5 AND FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)<=16 AND s.CmnSexId='".$female."') THEN 1 END)) rightagefemale,
            COUNT(CASE WHEN FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>16 THEN 1 END) above,
            COUNT(CASE WHEN FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>16 AND s.CmnSexId='".$male."' THEN 1 END) abovemale,
            COUNT(CASE WHEN FLOOR(DATEDIFF(CURRENT_DATE,s.DateOfBirth) / 365.25)>16 AND s.CmnSexId='".$female."' THEN 1 END) abovefemale";
        }
        $query =$query ." FROM std_student s JOIN std_student_class_stream c ON s.id=c.StdStudentId
        WHERE c.OrgClassStreamId IN (".rtrim($orgclas,', ').")";
        $records=DB::select($query);
        return $records;
    }

}
