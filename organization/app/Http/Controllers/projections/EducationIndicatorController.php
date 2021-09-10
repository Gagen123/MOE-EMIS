<?php

namespace App\Http\Controllers\projections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EducationIndicatorController extends Controller{
    
    use ApiResponser;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * Get the Org Class Ids of all schools based on parameters
     * the Level Params is either "Education level" or "School Level"
     */

    public function getOrgClassIds($class_data=""){
        //get the array from the url parameters
        parse_str($class_data, $data_parameters);

        $level_params = $data_parameters['level_params'];
        $dzo_id = $data_parameters['dzo_params'];

        if($level_params == 'education_level'){
            $class_params = $data_parameters['class_params'];

            if($dzo_id == "ALL"){            
                $org_class = DB::table('organization_class_streams')
                                ->join('classes','organization_class_streams.classId', '=', 'classes.id')
                                ->select('organization_class_streams.id AS id', 'classes.class')
                                ->whereIn('classes.class',$class_params)
                                ->get()
                                ->toArray();
            } else {
                $org_class = DB::table('organization_class_streams')
                                ->join('classes','organization_class_streams.classId', '=', 'classes.id')
                                ->join('organization_details','organization_class_streams.organizationId', '=', 'organization_details.id')
                                ->select('organization_class_streams.id AS id', 'classes.class')
                                ->whereIn('classes.class',$class_params)
                                ->where('organization_details.dzongkhagId','=', $dzo_id)
                                ->get()
                                ->toArray();
            }
        } else {
            $school_type = $data_parameters['school_type'];
            if($school_type == 'ECCD' || $school_type == 'ECR'){
                if($dzo_id == "ALL"){
                    $org_class = DB::table('organization_class_streams')
                                    ->join('classes','organization_class_streams.classId', '=', 'classes.id')
                                    ->join('organization_details','organization_class_streams.organizationId', '=', 'organization_details.id')
                                    ->select('organization_class_streams.id AS id', 'classes.class', 'organization_details.id as OrgId')
                                    ->where('organization_details.category','LIKE', '%'.$school_type.'%')
                                    ->get()
                                    ->toArray();
                } else {
                    $org_class = DB::table('organization_class_streams')
                                    ->join('classes','organization_class_streams.classId', '=', 'classes.id')
                                    ->join('organization_details','organization_class_streams.organizationId', '=', 'organization_details.id')
                                    ->select('organization_class_streams.id AS id', 'classes.class', 'organization_details.id as OrgId')
                                    ->where('organization_details.category','LIKE', '%'.$school_type.'%')
                                    ->where('organization_details.dzongkhagId','=', $dzo_id)
                                    ->get()
                                    ->toArray();
                }

            } else {
                if($dzo_id == "ALL"){
                    $org_class = DB::table('organization_class_streams')
                                    ->join('classes','organization_class_streams.classId', '=', 'classes.id')
                                    ->join('organization_details','organization_class_streams.organizationId', '=', 'organization_details.id')
                                    ->join('level','organization_details.levelId', '=', 'level.id')
                                    ->select('organization_class_streams.id AS id', 'level.name', 'classes.class', 'organization_details.id as OrgId')
                                    ->where('level.name','LIKE', $school_type.'%')
                                    ->orderBy('displayOrder', 'asc')
                                    ->get()
                                    ->toArray();
                } else {
                    $org_class = DB::table('organization_class_streams')
                                    ->join('classes','organization_class_streams.classId', '=', 'classes.id')
                                    ->join('organization_details','organization_class_streams.organizationId', '=', 'organization_details.id')
                                    ->join('level','organization_details.levelId', '=', 'level.id')
                                    ->select('organization_class_streams.id AS id', 'level.name', 'classes.class', 'organization_details.id as OrgId')
                                    ->where('level.name','LIKE', $school_type.'%')
                                    ->where('organization_details.dzongkhagId','=', $dzo_id)
                                    ->orderBy('displayOrder', 'asc')
                                    ->get()
                                    ->toArray();
                }
            }
        }

        $response_data = [];

        foreach($org_class as $class_data){
            $response_data[$class_data->class][] = $class_data->id;
        }

        return $this->successResponse($response_data);
    }

    /**
     * Get the Org Class Ids of all schools based on parameters
     * the Level Params is either "Education level" or "School Level"
     */

    public function getOrgIds($org_data=""){
        //get the array from the url parameters
        parse_str($org_data, $data_parameters);

        $school_type = $data_parameters['school_type'];
        $dzo_id = $data_parameters['dzo_params'];

        if($school_type == 'ECCD' || $school_type == 'ECR'){
            if($dzo_id == "ALL"){            
                $org_details = DB::table('organization_details')
                                ->select('id', 'category')
                                ->where('organization_details.category','LIKE', '%'.$school_type.'%')
                                ->get()
                                ->toArray();
            } else {
                $org_details = DB::table('organization_details')
                                ->select('id', 'category')
                                ->where('organization_details.category','LIKE', '%'.$school_type.'%')
                                ->where('organization_details.dzongkhagId','=', $dzo_id)
                                ->get()
                                ->toArray();
            }
        } else {
            if($dzo_id == "ALL"){         
                $org_details = DB::table('organization_details')
                                ->join('level','organization_details.levelId', '=', 'level.id')
                                ->select('organization_details.id', 'category')
                                ->where('level.name','LIKE', '%'.$school_type.'%')
                                ->get()
                                ->toArray();
            } else {
                $org_details = DB::table('organization_details')
                                ->join('level','organization_details.levelId', '=', 'level.id')
                                ->select('organization_details.id', 'category')
                                ->where('level.name','LIKE', '%'.$school_type.'%')
                                ->where('organization_details.dzongkhagId','=', $dzo_id)
                                ->get()
                                ->toArray();
            }
        }        

        $response_data = [];

        foreach($org_details as $temp_data){
            $response_data[$temp_data->category][] = $temp_data->id;
        }

        return $this->successResponse($response_data);
    }

}