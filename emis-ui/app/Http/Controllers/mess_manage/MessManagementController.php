<?php

namespace App\Http\Controllers\mess_manage;

//use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Storage;

class MessManagementController extends Controller
{
    //
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function loadFoodReleaseList($param=""){
        $list = $this->apiService->listData('emis/messManagement/loadFoodReleaseList/'.$param);
        return $list;
    }

    // public function getFoodReleaseItem($foodreleaseId=''){
    //     $list = $this->apiService->listData('emis/messManagement/getFoodReleaseItem/'.$foodreleaseId);
    //     return $list;
    // }

    public function getFoodReleaseDetails($foodrelId=''){
        $list = $this->apiService->listData('emis/messManagement/getFoodReleaseDetails/'.$foodrelId);
        return $list;
    }
    public function ViewFoodReleaseDetials($foodreleaseId=''){
        $list = $this->apiService->listData('emis/messManagement/ViewFoodReleaseDetials/'.$foodreleaseId);
        return $list;
    }
    public function saveFoodRelease(Request $request){
        //return $request
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'foodreleasenote';
        if($files!=null && $files!=""){
            if(sizeof($files)>0 && !is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            if(sizeof($files)>0){
                foreach($files as $index => $file){
                    $file_name = time().'_' .$file->getClientOriginalName();
                    move_uploaded_file($file,$file_store_path.'/'.$file_name);
                    array_push($attachment_details,
                        array(
                            'path'                   =>  $file_store_path,
                            'original_name'          =>  $file_name,
                            'user_defined_name'      =>  $filenames[$index],
                        )
                    );
                }
            }
        }
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
        $foodrelease =[
            //'organizationId'           =>  $this->getWrkingAgencyId(),
            'dateOfrelease'            =>  $request['dateOfrelease'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'organizaiton'             =>  $request['organizaiton'],
            'quarter'                  =>  $request['quarter'],
            'remarks'                  =>  $request['remarks'],
            'attachment_details'       =>  $attachment_details,
            'id'                       =>  $request['id'],
            'user_id'                  =>  $this->userId()
        ];
       $response_data= $this->apiService->createData('emis/messManagement/saveFoodRelease', $foodrelease);
       //dd($response_data);
       return $response_data;
    }


    public function loadLocalProcure(){
        //return json_encode('from UI');
        $orgId = $this->getWrkingAgencyId();
       // dd($orgId);
        $list = $this->apiService->listData('emis/messManagement/loadLocalProcure/'.$orgId);
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
      // dd($request->local_item);
        try{
            $response_data= $this->apiService->createData('emis/messManagement/saveLocalProcure', $localprocure);
         //   dd($response_data);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    public function localProcureEditList($locId=""){
       // dd('from Ui');
        $list = $this->apiService->listData('emis/messManagement/localProcureEditList/'.$locId);
        return $list;
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
            'dzoId'                        =>  $this->getUserDzoId(),
            'dateOfreceived'                =>  $request['dateOfreceived'],
            'quarter'                       =>  $request['quarter'],
            'remarks'                       =>  $request['remarks'],
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

    //changed the method name to stockReceivedListing from loadFoodReleaseListing by Tshewang
    public function stockReceivedListing($type){
        $param=$this->getWrkingAgencyId().'_'."OrgWise";
        if($type=="Creater"){
            $param=$this->userId().'_'."Creater";
        }
        $list = $this->apiService->listData('emis/messManagement/stockReceivedListing/'.$param);
        return $list;
    }
    public function loadStockReceiveView($StockReceivedID=""){
        $loadDetials = $this->apiService->listData('emis/messManagement/loadStockReceiveView/'.$StockReceivedID );
        return $loadDetials;
    }

    public function getfoodreleaseditemList($foodreleaseId=""){
        //dd('m here');
        $itemList = $this->apiService->listData('emis/messManagement/getfoodreleaseditemList/'.$foodreleaseId);
        return $itemList;
    }

    public function loadStockReceivedDetails($id=""){
        $list = $this->apiService->listData('emis/messManagement/loadStockReceivedDetails/'.$id);
        return $list;
    }

    //just added
    public function getStockReceivedDetails($stkId=""){
       // dd(' mhere');
        $receivedDetails = $this->apiService->listData('emis/messManagement/getStockReceivedDetails/'.$stkId);
        return $receivedDetails;
    }

    public function viewitemreceived($stockreceivedId=""){
       // return($stockreceivedId);
       // dd('m here');
        $itemrcv = $this->apiService->listData('emis/messManagement/viewitemreceived/'.$stockreceivedId);
        return $itemrcv;
    }

    // Stock Issued

    public function loadStockIssuedList(){
        //return json_encode('from UI');
        $orgId = $this->getWrkingAgencyId();
       // dd($orgId);
        $list = $this->apiService->listData('emis/messManagement/loadStockIssuedList/'.$orgId);
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
        $response_data= $this->apiService->createData('emis/messManagement/saveStockIssued', $stockissue);
        //dd($response_data);
        return $response_data;
    }
    public function StockIssueEditList($lssId=""){
        // dd('from Ui');
        $list = $this->apiService->listData('emis/messManagement/StockIssueEditList/'.$lssId);
        return $list;
    }

    public function approvereject(Request $request){
        $request_data =[
            'remarks'                 =>  $request->remarks,
            'action'                  =>  $request->action,
            'id'                      =>  $request->id,
            'action_type'             =>  $request->action,
            'user_id'                 =>  $this->userId(),
            'org_id'                  =>  $this->getWrkingAgencyId(),
            'dzo_id'                  =>  $this->getUserDzoId()
        ];
        $response_data= $this->apiService->createData('emis/messManagement/approvereject', $request_data);
        return $response_data;
    }



    public function getInventoryList(){
        //  dd('m here');
        $orgId=$this->getWrkingAgencyId();
        //dd( $orgId);
        $list = $this->apiService->listData('emis/messManagement/getInventoryList/'.$orgId);
        return $list;
    }
    public function getInventoryListLocal(){
        //  dd('m here');
        $orgId=$this->getWrkingAgencyId();
        //dd( $orgId);
        $list = $this->apiService->listData('emis/messManagement/getInventoryListLocal/'.$orgId);
        return $list;
    }

    public function deleteFile($full_path="",$id=""){
        $full_path=str_replace('SSS','/',$full_path);
        $headers = ['Content-Type: application/pdf'];
        $file_name = explode('/',$full_path);
        $finel_name = end($file_name);
        $response_data="";
        if (file_exists($full_path)){
            unlink($full_path);
            $response_data = $this->apiService->deleteData("emis/messManagement/deleteFile", $id);
        }
        return $response_data;
    }
    public function getquantity($itemId="", $chekva=""){
     //  dd($itemId, $chekva );
        $orgId=$this->getWrkingAgencyId();
        $list = $this->apiService->listData('emis/messManagement/getquantity/'.$itemId. "/".$chekva. "/".$orgId);
        return $list;
    }
}
