<?php

namespace App\Http\Controllers\projections;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Helper\EmisService;
use App\Traits\AuthUser;
use Illuminate\Http\Request;
use App\Traits\ServiceHelper;

class OrgProjectionController extends Controller
{
    //
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function loadOrgListProjection($type="",$id=""){
        $param="";
       
        if($type=="eccd"){
            $param=$id;
        }
        if($type=="School"){
            $param=$id;
        }
        if($type=="ECR"){
            $param=$id;
        }
        if($type=="tertiary"){
            $param=$id;
        }
        if($type=="SEN"){
            $param=$id;
        }
        // dd('emis/common_services/loadOrgList/'.$type.'/'.$param);
        return $this->apiService->getListData('emis/common_services/loadOrgList/'.$type.'/'.$param);
    }


}
