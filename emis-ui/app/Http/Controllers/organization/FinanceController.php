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

class FinanceController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveIncomeInformation(Request $request){
        $rules = [
            'type'          =>  'required',
            'item'          =>  'required',
            'location'      =>  'required',
            'number'        =>  'required',
        ];
        $customMessages = [
            'type.required'         => 'Type is required',
            'item.required'         => 'Item is required',
            'location.required'     => 'Location/Use is required',
            'number.required'       => 'Number is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'type'                      =>  $request['type'],
            'item'                      =>  $request['item'],
            'location'                  =>  $request['location'],
            'number'                    =>  $request['number'],
            'actiontype'                =>  $request['action_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];
        // try{
            $response_data= $this->apiService->createData('emis/organization/equipment/saveEquipmentAndFurniture', $loc);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
    }

    public function loadEquipment($orgId=""){
        if($orgId=="null" || $orgId==""){
            $orgId=$this->getWrkingAgencyId();
            
        }
        $dis = $this->apiService->listData('emis/organization/equipment/loadEquipment/'.$orgId);
        return $dis;
    }


    public function saveFinancialInformation(Request $request){
        $rules = [
            'type'          =>  'required',
            'item'          =>  'required',
            'location'      =>  'required',
            'number'        =>  'required',
        ];
        $customMessages = [
            'type.required'         => 'Type is required',
            'item.required'         => 'Item is required',
            'location.required'     => 'Location/Use is required',
            'number.required'       => 'Number is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'type'                      =>  $request['type'],
            'item'                      =>  $request['item'],
            'location'                  =>  $request['location'],
            'number'                    =>  $request['number'],
            'actiontype'                =>  $request['action_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];
        // try{
            $response_data= $this->apiService->createData('emis/organization/equipment/saveEquipmentAndFurniture', $loc);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
    }

    public function saveFinancialInfo(Request $request){
        // dd($request);
        $rules = [
            // 'type'                           =>  'required',
            'amount'                            =>  'required',
            'date'                              =>  'required',
            'status'                            =>  'required',
            // 'organizationId'                    =>  'organizationId',
            // 'financialInformationId'            =>  'financialInformationId',
            
        ];
        $customMessages = [
            'type.required'                     => 'Type is required',
            'amount.required'                   => 'amount is required',
            'date.required'                     => 'date is required',
            'status.required'                   => 'status is required',
            // 'organizationId.required'           => 'organizationId is required',
            // 'financialInformationId.required'   => 'financialInformationId is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'type'                              =>  $request['type'],
            'amount'                            =>  $request['amount'],
            'date'                              =>  $request['date'],
            'status'                            =>  $request['status'],
            // 'organizationId'                 =>  $request['organizationId'],
            // 'financialInformationId'         =>  $request['financialInformationId'],
        ];
        $response_data= $this->apiService->createData('emis/organization/finance/saveFinancialInformation', $data );
        return $response_data;
    } 
    
    public function saveIncomeinfo(Request $request){
        // dd($request);
        $rules = [
            // 'type'                           =>  'required',
            'income'                            =>  'required',
            'amount'                            =>  'required',
            'date'                              =>  'required',
            'remarks'                           =>  'required',
            // 'organizationId'                 =>  'organizationId',
            // 'incomeFacilitiesId'             =>  'incomeFacilitiesId',
            
        ];
        $customMessages = [
            'type.required'                     => 'Type is required',
            'income.required'                   => 'Type is required',
            'amount.required'                   => 'amount is required',
            'date.required'                     => 'date is required',
            'remarks.required'                  => 'remarks is required',
            // 'organizationId.required'        => 'organizationId is required',
            // 'incomeFacilitiesId.required'    => 'incomeFacilitiesId is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'type'                              =>  $request['type'],
            'amount'                            =>  $request['amount'],
            'date'                              =>  $request['date'],
            'remarks'                           =>  $request['remarks'],
            // 'organizationId'                 =>  $request['organizationId'],
            // 'incomeFacilitiesId'             =>  $request['incomeFacilitiesId'],
        ];
        $response_data= $this->apiService->createData('emis/organization/income/saveIncomeInformation', $data );
        return $response_data;
    } 


    public function loadFinancialInformation($orgId){
        try{
        $financialInformation = $this->apiService->listData('emis/organization/finance/loadFinancialInformation/', +$orgId);
        return $financialInformation;
        }
        catch(\Illuminate\Database\QueryException $e){
            dd($e);

        }
    }

   

}