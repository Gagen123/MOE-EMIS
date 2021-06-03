<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Projection;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationClassStream;

class ProjectionsController extends Controller
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

    public function saveProjections(Request $request){

        $data =[
            'organizationId'            =>  $request['organizationId'],
            'class'                      =>  $request['std_class'],
            'stream'                    => $request['stream'],
            'projections'               => $request['projections'],
            'remarks'                      =>  $request['remarks'],
            'user_id'                   =>  $request['user_id']
        ];

        $response_data = Projection::create($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadProjections($orgId=""){
        $info = Projection::where('organizationId',$orgId)->get();
        return $info;
    }
}
