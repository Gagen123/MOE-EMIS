<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\ClassMapping;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationClassStream;
use App\Models\OrganizationIncomeFacilities;
use App\Models\OrganizationFinancialInformation;

class FinanceController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function saveIncomeInformation(Request $request){
          $rules = [
            'amount'                            =>  'required',
            'date'                              =>  'required',
            'remarks'                           =>  'required',
            
        ];
        $customMessages = [
            'amount.required'                   => 'amount is required',
            'date.required'                     => 'date is required',
            'remarks.required'                  => 'remarks is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'amountGenerated'                    =>  $request['amount'],
            'date'                               =>  $request['date'],
            'remarks'                            =>  $request['remarks'],
            'organization_details_id'            =>  $request['organizationId'],
            'incomeFacilitiesId'                 =>  $request['incomeFacilitiesId'],
        ];
        try{
        $response_data = OrganizationIncomeFacilities::create($data);
        }
        catch(\Illuminate\Database\QueryException $ex){
            dd($ex);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
        }
    } 
    public function updateIncomeInformation(Request $request){
        $id = $request->id;
          $rules = [
            // 'income'                         =>  'required',
            'id'                                =>  'required',
            'amount'                            =>  'required',
            'date'                              =>  'required',
            'remarks'                           =>  'required',
            'organizationId'                    =>  'required',
            
        ];
        $customMessages = [
            'id.required'                       => 'amount is required',
            'amount.required'                   => 'amount is required',
            'date.required'                     => 'date is required',
            'remarks.required'                  => 'remarks is required',
            'organizationId.required'           => 'organizationId is required',
            'incomeFacilitiesId.required'    => 'incomeFacilitiesId is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'id'                                 =>  $request['id'],
            'amountGenerated'                    =>  $request['amount'],
            'date'                               =>  $request['date'],
            'remarks'                            =>  $request['remarks'],
            'organization_details_id'            =>  $request['organizationId'],
            'incomeFacilitiesId'              =>  $request['income'],
        ];
        $response_data = OrganizationIncomeFacilities::where('id', $id)->update($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
        
    public function saveFinancialInformation(Request $request){
         $rules = [
            'amount'                            =>  'required',
            'date'                              =>  'required',
           // 'remarks'                           =>  'required',
        ];
        $customMessages = [
            'amount.required'                   => 'amount is required',
            'date.required'                     => 'date is required',
          //  'remarks.required'                  => 'remarks is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'organizationId'                    =>  $request['organizationId'],
            'amount'                            =>  $request['amount'],
            'date'                              =>  $request['date'],
            'remarks'                           =>  $request['remarks'],
            'financialInformationId'            =>  $request['financialInformationId'],
        ];
       // dd($data);
        // try{
        $response_data = OrganizationFinancialInformation::create($data);
        // }catch(\Illuminate\Database\QueryException $ex){
        //     dd($ex);

        // }
        return $response_data;
    }
    public function updateFinancialInfo(Request $request){
        $id = $request->id;
        //  $rules = [
        //     'amount'                            =>  'required',
        //     'date'                              =>  'required',
        //    // 'remarks'                           =>  'required',
        //     'organizationId'                    =>  'required',
        //     'type'                              =>  'required',
            
        // ];
        // $customMessages = [
        //     'amount.required'                   => 'amount is required',
        //     'date.required'                     => 'date is required',
        //   //  'remarks.required'                  => 'remarks is required',
        //     'organizationId.required'           => 'organizationId is required',
        //     'type.required'                     => 'financialInformationId is required',
        // ];
        // $this->validate($request, $rules, $customMessages);
        $data =[
            'id'                                =>  $request->id,
            'amount'                            =>  $request['amount'],
            'date'                              =>  $request['date'],
            'remarks'                           =>  $request['remarks'],
            'organizationId'                    =>  $request['organizationId'],
            'financialInformationId'            =>  $request['type'],
           
        ];
      //  dd($data);
        $response_data = OrganizationFinancialInformation::where('id', $id)->update($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);

    }

    public function loadFinancialInformation($orgId=""){

        $fincialquery= DB::table('orgnization_financial_information as a')
        ->join('master_financial_information as b','b.id', '=','a.financialInformationId')
        ->select('a.id','b.name','a.amount','a.date')
        ->where('a.organizationId',$orgId)->get();
        return $fincialquery; 
    }
    
    public function loadIncomeInformation($orgId= ""){
        $incomequery= DB::table('master_income_facilities as a')
        ->join('organization_income_facilities as b','b.incomeFacilitiesId', '=','a.id')
        ->select('a.name','b.amountGenerated','b.date','b.remarks')
        ->where('b.organization_details_id',$orgId)->get();
        return $incomequery; 
    }

    public function getFinancialInfoEdit($finId=""){
        // dd($furId);
        // $response_data= DB::table('orgnization_financial_information as a')
        // ->join('master_financial_information as b','b.id', '=','a.financialInformationId')
        // ->select('a.id','b.name','a.amount','a.date')
        // ->where('a.id',$finId)->first();
        // return $response_data; 
       

        $response_data=OrganizationFinancialInformation::where('id', $finId)->first();
        return $this->successResponse($response_data);
    }
}



