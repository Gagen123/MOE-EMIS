<?php

namespace App\Http\Controllers\establishment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\Masters\Level;
use App\Models\Masters\Location;
use App\Models\Masters\Classes;
use App\Models\Masters\Stream;
use App\Models\establishment\Establishment;
use App\Models\establishment\EstablishmentClassStream;

class EstablishmentController extends Controller
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

    /**
     * method to get level in dropdown
     */
    public function getLevelInDropdown(){
        return Level::get(['id','name']);
    }

    /**
     * method to get location in dropdown
     */
    public function getLocationInDropdown(){
        return Location::get(['id','name']);
    }

    /**
     * method to save sport details
     */
    public function saveEstablishment(Request $request){
        $id = $request->id;
            $estd = [
            'proposedName'                  =>  $request['proposedName'],
            'category'                      =>  $request['category'],
            'levelId'                       =>  $request['level'],
            'dzongkhagId'                   =>  $request['dzongkhag'],
            'gewogId'                       =>  $request['gewog'],
            'chiwogId'                      =>  $request['chiwog'],
            'locationId'                    =>  $request['locationType'], 
            'isGeopoliticallyLocated'       =>  $request['geopolicaticallyLocated'],
            'isSenSchool'                   =>  $request['senSchool'],
            'parentSchoolId'                =>  $request['parentSchool'],
            'isColocated'                   =>  $request['design'],
            'cid'                           =>  $request['cid'],
            'fullName'                      =>  $request['name'],
            'phoneNo'                       =>  $request['phoneNo'],
            'email'                         =>  $request['email'],
            'statusId'                      =>  1,
            'applicationNo'                 =>  1,
            ];
            $establishment = Establishment::create($estd);

        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    /**
     * method to save sport details
     */
    public function saveClassStream(Request $request){
        $classes=$request->class;
        $classStream='';
            foreach ($classes as $cls){
                if($request->stream!="" && sizeof($request->stream)>0){
                    foreach ($request->stream as $stm){
                        if(explode('##',$stm)[0]==$cls){
                            $classStream = [
                                'establishmentId'   => 1,
                                'classId'           =>$cls,
                                'streamId'          =>$stm,
                            ];
                        }else{
                            $classStream = [
                                'establishmentId'   => 1,
                                'classId'           => $cls,
                            ];
                        }
                    }
                }
                else{
                    $classStream = [
                        'establishmentId'   => 1,
                        'classId'           => $cls,
                    ];
                }
                if($classStream != ""){
                    $class = EstablishmentClassStream::create($classStream);
                }
            }
        return $this->successResponse($class, Response::HTTP_CREATED);
    }

    /**
     * method to get class in checkbox
     */
    public function getClass(){
        return Classes::get(['id','class']);
    }

    /**
     * method to get stream in checkbox
     */
    public function getStream(){
        return Stream::get(['id','stream']);
    }
}