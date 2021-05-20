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
      //  dd('m here');
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
            'dateOfrelease'            =>  'required',
            'dzongkhag'                =>  'required',
            'organizaiton'             =>  'required',
            'term'                     =>  'required',
        ];
        $customMessages = [
            'dateOfrelease.required'    =>  'dateOfrelease is required',
            'dzongkhag.required'        =>  'dzongkhag is required',
            'organizaiton.required'     =>  'organizaiton  is required',
            'term.required'             =>  'term is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $foodrelease =[
            //'organizationId'           =>  $this->getWrkingAgencyId(),
            'dateOfrelease'            =>  $request['dateOfrelease'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'organizaiton'             =>  $request['organizaiton'],
            'term'                     =>  $request['term'],
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
            'organizationId'         =>  $this->getWrkingAgencyId(),
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

    public function saveStockReceived(Request $request){
        $rules = [
            'dateOfreceived'          =>  'required',
            'term'                    =>  'required',
        ];
        $customMessages = [
            'dateOfreceived.required'       => 'dateOfreceived is required',
            'term.required'                 => 'Term is required',

        ];
        $this->validate($request, $rules, $customMessages);
        $stockreceived =[
            'organizationId'                =>  $this->getWrkingAgencyId(),
            'dateOfreceived'                =>  $request['dateOfreceived'],
            'term'                          =>  $request['term'],
            'id'                            =>  $request['id'],
            'items_received'                =>  $request->items_received,
            'user_id'                       =>  $this->userId()

        ];
        // dd($stockreceived);
        try{
            $response_data= $this->apiService->createData('emis/messManagement/saveStockReceived', $stockreceived);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadFoodReleaseListing($orgId=""){
        if($orgId=="null" || $orgId==""){
            $orgId=$this->getWrkingAgencyId();
        }
       // dd('m here');
        $list = $this->apiService->listData('emis/messManagement/loadFoodReleaseListing/'.$orgId);
        return $list;
       // dd($list);
    }
    //     $response_data= $this->apiService->listData('emis/messManagement/loadFoodReleaseListing/'.$orgId);
    //     return $response_data;
    // }
    
    public function getfoodreleaseditemList($foodreleaseId=""){
        //dd('m here');
        $itemList = $this->apiService->listData('emis/messManagement/getfoodreleaseditemList/'.$foodreleaseId);
        return $itemList;
    }
 
    public function getfoodreleasedetailbyquarter($quarter_id="",$foodreleaseId=""){
      //  dd('m here');
        $response_data= $this->apiService->listData('emis/messManagement/getfoodreleasedetailbyquarter/'.$quarter_id."/".$foodreleaseId.'/'.$this->getWrkingAgencyId());
        return $response_data;
    }
       



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
            'organizationId'           =>  $this->getWrkingAgencyId(),
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
