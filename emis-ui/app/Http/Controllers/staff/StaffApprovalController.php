<?php

namespace App\Http\Controllers\staff;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffApprovalController extends Controller
{
    public $apiService;
    use ServiceHelper;
    public function __construct(EmisService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getpersonbycid($cid){
        $person = json_decode($this->apiService->listData('getcensusdata/'. $cid));
        if ($person->citizenDetailsResponse){
            $response_data = $person->citizenDetailsResponse;
            return  $response_data;
        }else {
            return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        }
    }
    public function savePrincipalApproval(Request $request){
        dd($request);
    }
}
