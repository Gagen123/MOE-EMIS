<?php

namespace App\Http\Controllers\projections;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;

class QualityIndicatorController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    /**
    * Load the Quality Indicator (Class Size)
    * $type is the whether ECCD, Pre-Primary etc
    * $dzo_id also contains ALL for consolidated for all dzongkhags
    */

   public function loadClassSize($type="", $dzo_id=""){
       
       $response_data= $this->apiService->getListData('emis/projections/quality/loadClassSize/'.$type.'/'.$dzo_id);

       return $response_data;
   }
}
