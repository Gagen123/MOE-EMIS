<?php

namespace App\Http\Controllers\mess_manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;

class TestStockController extends Controller
{
    //
    use ServiceHelper; 
    use AuthUser; 
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

        // Stock Received 
    public function getstockreceivedList($org_Id=""){
        //dd('m here');
        $itemList = $this->apiService->listData('emis/messManagement/getstockreceivedList/'.$org_Id);
        return $itemList;
    }

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

}
