<?php

namespace App\Http\Controllers\organization;

use Session;
// use Redirect;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Storage;

class FurnitureController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveFurniture(Request $request){

        $rules = [
            'type'              =>  'required',
            'item'              =>  'required',
            'usable'            =>  'required',
            'notusable'         =>  'required',
            

        ];
        $customMessages = [
            'type.required'                 => 'Type is required',
            'item.required'                 => 'Item is required',
            'usable.required'                 => 'usable is required',
            'notusable.required'            => 'notusable is required',
           
        ];

        $this->validate($request, $rules, $customMessages);

        $loc =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'type'                      =>  $request['type'],
            'item'                      =>  $request['item'],
            'usable'                    =>  $request['usable'],
            'notusable'                 =>  $request['notusable'],
            
            'actiontype'                =>  $request['action_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/organization/furniture/saveFurniture', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadFurniture(){
        $orgId=$this->getWrkingAgencyId();
        $dis = $this->apiService->listData('emis/organization/furniture/loadFurniture/'.$orgId);
        return $dis;
    }

}
