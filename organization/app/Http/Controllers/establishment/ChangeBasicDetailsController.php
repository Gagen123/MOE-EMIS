<?php

namespace App\Http\Controllers\establishment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationClassStream;

class ChangeBasicDetailsController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }


    /**
     * method to save change basic details
     */
    public function saveChangeBasicDetails(Request $request){
        $id = $request->id;
            $change = [
            'proposedName'                  =>      $request['name'],
            'category'                      =>      $request['category'],
            'levelId'                       =>      $request['level'],
            'dzongkhagId'                   =>      $request['dzongkhag'],
            'gewogId'                       =>      $request['gewog'],
            'chiwogId'                      =>      $request['chiwog'],
            'locationId'                    =>      $request['locationType'], 
            'isGeopoliticallyLocated'       =>      $request['geoLocated'],
            'isSenSchool'                   =>      $request['senSchool'],
            'parentSchoolId'                =>      $request['parentSchool'],
            'isColocated'                   =>      $request['coLocated'],
            'cid'                           =>      $request['cid'],
            'fullName'                      =>      $request['name'],
            'phoneNo'                       =>      $request['phoneNo'],
            'email'                         =>      $request['email'],
            'status'                        =>      "Pending",
            'applicationNo'                 =>      1,
            'service'                       =>      "Change Basic Details",
            ];
            $establishment = ApplicationDetails::create($change);

        return $this->successResponse($establishment, Response::HTTP_CREATED);
    }

    /**
     * method to save sport details
     */
    public function saveChangeClass(Request $request){
        $classes=$request->class;
        $classStream='';
        $inserted_class="";
        if($request->stream!="" && sizeof($request->stream)>0){
            foreach ($request->stream as $stm){
                foreach ($classes as $cls){
                    if(explode('##',$stm)[0]==$cls){
                        $classStream = [
                            'applicationNo'   => 1,
                            'classId'           =>$cls,
                            'streamId'          =>explode('##',$stm)[1],
                            'created_by'           =>$request->user_id,
                            'created_at'        =>date('Y-m-d h:i:s'),
                            
                        ];
                        if(strpos($inserted_class,$cls)===false){
                            $inserted_class.=$cls;
                        }
                        $class = ApplicationClassStream::create($classStream);
                    }
                }
            }
        }
        foreach ($classes as $cls){
            if(strpos($inserted_class,$cls)===false){
                $classStream = [
                    'applicationNo'   => 1,
                    'classId'           => $cls,
                    'created_by'           =>$request->user_id,
                    'created_at'        =>date('Y-m-d h:i:s'),
                ];
                if($classStream != ""){
                    $class = ApplicationClassStream::create($classStream);
                }
            }
        }
        return $this->successResponse($class, Response::HTTP_CREATED);
    }
}
