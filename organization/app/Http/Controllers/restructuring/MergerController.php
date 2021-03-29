<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\establishment\Establishment;

class MergerController extends Controller
{
    public function saveMerger(Request $request){
        $id = $request->id;
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
            'applicationNo'                 =>  1,
            'service'                       =>  "Merger",
            'oldOrganizationId1'            =>  $request['orgId1'],
            'oldOrganizationId2'            =>  $request['orgId2'],
            'year'                          =>  $request['year'],
            ];
        $merge = Establishment::create($merger);
        return $this->successResponse($merge, Response::HTTP_CREATED);
    }
}
