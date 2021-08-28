<?php

namespace App\Http\Controllers\projections;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;

class EfficiencyIndicatorController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    /**
     * Load the Indicator Reports
     * $type is the whether BCSE or BHSEC
     */

    public function loadIndicatorResult($type=""){
        $response_data=[];

        $response_data= $this->apiService->getListData('emis/projections/bcsea/loadIndicatorResult/'.$type);

        return $response_data;
    }
}
