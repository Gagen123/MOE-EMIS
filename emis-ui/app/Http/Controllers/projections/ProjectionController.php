<?php

namespace App\Http\Controllers\projections;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;

class ProjectionController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function loadEccdChildren($type="",$dzo_id=""){
        $orgclassStream=[];
        if($type=="ALL" && $dzo_id=="ALL"){
            $orgclassStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/ECCD/'.$type.'/'.$dzo_id);
        }
        $param = http_build_query(json_decode($orgclassStream)->data);
        // dd($param);
        $orgclassStream= $this->apiService->getListData('emis/common_services/loadStudents/ECCD/'.$param);
        return $orgclassStream;
    }
}
