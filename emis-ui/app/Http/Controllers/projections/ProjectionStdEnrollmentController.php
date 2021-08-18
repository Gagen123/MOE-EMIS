<?php

namespace App\Http\Controllers\projections;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;
class ProjectionStdEnrollmentController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
}
