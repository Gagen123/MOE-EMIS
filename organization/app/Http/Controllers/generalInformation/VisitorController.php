<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\ClassMapping;
use Illuminate\Support\Facades\DB;
use App\Models\generalInformation\Visitor;

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

    public function saveVisitorInformation(Request $request){

        $data =[
            'organizationId'           =>  $request['organizationId'],
            'visitor'                  =>  $request['visitor_information'],
            'dateOfVisit'              =>  $request['date'],
            'remarks'                  =>  $request['remarks'],
        ];

        $response_data = Visitor::create($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    
    public function loadVisitorInformation($orgId=""){
        $info = Visitor::where('organizationId',$orgId)->get();
        return $info;
    }
}
