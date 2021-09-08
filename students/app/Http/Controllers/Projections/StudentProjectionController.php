<?php

namespace App\Http\Controllers\Projections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;

class BcseaController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update student awards
    */

    public function loadIndicatorResult($type=""){
        if($type == 'bcse'){
            $records = DB::table("bcsea_bcse")
                        ->select( DB::raw("COUNT(id) as total"))
                        ->where('year', date('Y'))
                        ->first();
            $records->male_pca = DB::table("bcsea_bcse")
                        ->select( DB::raw("COUNT(CASE WHEN std_sex = 'M' AND result = 'PCA' THEN 1 END) as male_pca"))
                        ->where('year', date('Y'))
                        ->first()->male_pca;
            $records->female_pca = DB::table("bcsea_bcse")
                        ->select( DB::raw("COUNT(CASE WHEN std_sex = 'F' AND result = 'PCA' THEN 1 END) as female_pca"))
                        ->where('year', date('Y'))
                        ->first()->female_pca;
            $records->male_pcna = DB::table("bcsea_bcse")
                        ->select( DB::raw("COUNT(CASE WHEN std_sex = 'M' AND result = 'PCNA' THEN 1 END) as male_pcna"))
                        ->where('year', date('Y'))
                        ->first()->male_pcna;
            $records->female_pcna=DB::table("bcsea_bcse")
                        ->select( DB::raw("COUNT(CASE WHEN std_sex = 'F' AND result = 'PCNA' THEN 1 END) as female_pcna"))
                        ->where('year', date('Y'))
                        ->first()->female_pcna;
            $records->total_male = DB::table("bcsea_bcse")
                        ->select( DB::raw("COUNT(CASE WHEN std_sex = 'M' THEN 1 END) as total_male"))
                        ->where('year', date('Y'))
                        ->first()->total_male;
            $records->total_female = DB::table("bcsea_bcse")
                        ->select( DB::raw("COUNT(CASE WHEN std_sex = 'F' THEN 1 END) as total_female"))
                        ->where('year', date('Y'))
                        ->first()->total_female;
        } else {
            $records = [];
        }

        return $this->successResponse($records);
        
    }
}
