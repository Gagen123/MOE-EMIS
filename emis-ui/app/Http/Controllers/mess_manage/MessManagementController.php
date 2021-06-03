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
            'quarter'                  =>  'required',
        ];
        $customMessages = [
            'dateOfrelease.required'    =>  'dateOfrelease is required',
            'dzongkhag.required'        =>  'dzongkhag is required',
            'organizaiton.required'     =>  'organizaiton  is required',
            'quarter.required'          =>  'quarter is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
    //     $files = $request->attachments;
    //    //  dd($files);
    //     $filenames = $request->attachmentname;
    //     $attachment_details=[];
    //     $file_store_path=config('services.constant.file_stored_base_path').'MessManagement';
    //     if($files!=null && $files!=""){
    //         if(sizeof($files)>0 && !is_dir($file_store_path)){
    //             mkdir($file_store_path,0777,TRUE);
    //         }
    //         if(sizeof($files)>0){
    //             foreach($files as $index => $file){
    //                 $file_name = time().'_' .$file->getClientOriginalName();
    //                 move_uploaded_file($file,$file_store_path.'/'.$file_name);
    //                 array_push($attachment_details,
    //                     array(
    //                         'path'                    =>  $file_store_path,
    //                         'original_name'           =>  $file_name,
    //                         'user_defined_name'       =>  $filenames[$index],
    //                     )
    //                 );
    //             }
    //         }
    //     }
        $foodrelease =[
            //'organizationId'           =>  $this->getWrkingAgencyId(),
            'dateOfrelease'            =>  $request['dateOfrelease'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'organizaiton'             =>  $request['organizaiton'],
            'quarter'                  =>  $request['quarter'],
            'remarks'                  =>  $request['remarks'],
          //  'attachment_details'       =>  $attachment_details,
            'id'                       =>  $request['id'],
          //  'items_released'           =>  $request->items_released,
            'user_id'                  =>  $this->userId()
        ];  
       //  dd($foodrelease);
        try{
            $response_data= $this->apiService->createData('emis/messManagement/saveFoodRelease', $foodrelease);
            //dd($response_data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }


    // //local Procurement

    public function loadLocalProcure($org_Id=""){
     //return json_encode('from UI');  
        $list = $this->apiService->listData('emis/messManagement/loadLocalProcure'.$org_Id);
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
            'quarter'                 =>  'required',
        ];
        $customMessages = [
            'dateOfreceived.required'       => 'dateOfreceived is required',
            'quarter.required'              => 'Quarter is required',

        ];
        $this->validate($request, $rules, $customMessages);
        $stockreceived =[
            'organizationId'                =>  $this->getWrkingAgencyId(),
            'dateOfreceived'                =>  $request['dateOfreceived'],
            'quarter'                       =>  $request['quarter'],
            'remarks'                       =>  $request['remarks'],
            'id'                            =>  $request['id'],
            'items_received'                =>  $request->items_received,
            'user_id'                       =>  $this->userId()

        ];
     //   dd($stockreceived);
        try{
            $response_data= $this->apiService->createData('emis/messManagement/saveStockReceived', $stockreceived);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadFoodReleaseListing($org_Id=""){
       // dd('m here');
        $list = $this->apiService->listData('emis/messManagement/loadFoodReleaseListing/'.$org_Id);
        return $list;
       // dd($list);
    }
    
    public function getfoodreleaseditemList($foodreleaseId=""){
        //dd('m here');
        $itemList = $this->apiService->listData('emis/messManagement/getfoodreleaseditemList/'.$foodreleaseId);
        return $itemList;
    }

    // public function loadFoodReleaseListing($org_Id=""){
    //     if($org_Id=="null" || $org_Id==""){
    //         $org_Id=$this->getWrkingAgencyId();
    //     }
    //    // dd('m here');
    //     $list = $this->apiService->listData('emis/messManagement/loadFoodReleaseListing/'.$org_Id);
    //     return $list;
    //    // dd($list);
    // }

    //just added
    public function getStockReceivedDetails($stockreceivedId=""){
        $receivedDetails = $this->apiService->listData('emis/messManagement/getStockReceivedDetails/'.$stockreceivedId);
        return $receivedDetails;
    }

    public function viewitemreceived($stockreceivedId=""){
       // return($stockreceivedId);
        //dd('m here');
        $itemrcv = $this->apiService->listData('emis/messManagement/viewitemreceived/'.$stockreceivedId);
        return $itemrcv;
    }

    // Stock Issued
    public function getStockIssuedList($org_Id=""){
        //  dd('m here');
        $list = $this->apiService->listData('emis/messManagement/getStockIssuedList'.$org_Id);
        return $list;
    }
    // public function loadStockIssuedList($org_Id=""){
    //   //  dd('m here');
    //  if($org_Id=="null" || $org_Id==""){
    //      $org_Id=$this->getWrkingAgencyId();
    //     }
    //   $list = $this->apiService->listData('emis/messManagement/loadStockIssuedList'.$org_Id);
    //   return $list;
    // }

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

    public function getInventoryList($org_Id=""){
         //  dd('m here');
        if($org_Id=="null" || $org_Id==""){
            $org_Id=$this->getWrkingAgencyId();
        }
        $list = $this->apiService->listData('emis/messManagement/getInventoryList/'.$org_Id);
        return $list;
    }

    

    public function getStockIssueItem($org_Id=""){
        if($org_Id=="null" || $org_Id==""){
            $org_Id=$this->getWrkingAgencyId();
        }
       // dd('m here');
        $list = $this->apiService->listData('emis/messManagement/getStockIssueItem/'.$org_Id);
        return $list;
       // dd($list);
    }

}
