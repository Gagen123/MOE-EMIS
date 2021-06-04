<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\ClassMapping;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationClassStream;
use App\Models\organization_financial_information;

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

    // public function saveIncomeInformation(Request $request){
    //     OrganizationClassStream::where('organizationId',$request->school)->delete();
    //     $response_data="";
    //     if($request->class){
    //         foreach($request->class as $key => $classId){
    //             $stream_exists = $this->checkStreamExists($classId);
    //             if(empty($stream_exists)){
    //                 $classStream = [
    //                     'organizationId'        => $request->school,
    //                     'classId'               => $classId,
    //                     'streamId'              => '',
    //                     'created_by'            => $request->user_id,
    //                     'created_at'            => date('Y-m-d h:i:s'),
    //                 ];
    //                 $class = OrganizationClassStream::create($classStream);
    //             } 
    //         }
    //         return $this->successResponse($response_data, Response::HTTP_CREATED);
    //     }
    // }
        
    // public function loadIncomeInformation($orgId=""){
    //     $response_data = OrganizationClassStream::where('organizationId',$school_id)->get();
    //     if($response_data!=null && $response_data!=""){
    //         foreach($response_data as $class_stream){
    //             if($class_stream['streamId']!=null && $class_stream['streamId']!=""){
    //                 // dd($this->getmappingId($class_stream['classId'],$class_stream['streamId'])->id);
    //                 $class_stream->classStreamId= $this->getmappingId($class_stream['classId'],$class_stream['streamId'])->id;
    //             }
    //             else{
    //                 $class_stream->classStreamId= "";
    //             }
    //         }
    //     }
    //     return $response_data;
    // }

    public function saveFinancialInformation(Request $request){
        //  dd($request);
         $rules = [
            // 'type'               =>  'required',
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
            // 'organizationId'                    =>  $request['organizationId'],
            // 'financialInformationId'            =>  $request['financialInformationId'],
           
        ];
        try{
            $response_data = organization_financial_information::create($data);
            }
            catch(\Illuminate\Database\QueryException $e){
                dd($e);

            }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadFinancialInformation($orgId){
        $finacialinfo=organization_financial_information::where('organizationId',$orgId)->get();
        return $this->successResponse($finacialinfo); 
    }
}


