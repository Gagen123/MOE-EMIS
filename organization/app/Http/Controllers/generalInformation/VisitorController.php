<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\ClassMapping;
use Illuminate\Support\Facades\DB;
use App\Models\generalInformation\Visitor;
use App\Models\Masters\VisitorType;

class VisitorController extends Controller
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
    public function loadVisitorInformation($orgId=""){
     // dd('from microservice');
        $info = Visitor::where('organizationId',$orgId)->get();
        return $info;
        // $list= DB::table('organization_visitor as a')
        // ->join('master_visitor_type as b', 'a.visitor', '=', 'b.id')
        // ->select('a.id as id', 'b.name as visitor', 'a.dateOfVisit as dateOfVisit', 'a.remarks as remarks')
        // ->where('organizationId', $orgId)->get();
        // return $list;
    }

    public function saveVisitorInformation(Request $request){
        $id = $request->id;
     //   dd($id);
        if( $id != null){
        $data =[
            'organizationId'                =>  $request['organizationId'],
            'visitorname'                   =>  $request['visitorname'],
            'designation'                   =>  $request['designation'],
            'contact'                       =>  $request['contact'],
            'minitsryOrAgency'              =>  $request['minitsryOrAgency'],
            'noOfhours'                     =>  $request['noOfhours'],
            'targetgroup'                   =>  $request['targetgroup'],
            'deptOrdivision'                =>  $request['deptOrdivision'],
            'purposeOfvisit'                =>  $request['purposeOfvisit'],
            'dateOfVisit'                   =>  $request['date'],
            'id'                            =>  $request['id'],
            'updated_by'                    =>  $request->user_id,
            'updated_at'                    =>  date('Y-m-d h:i:s')
        ];

        $response_data = Visitor::where('id', $id)->update($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
         }else{
        $data =[
            'organizationId'                =>  $request['organizationId'],
            'visitorname'                   =>  $request['visitorname'],
            'designation'                   =>  $request['designation'],
            'contact'                       =>  $request['contact'],
            'minitsryOrAgency'              =>  $request['minitsryOrAgency'],
            'noOfhours'                     =>  $request['noOfhours'],
            'targetgroup'                   =>  $request['targetgroup'],
            'deptOrdivision'                =>  $request['deptOrdivision'],
            'purposeOfvisit'                =>  $request['purposeOfvisit'],
            'dateOfVisit'                   =>  $request['date'],
            'created_by'                    =>  $request->user_id,
            'created_at'                    =>  date('Y-m-d h:i:s')
        ];
       // dd($data);
        $response_data = Visitor::create($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    }

    // public function updateVisitorInformation(Request $request){

    //     $data =[
    //         'id'                                =>  $request['id'],
    //         'organizationId'           =>  $request['organizationId'],
    //         'visitor'                  =>  $request['visitor_information'],
    //         'dateOfVisit'              =>  $request['date'],
    //         'remarks'                  =>  $request['remarks'],
    //     ];

    //     $response_data = Visitor::where('id',$id)->update($data);
        
    //     return $this->successResponse($response_data, Response::HTTP_CREATED);


    
    // }
    public function getVisitorTypeDropdown(){
       // dd('from microserve ');
        return VisitorType::where('status',1)->get();
    }

    public function getVisitorDetails($visId=""){
        $response_data=Visitor::where('id',$visId)->first();
     // $response_data->facility=FacilityInStructure::where('infrastructureId',$response_data->id)->get();
        return $this->successResponse($response_data);
    }

}
