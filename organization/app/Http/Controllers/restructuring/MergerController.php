<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\establishment\Establishment;
use App\Models\establishment\EstablishmentClassStream;

class MergerController extends Controller
{

    public function saveMerger(Request $request){

        $id = $request->id;
        $classes=$request->class;
        $classStream='';
        $inserted_class="";
        $applicationNo = 'merger_' . '0001';

        $merger = [
            'proposedName'                  =>  $request['name'],
            'category'                      =>  $request['category'],
            'levelId'                       =>  $request['level'],
            'dzongkhagId'                   =>  $request['dzongkhag'],
            'gewogId'                       =>  $request['gewog'],
            'chiwogId'                      =>  $request['chiwog'],
            'locationId'                    =>  $request['location'], 
            'isGeopoliticallyLocated'       =>  $request['geoLocated'],
            'isSenSchool'                   =>  $request['senSchool'],
            'parentSchoolId'                =>  $request['parentSchool'],
            'isColocated'                   =>  $request['design'],
            'cid'                           =>  $request['cid'],
            'fullName'                      =>  $request['name'],
            'phoneNo'                       =>  $request['phoneNo'],
            'email'                         =>  $request['email'],
            'status'                        =>  "Pending",
            'applicationNo'                 =>  $applicationNo,
            'service'                       =>  "Merger",
            'oldOrganizationId1'            =>  $request['orgId1'],
            'oldOrganizationId2'            =>  $request['orgId2'],
            'year'                          =>  $request['year'],
            'class'                         =>  $request['class'],
            'stream'                        =>  $request['stream'],
            ];
            $merge = Establishment::create($merger);
            // to save class and stream
            if($request->stream!="" && sizeof($request->stream)>0){
                foreach ($request->stream as $stm){
                    foreach ($classes as $cls){
                        if(explode('##',$stm)[0]==$cls){
                            $classStream = [
                                'applicationNo'     => $applicationNo,
                                'classId'           => $cls,
                                'streamId'          => explode('##',$stm)[1],
                                'created_by'        => $request->user_id,
                                'created_at'        => date('Y-m-d h:i:s'),
                                
                            ];
                            if(strpos($inserted_class,$cls)===false){
                                $inserted_class.=$cls;
                            }
                            $merge = EstablishmentClassStream::create($classStream);
                        }
                    }
                }
            }
            foreach ($classes as $cls){
                if(strpos($inserted_class,$cls)===false){
                    $classStream = [
                        'applicationNo'     => $applicationNo,
                        'classId'           => $cls,
                        'created_by'        => $request->user_id,
                        'created_at'        => date('Y-m-d h:i:s'),
                    ];
                    if($classStream != ""){
                        $merge = EstablishmentClassStream::create($classStream);
                    }
                }
            }
        return $this->successResponse($$merge, Response::HTTP_CREATED);
    }

}
