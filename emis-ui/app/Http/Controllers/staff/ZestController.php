<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
class ZestController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function getAppointment($year=""){
        $person = json_decode($this->apiService->listData('getAppointment/'. $year));
        $data=$person->data->appointments->appointment;
        return  response()->json($data);
    }
    public function saveAppointmentDetails(Request $request){
        $request['user_id'] = $this->userId();
        $request['Year'] = $request->Year;
        $response_data= $this->apiService->createData('emis/staff/zest/saveAppointmentDetails', $request->all());
        return $response_data;
    }

    public function loadappointment(){
        $response_data= $this->apiService->listData('emis/staff/zest/loadappointment');
        return $response_data;
    }

    public function loadSeperation(){
        $response_data= $this->apiService->listData('emis/staff/zest/loadSeperation');
        return $response_data;
    }

    public function loadPromotion($param=""){
        $response_data= $this->apiService->listData('emis/staff/zest/loadPromotion/'.$param);
        return $response_data;
    }

    public function loadPromotionDetails($id=""){
        $response_data= $this->apiService->listData('emis/staff/zest/loadPromotionDetails/'.$id);
        return $response_data;
    }

}
