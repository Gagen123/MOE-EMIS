<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Projection;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationClassStream;  
use App\Models\Masters\Classes;

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
        $id = $request->id;
        if( $id != null){
            $projection = [
                'organizationId'                        =>  $request['organizationId'],
                'academicYear'                          =>  $request['academicYear'],
                'ProjectionNo'                          =>  $request['ProjectionNo'],
                'class'                                 =>  $request['class'],
                'ProjectionNo'                          =>  $request['ProjectionNo'],
                'remarks'                               =>  $request['remarks'],
                'updated_by'                            =>  $request->user_id,
                'created_at'                            =>  date('Y-m-d h:i:s')
            ];
            $spo = Projection::where('id', $id)->update($projection);
            return $this->successResponse($spo, Response::HTTP_CREATED);

            }else{
                $organizationId  = $request['organizationId'];
                foreach ($request->items_received as $i=> $item){
                    $projection = array(
                        'organizationId'                        =>  $organizationId,
                        'academicYear'                          =>  $request['academicYear'],
                        'ProjectionNo'                          =>  $item['ProjectionNo'],
                        'class'                                 =>  $item['class'],
                        'remarks'                               =>  $item['remarks'],
                        'updated_by'                            =>  $request->user_id,
                        'created_at'                            =>  date('Y-m-d h:i:s')
                    );
                 $localpro = Projection::create($projection);
                }
                return $this->successResponse($localpro, Response::HTTP_CREATED);
            }

    }

    public function loadProjections($orgId=""){
        //dd($orgId);
    //     $equip = DB::table('organization_projections as a')
    //     ->join('classes as b', 'a.class', '=', 'b.id')
    //     ->select('a.id as id','a.organizationId as organizationId','b.class as class', 'a.academicYear as academicYear','a.ProjectionNo as ProjectionNo', 'a.remarks as remarks'
    //    )->where('organizationId',$orgId)->get();

    //     return $equip;
      
        $info = Projection::where('organizationId',$orgId)->get();
        return $info;
    }
}
