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

class EquipmentController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveEquipment(Request $request){
        $rules = [
            'type'          =>  'required',
            'item'          =>  'required',
            'cost'          =>  'required',
            'condition'     =>  'required',
        ];
        $customMessages = [
            'type.required'         => 'Type is required',
            'item.required'         => 'Item is required',
            'cost.required'         => 'Cost is required',
            'condition.required'    => 'Condition is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'type'                      =>  $request['type'],
            'item'                      =>  $request['item'],
            'cost'                      =>  $request['cost'],
            'condition'                 =>  $request['condition'],
            'actiontype'                =>  $request['action_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/equipment/saveEquipment', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadEquipment(){
        $orgId=$this->getWrkingAgencyId();
        $dis = $this->apiService->listData('emis/organization/equipment/loadEquipment/'.$orgId);
        return $dis;
    }

}
