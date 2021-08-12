<?php

namespace App\Http\Controllers\projections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\EmisService;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;

class TeacherProjectionController extends Controller
{
    //
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function loadProjectionStaffList($type="",$dzo_id=""){
        $response_data= $this->apiService->getListData('emis/students/ExternalDataImport/loadProjectionStaffList/'.$type.'/'.$dzo_id);
        return $response_data;

    }

}
