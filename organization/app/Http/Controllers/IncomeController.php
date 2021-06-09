<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\organization_income_facilities;

class IncomeController extends Controller
{
    use ApiResponser;
    //
    public function saveIncomeInformation(Request $request){
        //   dd($request);
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
        
        try{
            $response_data = organization_income_facilities::create($data);
            }
            catch(\Illuminate\Database\QueryException $e){
                dd($e);

            }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    } 

}
