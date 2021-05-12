<?php

namespace App\Http\Controllers\mess_manage;

//use Session;
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
          $list = $this->apiService->listData('emis/messManagement/loadFoodReleaseList');
          return $list;
    }

    public function getFoodReleaseItem($foodreleaseId=''){
        $list = $this->apiService->listData('emis/messManagement/getFoodReleaseItem/'.$foodreleaseId);
        return $list;
    }
    public function saveFoodRelease(Request $request){
        //return $request
        $rules = [
            'dateOfrelease'         =>  'required',
            'dzongkhag'             =>  'required',
            'school'                =>  'required',
            'quarter'               =>  'required',
        ];
        $customMessages = [
            'dateOfrelease.required'   => 'dateOfrelease is required',
            'dzongkhag.required'       => 'Dzongkhag is required',
            'school.required'          => 'School  is required',
            'quarter.required'         => 'Quarter is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $foodrelease =[
            //'organizationId'           =>  $this->getWrkingAgencyId(),
            'dateOfrelease'            =>  $request['dateOfrelease'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'school'                   =>  $request['school'],
            'quarter'                  =>  $request['quarter'],
            'id'                       =>  $request['id'],
            'items_released'           =>  $request->items_released,
            'user_id'                  =>  $this->userId()
        ];  
        // dd($foodrelease);
        try{
            $response_data= $this->apiService->createData('emis/messManagement/saveFoodRelease', $foodrelease);
            //dd($response_data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }


    //local Procurement

    public function loadLocalProcure(){
     //return json_encode('from UI');  
        $list = $this->apiService->listData('emis/messManagement/loadLocalProcure');
        return $list;
    }

    public function saveLocalProcure(Request $request){
        //return $request
        $rules = [
            'dateOfprocure'       =>  'required',

        ];
        $customMessages = [
            'dateOfprocure.required'          => 'dateOfprocure is required',
          
        ];
        $this->validate($request, $rules, $customMessages);
        $localprocure =[
            'dateOfprocure'          =>  $request['dateOfprocure'],
            'id'                     =>  $request['id'],
            'local_item'             =>  $request->local_item,
            'user_id'                =>  $this->userId()
        ];
       //  dd($localprocure);
        try{
            $response_data= $this->apiService->createData('emis/messManagement/saveLocalProcure', $localprocure);
         //   dd($response_data);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    // Stock Received 

    // public function saveStockReceived(Request $request){
    //     $rules = [
    //         'dateOfreceived'          =>  'required',
    //         'quarter'                 =>  'required',
    //     ];
    //     $customMessages = [
    //         'dateOfreceived.required'       => 'dateOfreceived is required',
    //         'quarter.required'              => 'quarter is required',

    //     ];
    //     $this->validate($request, $rules, $customMessages);
    //     $stockreceived =[
    //         'dateOfreceived'                =>  $request['dateOfreceived'],
    //         'quarter'                       =>  $request['quarter'],
    //         'id'                            =>  $request['id'],
    //         'foodrelease_list'              =>  $request->foodrelease_list,
    //         'user_id'                       =>  $this->userId()

    //     ];
    //    //  dd($stockreceived);
    //     try{
    //         $response_data= $this->apiService->createData('emis/messManagement/saveStockReceived', $stockreceived);
    //         return $response_data;
    //     }
    //     catch(\GuzzleHttp\Exception\ClientException $e){
    //         return $e;
    //     }
    // }

    public function getFoodRelease($termId = ""){
        //   dd('m here'); 
        $dis = $this->apiService->listData('emis/messManagement/getFoodRelease/' .$termId);
        return $dis;
    }
    // public function loadStockReceivedList(){
    //    //    dd('m here');
    //     $list = $this->apiService->listData('emis/messManagement/loadStockReceivedList');
    //     return $list;
    // }


    // Stock Issued
    public function loadStockIssuedList(){
     //   dd('m here');
      $list = $this->apiService->listData('emis/messManagement/loadStockIssuedList');
      return $list;
    }

    public function saveStockIssued(Request $request){
     //return $request
     $rules = [
         'dateOfissue'         =>  'required',
       ];
      $customMessages = [
         'dateOfissue.required'            => 'dateOfissue is required',
         ];
         $this->validate($request, $rules, $customMessages);
       $stockissue =[
         //'organizationId'           =>  $this->getWrkingAgencyId(),
            'dateOfissue'              =>  $request['dateOfissue'],
            'id'                       =>  $request['id'],
            'item_issue'               =>  $request->item_issue,
            'user_id'                  =>  $this->userId()
        ];  
       //   dd($stockissue);
      try{
        $response_data= $this->apiService->createData('emis/messManagement/saveStockIssued', $stockissue);
         //dd($response_data);
         return $response_data;
         }
         catch(GuzzleHttp\Exception\ClientException $e){
          return $e;
        }
    }

}
