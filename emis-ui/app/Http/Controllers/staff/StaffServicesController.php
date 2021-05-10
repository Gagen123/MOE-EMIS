<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
class StaffServicesController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStaffAward(Request $request){
        $rules = [
            'staff'             =>  'required',
            'award_given_by'    =>  'required',
            'award_type_id'     =>  'required',
            'place'             =>  'required',
            'date'              =>  'required',
        ];
        $customMessages = [
            'staff.required'            => 'This field is required',
            'award_given_by.required'   => 'This field is required',
            'award_type_id.required'    => 'This field is required',
            'date.required'             => 'This field is required',
            'place.required'            => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $staff_data =[
            'staff'                      =>  $request->staff,
            'award_given_by'             =>  $request->award_given_by,
            'award_type_id'              =>  $request->award_type_id,
            'date'                       =>  $request->date,
            'place'                      =>  $request->place,
            'remarks'                    =>  $request->remarks,
            'coursetitle'                =>  $request->coursetitle,
            'action_type'                =>  $request->action_type,
            'user_id'                    =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/staffAward/saveStaffAward', $staff_data);
        return $response_data;
    }
}
