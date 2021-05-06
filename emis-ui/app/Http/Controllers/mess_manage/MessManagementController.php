<?php

namespace App\Http\Controllers\mess_manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;

class MessManagementController extends Controller
{
    //
    use ServiceHelper; 
    use AuthUser; 
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function loadFoodReleaseList(){
        //return json_encode('from UI');
          $list = $this->apiService->listData('emis/mess_manage/foolrelease/loadFoodReleaseList');
          return $list;
    }

    public function saveFoodRelease(Request $request){
        //return $request
        $rules = [
            'date'                  =>  'required',
            'dzongkhag'             =>  'required',
            'school'                =>  'required',
            'quarter'               =>  'required',
        ];
        $customMessages = [
            'date.required'            => 'date is required',
            'dzongkhag.required'       => 'Dzongkhag is required',
            'school.required'          => 'School Name is required',
            'quarter.required'         => 'Quarter is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $foodrelease =[
            //'organizationId'           =>  $this->getWrkingAgencyId(),
            'date'                     =>  $request['date'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'school    '               =>  $request['school'],
            'quarter'                  =>  $request['quarter'],
            'id'                       =>  $request['id'],
            'users'                    =>  $request['users'],
            'user_id'                  =>  $this->userId()
        ];  
        try{
            $response_data= $this->apiService->createData('emis/mess_manage/foodreleas/saveFoodRelease', $foodrelease);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }


    //local Procurement

    public function saveLcoalProcurement(Request $request){
        $rules = [
            'date'       =>  'required',
            'item'       =>  'required',
            'quantity'   =>  'required',
            'unit'       =>  'required',
            'Amount'     =>  'required',
            'remark'     =>  'required',

        ];
        $customMessages = [
            'date.required'          => 'date is required',
            'item.required'          => 'item  is required',
            'quantity.required'      => 'quantity  is required',
            'unit.required'          => 'unit  is required',
            'Amount.required'        => 'Amount  is required',
            'remark.required'        => 'remark  is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $localprocure =[
            'date'          =>  $request['date'],
            'item'          =>  $request['item'],
            'quantity'      =>  $request['quantity'],
            'unit'          =>  $request['unit'],
            'Amount'        =>  $request['Amount'],
            'remark'        =>  $request['remark'],

        ];
        // dd($dis);
        try{
            $response_data= $this->apiService->createData('emis/mess_manage/localprocure/saveLocalProcurement', $dis);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadLocalProcurement(Request $request){
        $dis = $this->apiService->listData('emis/mess_manage/localprocure/loadLocalProcurement');
        return $dis;
    }

    // Stock Received 

    public function saveStockReceived(Request $request){
        $rules = [
            'date'          =>  'required',
            'quarter'       =>  'required',
            'item'          =>  'required',
            'quantity'      =>  'required',
            'unit'          =>  'required',
            'Amount'        =>  'required',
            'remark'        =>  'required',

        ];
        $customMessages = [
            'date.required'          => 'date is required',
            'quarter.required'       => 'quarter is required',
            'item.required'          => 'item  is required',
            'quantity.required'      => 'quantity  is required',
            'unit.required'          => 'unit  is required',
            'Amount.required'        => 'Amount  is required',
            'remark.required'        => 'remark  is required',



        ];
        $this->validate($request, $rules, $customMessages);
        $stockreceived =[
            'date'             =>  $request['date'],
            'quarter'          =>  $request['quarter'],
            'item'             =>  $request['item'],
            'quantity'         =>  $request['quantity'],
            'unit'             =>  $request['unit'],
            'Amount'           =>  $request['Amount'],
            'remark'           =>  $request['remark'],

        ];
        // dd($dis);
        try{
            $response_data= $this->apiService->createData('emis/mess_manage/stockreceived/saveStockReceived', $stockreceived);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadStockReceived(Request $request){
        $dis = $this->apiService->listData('emis/mess_manage/stockreceived/loadStockReceived');
        return $dis;
    }

   // Stock Issued
   public function saveStockIssued(Request $request){
    $rules = [
        'date'          =>  'required',
        'item'          =>  'required',
        'quantity'      =>  'required',
        'unit'          =>  'required',
        'Amount'        =>  'required',
        'remark'        =>  'required',

    ];
    $customMessages = [
        'date.required'          => 'date is required',
        'item.required'          => 'item  is required',
        'quantity.required'      => 'quantity  is required',
        'unit.required'          => 'unit  is required',
        'Amount.required'        => 'Amount  is required',
        'remark.required'        => 'remark  is required',



    ];
    $this->validate($request, $rules, $customMessages);
    $localprocure =[
        'date'             =>  $request['date'],
        'quarter'          =>  $request['quarter'],
        'item'             =>  $request['item'],
        'quantity'         =>  $request['quantity'],
        'unit'             =>  $request['unit'],
        'Amount'           =>  $request['Amount'],
        'remark'           =>  $request['remark'],

    ];
    // dd($dis);
    try{
        $response_data= $this->apiService->createData('emis/mess_manage/stockreceived/saveStockReceived', $dis);
        return $response_data;
    }
    catch(\GuzzleHttp\Exception\ClientException $e){
        return $e;
    }
}




}
