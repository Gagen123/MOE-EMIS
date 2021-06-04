<?php

namespace App\Http\Controllers\generalInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use App\Models\generalInformation\OrganizationCompoundDetail;


class CompoundDetailController extends Controller
{
    //
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
    public function saveSchoolCompundDetails(Request $request){
      // dd('my services');
        $data =[
            'organizationId'                => $request->organizationId,
            'thramNo'                       => $request->thramno,
            'plotNo'                        => $request->plotno,
            'pegInformation'                => $request->peginfo,
            'compoundArea'                  => $request->sizecompound,
            'playgroundArea'                => $request->sizeplayground,
            'playgroundAreaUsable'          => $request->playgroundused,
            'status'                        => $request->status,
            'agricultureArea'               => $request->agriculturalarea,
            'agricultureAreaUsed'           => $request->areaused,
            'id'                            => $request->id,
            'created_by'                    => $request['user_id'],
            'updated_by'                    => $request['user_id'],
            'created_at'                    =>date('Y-m-d h:i:s'),
            'updated_at'                    =>date('Y-m-d h:i:s'),
        ];
        //dd($data);
        $response_data = OrganizationCompoundDetail::create($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
   
    public function loadcompoundareadetials($orgId=""){
        $info = OrganizationCompoundDetail::where('organizationId',$orgId)->get();
        return $info;
    }

}
