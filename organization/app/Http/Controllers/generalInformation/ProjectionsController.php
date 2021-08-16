<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Projection;
use App\Models\generalInformation\Feeder;

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
                    $remarks="";
                    if(isset($item['remarks'])){
                        $remarks=$item['remarks'];
                    }
                    $projection = array(
                        'organizationId'                        =>  $organizationId,
                        'academicYear'                          =>  $request['academicYear'],
                        'ProjectionNo'                          =>  $item['ProjectionNo'],
                        'class'                                 =>  $item['class'],
                        'remarks'                               =>  $remarks,
                        'updated_by'                            =>  $request->user_id,
                        'created_at'                            =>  date('Y-m-d h:i:s')
                    );
                 $localpro = Projection::create($projection);
                }
                return $this->successResponse($localpro, Response::HTTP_CREATED);
            }

    }

    public function saveFeeders(Request $request){
        $id = $request->id;

        if( $id != null){
            foreach ($request->items_received as $i=> $item){
                $feeder = array(
                    'feederschool'              => $request->feederschool,
                    'class'                     => $request->class,
                    'parentschool'              =>  $item['parentschool'],
                    'remarks'                   =>  $request['remarks'],
                    'created_by'                =>  $request->user_id,
                    'updated_at'                =>  date('Y-m-d h:i:s')

                );
                $spo = Feeder::where('id', $id)->update($feeder);
                return $this->successResponse($feeder, Response::HTTP_CREATED);
            }

            }else{
                foreach ($request->items_received as $i=> $item){
                    $feeder = array(
                        'feederschool'              => $request->feederschool,
                        'class'                     => $request->class,
                        'parentschool'              =>  $item['parentschool'],
                        'remarks'                   =>  $request['remarks'],
                        'created_by'                =>  $request->user_id,
                        'created_at'                =>  date('Y-m-d h:i:s')

                    );
                    try{
                        $localpro = Feeder::create($feeder);

                        } catch(\Illuminate\Database\QueryException $ex){
                            dd($ex->getMessage());
                            // Note any method of class PDOException can be called on $ex.
                        }
                }
                return $this->successResponse($localpro, Response::HTTP_CREATED);
            }

    }

    public function loadProjections($orgId=""){
        $projections = DB::table('organization_projections')
                        ->join('organization_class_streams', 'organization_class_streams.id','=','organization_projections.class')
                        ->join('classes', 'classes.id','=','organization_class_streams.classId')
                        ->select('organization_projections.id', 'organization_projections.academicYear','organization_projections.ProjectionNo',
                                    'classes.class as class')
                        ->where('organization_projections.organizationId', $orgId)
                        ->get();
        return $projections;
    }

    public function loadFeeders($dzoId=""){
        $feeder = DB::table('organization_feeder')
                        ->join('organization_details as t1', 't1.id','=','organization_feeder.feederschool')
                        ->join('organization_details as t2', 't2.id','=','organization_feeder.parentschool')
                        ->select('organization_feeder.id', 'organization_feeder.class', 't1.name as feeder_name','t2.name as parent_name')
                        ->where('t1.dzongkhagId', $dzoId)
                        ->get();
        return $feeder;
    }
}
