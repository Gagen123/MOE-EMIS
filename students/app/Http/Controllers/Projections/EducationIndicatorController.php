<?php

namespace App\Http\Controllers\Projections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;

class EducationIndicatorController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * To Load the enrollment
     * 
     * Post used as the data sent is big
    */

    public function loadEnrollment(Request $request){
        $gender_data = $request->gender;
        $gender = $this->genderArray($gender_data);
        $classes = $request->classes;
        $class_params = $request->class_params;
        $dzo_id = $request->dzo_params;

        $records = (object)[];

        foreach($classes as $key => $class_name){
            foreach($class_params as $key2 => $class_data){
                $records->$class_name['male'] = DB::table('std_student_class_stream')
                                                ->join('std_student', 'std_student.id','=', 'std_student_class_stream.StdStudentId')
                                                ->whereIn('OrgClassStreamId', $class_data[$class_name])
                                                ->where('CmnSexId', $gender['Male'])
                                                ->count();
                $records->$class_name['female'] = DB::table('std_student_class_stream')
                                                ->join('std_student', 'std_student.id','=', 'std_student_class_stream.StdStudentId')
                                                ->whereIn('OrgClassStreamId', $class_data[$class_name])
                                                ->where('CmnSexId', $gender['Female'])
                                                ->count();
            }
        }        

        return $this->successResponse($records);
        
    }

    /**
     * Load the Enrollment by Age
     */

    public function loadEnrollmentByAge(Request $request){
        
        $class_age = $request->class_age;
        $class_params = $request->class_params;
        $dzo_id = $request->dzo_params;

        $records = (object)[];

        foreach($class_age as $age => $class_name){
            foreach($class_params as $key2 => $class_data){
                $records->$class_name['right_age'] = $this->getStudentCountByAge($age, $class_data[$class_name], 'right');
                $records->$class_name['over_age'] = $this->getStudentCountByAge($age, $class_data[$class_name], 'over');
                $records->$class_name['under_age'] = $this->getStudentCountByAge($age, $class_data[$class_name], 'under');
                $records->$class_name['total'] = DB::table('std_student_class_stream')
                                                ->join('std_student', 'std_student.id','=', 'std_student_class_stream.StdStudentId')
                                                ->whereIn('OrgClassStreamId', $class_data[$class_name])
                                                ->count('std_student_class_stream.id');
            }
        }        

        return $this->successResponse($records);
        
    }

    /**
     * Function to get count of students by age
     */

    private function getStudentCountByAge($age, $org_class_ids, $condition){
        $date_of_admission = '2021-02-05';
        $lower_days = $age * 365;
        $upper_days = ($age+1)*365;
        $sql_statement = '';

        if($condition == 'right'){
            $sql_statement = "DATEDIFF('".$date_of_admission."', std_student.DateOfBirth) BETWEEN $lower_days AND $upper_days";
        } else if($condition == 'over'){
            $sql_statement = "DATEDIFF('".$date_of_admission."', std_student.DateOfBirth) > $upper_days";
        } else {
            $sql_statement = "DATEDIFF('".$date_of_admission."', std_student.DateOfBirth) < $lower_days ";
        }
        
        $student_count = DB::table('std_student_class_stream')
                            ->join('std_student', 'std_student.id','=', 'std_student_class_stream.StdStudentId')
                            ->whereRaw($sql_statement)
                            ->whereIn('OrgClassStreamId', $org_class_ids)
                            ->count('std_student_class_stream.id');

        return $student_count;
    }

    /**
     * Function to flatten arrays
     */

    private function flatten(array $array) {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }

    /**
     * Function to clean the gender data
     */

    private function genderArray($gender_data){
        $gender = [];
        foreach($gender_data as $key => $value){
            foreach($value as $key2 => $value2){
                $gender[$value2['name']] = $value2['id'];
            }
        }
        return $gender;
    }
}
