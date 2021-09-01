<?php

namespace App\Http\Controllers\projections;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;

class EducationIndicatorController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    /**
     * Load the Education Indicator (Enrollment)
     * $type is the whether ECCD, Pre-Primary etc
     * $dzo_id also contains ALL for consolidated for all dzongkhags
     */

    public function loadEnrollment($type="", $dzo_id){

        $classIds = $this->getClassIds($type);
        
        $response_data= $this->apiService->getListData('emis/projections/bcsea/loadIndicatorResult/'.$type);

        return $response_data;
    }

    /**
     * Private Function to get the Class Ids for various levels of education
     * 
     * Here we get all the OrgClassIds based on the level
     */

    private function getClassIds($level){
        if($level == "ECCD"){
            $class = ['Age 3', 'Age 4', 'Age 5'];
        } else if($level == 'PrePrimary'){
            $class = ['PP'];
        } else if($level == 'Primary'){
            $class = ['PP', 'I', 'II', 'III', 'IV', 'V', 'VI'];
        } else if($level == 'Lower'){
            $class = ['VII', 'VIII'];
        } else if($level == 'Middle'){
            $class = ['IX', 'X'];
        } else {
            $class = ['XI', 'XII'];
        }

        return json_decode($this->apiService->getListData('emis/projections/bcsea/loadIndicatorResult/'.$type));
    }
}
