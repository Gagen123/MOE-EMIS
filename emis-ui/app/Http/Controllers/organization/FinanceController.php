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
            'financialInformationId'            =>   'required',
            'amount'                            =>  'required',
            'date'                              =>  'required',
            
        ];
        $customMessages = [
            'financialInformationId.required'           => 'Type is Required',
            'amount.required'                           => 'amount is required',
            'date.required'                             => 'date is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'organizationId'                    =>  $this->getWrkingAgencyId(),
            'amount'                            =>  $request['amount'],
            'date'                              =>  $request['date'],
            'remarks'                           =>  $request['remarks'],
            'financialInformationId'            =>  $request->financialInformationId,
        ];
      //  dd($data);
        $response_data= $this->apiService->createData('emis/organization/finance/saveFinancialInformation', $data );
        return $response_data;
    } 
    
    public function saveIncomeinfo(Request $request){
        $rules = [
            'amount'                            =>  'required',
            'date'                              =>  'required',
         //   'remarks'                           =>  'required',
            'incomeFacilitiesId'                =>  'required',
            
        ];
        $customMessages = [
            'amount.required'                   => 'amount is required',
            'date.required'                     => 'date is required',
          //  'remarks.required'                  => 'remarks is required',
            'incomeFacilitiesId.required'       => 'incomeFacilitiesId is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'organizationId'                    =>  $this->getWrkingAgencyId(),
            'amount'                            =>  $request['amount'],
            'date'                              =>  $request['date'],
            'remarks'                           =>  $request['remarks'],
            'incomeFacilitiesId'                =>  $request['incomeFacilitiesId'],
        ];
        $response_data= $this->apiService->createData('emis/organization/finance/saveIncomeInformation', $data );
         return $response_data;
        }

        public function updateIncomeinfo(Request $request){
            $rules = [
                'amount'                            =>  'required',
                'date'                              =>  'required',
                'remarks'                           =>  'required',
                'incomeFacilitiesId'                =>  'incomeFacilitiesId',
                
            ];
            $customMessages = [
                'amount.required'                   => 'amount is required',
                'date.required'                     => 'date is required',
                'remarks.required'                  => 'remarks is required',
                'incomeFacilitiesId.required'       => 'incomeFacilitiesId is required',
            ];
            $this->validate($request, $rules, $customMessages);
            $data =[
                'organizationId'                    =>  $this->getWrkingAgencyId(),
                'amount'                            =>  $request['amount'],
                'date'                              =>  $request['date'],
                'remarks'                           =>  $request['remarks'],
                'id'                                =>  $request['id'],
                'incomeFacilitiesId'                =>  $request['incomeFacilitiesId'],
            ];
             $response_data= $this->apiService->createData('emis/organization/finance/updateIncomeInformation', $data );
             return $response_data;
            }

        public function updateFinancialInfo(Request $request){
            // dd($request);
            $rules = [
                'type'                              =>  'required',
                'amount'                            =>  'required',
                'date'                              =>  'required',
               // 'remarks'                           =>  'required',
                // 'incomeFacilitiesId'             =>  'incomeFacilitiesId',
                
            ];
            $customMessages = [
                'amount.required'                   => 'amount is required',
                'date.required'                     => 'date is required',
               // 'remarks.required'                  => 'remarks is required',
                'type.required'                     => 'Type  is required',
            ];
            $this->validate($request, $rules, $customMessages);
            $data =[
                'organizationId'                    =>  $this->getWrkingAgencyId(),
                'amount'                            =>  $request['amount'],
                'date'                              =>  $request['date'],
                'remarks'                           =>  $request['remarks'],
                'id'                                =>  $request['id'],
                 'type'                             =>  $request['type'],
            ];
           // dd($data);
             $response_data= $this->apiService->createData('emis/organization/finance/updateFinancialInfo', $data );
             return $response_data;
            }

        
            
    public function loadFinancialInformation(){
        $orgId = $this->getWrkingAgencyId();
        $data = $this->apiService->listData('emis/organization/finance/loadFinancialInformation/'. $orgId);
        return $data;
    }

    public function loadIncomeInformation(){
        $orgId = $this->getWrkingAgencyId();
        $data = $this->apiService->listData('emis/organization/finance/loadIncomeInformation/'. $orgId);
        return $data;
    }
    public function getFinancialInfoEdit($finId=""){
        // dd('m here');
        $finDetails = $this->apiService->listData('emis/organization/finance/getFinancialInfoEdit/'.$finId);
        return $finDetails;
    }

   

}