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

    public function loadEnrollment($type="", $dzo_id=""){
        
        $response_data= $this->apiService->getListData('emis/projections/education/loadEnrollment/'.$type.'/'.$dzo_id);

        return $response_data;
    }

    /**
     * Load the Education Indicator (Enrollment) by Age (i.e. Right Age, Over Age, Under Age)
     * $type is the whether ECCD, Pre-Primary etc
     * $dzo_id also contains ALL for consolidated for all dzongkhags
     */

    public function loadEnrollmentByAge($type="", $dzo_id=""){
        
        $response_data= $this->apiService->getListData('emis/projections/education/loadEnrollmentByAge/'.$type.'/'.$dzo_id);

        return $response_data;
    }

    /**
     * Load the total number of teachers/facilitators
     */

    public function loadTeacherNumbers($type="", $dzo_id=""){
        $response_data= $this->apiService->getListData('emis/projections/education/loadTeacherNumbers/'.$type.'/'.$dzo_id);

        return $response_data;
    }

    /**
     * Load the total teachers by Nationality
     */

    public function loadTeacherNationality($type="", $dzo_id=""){
        $response_data= $this->apiService->getListData('emis/projections/education/loadTeacherNationality/'.$type.'/'.$dzo_id);

        return $response_data;
    }
    
}
