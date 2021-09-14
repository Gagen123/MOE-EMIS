<?php

namespace App\Http\Controllers\staff;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\PersonalDetails;
use App\Models\staff_masters\PositionTitle;
use Illuminate\Support\Facades\DB;

class ProjectionIndicatorController extends Controller{

    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * Load the Teachers/Facilitators by Numbers
     */

    public function loadTeacherNumbers(Request $request){

        $gender_data = $request->gender;
        $gender = $this->genderArray($gender_data);
        $school_type = $request->school_type;
        $org_data = $request->org_data;
        $dzo_id = $request->dzo_params;

        $records = (object)[];

        $title= '';
        if($request->school_type == 'ECCD'){
            $title = 'Facilitator';
        } else {
            $title = 'Teacher';
        }

        foreach($org_data as $value){
            foreach($value as $key => $orgs){
                $records->$key['male'] = DB::table('stf_staff')
                                    ->join('master_stf_position_title', 'stf_staff.position_title_id','=', 'master_stf_position_title.id')
                                    ->whereIn('working_agency_id', $orgs)
                                    ->where('sex_id','LIKE', 'Male')
                                    ->where('master_stf_position_title.name','LIKE','%'.$title.'%')
                                    ->count('sex_id');
                                    
                $records->$key['female'] = DB::table('stf_staff')
                                    ->join('master_stf_position_title', 'stf_staff.position_title_id','=', 'master_stf_position_title.id')
                                    ->whereIn('working_agency_id', $orgs)
                                    ->where('sex_id','LIKE', 'Female')
                                    ->where('master_stf_position_title.name','LIKE','%'.$title.'%')
                                    ->count('sex_id');
            }
        } 

        return $this->successResponse($records);
        
    }

    /**
     * Load Teachers/Facilitators by Nationality
     */

    public function loadTeacherNationality(Request $request){
        $gender_data = $request->gender;
        $gender = $this->genderArray($gender_data);
        $school_type = $request->school_type;
        $org_data = $request->org_data;
        $dzo_id = $request->dzo_params;

        $records = (object)[];

        $title= '';
        if($request->school_type == 'ECCD'){
            $title = 'Facilitator';
        } else {
            $title = 'Teacher';
        }

        foreach($org_data as $value){
            foreach($value as $key => $orgs){
                $records->$key['bht_male'] = DB::table('stf_staff')
                                    ->join('master_stf_position_title', 'stf_staff.position_title_id','=', 'master_stf_position_title.id')
                                    ->whereIn('working_agency_id', $orgs)
                                    ->where('sex_id','LIKE', 'Male')
                                    ->where('country_id','LIKE', 'Bhutanese')
                                    ->where('master_stf_position_title.name','LIKE','%'.$title.'%')
                                    ->count('sex_id');
                                    
                $records->$key['bht_female'] = DB::table('stf_staff')
                                    ->join('master_stf_position_title', 'stf_staff.position_title_id','=', 'master_stf_position_title.id')
                                    ->whereIn('working_agency_id', $orgs)
                                    ->where('sex_id','LIKE', 'Female')
                                    ->where('country_id','LIKE', 'Bhutanese')
                                    ->where('master_stf_position_title.name','LIKE','%'.$title.'%')
                                    ->count('sex_id');

                $records->$key['non_bht_male'] = DB::table('stf_staff')
                                    ->join('master_stf_position_title', 'stf_staff.position_title_id','=', 'master_stf_position_title.id')
                                    ->whereIn('working_agency_id', $orgs)
                                    ->where('sex_id','LIKE', 'Male')
                                    ->where('country_id','NOT LIKE', 'Bhutanese')
                                    ->where('master_stf_position_title.name','LIKE','%'.$title.'%')
                                    ->count('sex_id');
                                    
                $records->$key['non_bht_female'] = DB::table('stf_staff')
                                    ->join('master_stf_position_title', 'stf_staff.position_title_id','=', 'master_stf_position_title.id')
                                    ->whereIn('working_agency_id', $orgs)
                                    ->where('sex_id','LIKE', 'Female')
                                    ->where('country_id','NOT LIKE', 'Bhutanese')
                                    ->where('master_stf_position_title.name','LIKE','%'.$title.'%')
                                    ->count('sex_id');
            }
        } 

        return $this->successResponse($records);
        
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

    /**
     * Function to flatten arrays
     */

    private function flatten(array $array) {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }

}
