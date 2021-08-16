<?php

namespace App\Http\Controllers\StudentPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helper\EmisService;
use App\Traits\AuthUser;

/**
 * Controller for all academic related activities of the student
 */

class AcademicController extends Controller
{
    public $apiService;
    use AuthUser;
    
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
}
