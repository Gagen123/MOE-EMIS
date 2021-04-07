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
use App\Models\establishment\ApplicationDetails;
use App\Models\establishment\ApplicationClassStream;
use App\Models\establishment\ApplicationProprietorDetails;
use Illuminate\Support\Facades\DB;


class EstablishmentController extends Controller
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
        $applicationNo = 'establishment_' . '0001';

        if($id != null){
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
                'status'                        =>  $request['status'],
                'applicationNo'                 =>  $applicationNo,
                'service'                       =>  "New Establishment",
                'updated_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s')
                ];

                // update proprietor details if category is private
                if($request['category'] == 0){
                   
                    $pvtDetails = [
                        'applicationId'            =>  1,
                        'cid'                      =>  $request['cid'],
                        'fullName'                 =>  $request['name'],
                        'phoneNo'                  =>  $request['phoneNo'],
                        'email'                    =>  $request['email'],
                        'updated_by'               =>  $request->user_id,
                        'created_at'               =>  date('Y-m-d h:i:s')
                        ];
                    
                    $establishment = ApplicationProprietorDetails::where('applicationId', 1)->update($pvtDetails);
                }

                $establishment = ApplicationDetails::where('id', $id)->update($estd);
                return $this->successResponse($establishment, Response::HTTP_CREATED);
        }else{
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
                'isColocated'                   =>  $request['coLocatedParent'],
                'cid'                           =>  $request['cid'],
                'fullName'                      =>  $request['name'],
                'phoneNo'                       =>  $request['phoneNo'],
                'email'                         =>  $request['email'],
                'status'                        =>  "Pending",
                'applicationNo'                 =>  $applicationNo,
                'service'                       =>  "New Establishment",
                'created_by'                    =>  $request->user_id,
                'created_at'                    =>  date('Y-m-d h:i:s')
                ];
                
                // save proprietor details if category is private
                if($request['category'] == 0){
                    $pvtDetails = [
                        'applicationId'            =>  1,
                        'cid'                      =>  $request['cid'],
                        'fullName'                 =>  $request['name'],
                        'phoneNo'                  =>  $request['phoneNo'],
                        'email'                    =>  $request['email'],
                        'created_by'               =>  $request->user_id,
                        'created_at'               =>  date('Y-m-d h:i:s')
                        ];
                    
                    $establishment = ApplicationProprietorDetails::create($pvtDetails);
                }

                $establishment = ApplicationDetails::create($estd);
                return $this->successResponse($establishment, Response::HTTP_CREATED);
        }
    }

    /**
     * method to save class and stream
     */
    public function saveClassStream(Request $request){
        $classes=$request->class;
        $classStream='';
        $inserted_class="";

        $applicationNo = DB::table('application_details as a')
                         ->select('a.applicationNo')
                         ->where('created_by',$request->user_id)
                         ->where('status', 'pending')
                         ->get();
                       
        if($request->stream!="" && sizeof($request->stream)>0){
            foreach ($request->stream as $stm){
                foreach ($classes as $cls){
                    if(explode('##',$stm)[0]==$cls){
                        $classStream = [
                            'applicationNo'     => $applicationNo[0]->applicationNo,
                            'classId'           => $cls,
                            'streamId'          => explode('##',$stm)[1],
                            'created_by'        => $request->user_id,
                            'created_at'        => date('Y-m-d h:i:s'),
                            
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
                    'applicationNo'     => $applicationNo[0]->applicationNo,
                    'classId'           => $cls,
                    'created_by'        => $request->user_id,
                    'created_at'        => date('Y-m-d h:i:s'),
                ];
                if($classStream != ""){
                    $class = ApplicationClassStream::create($classStream);
                }
            }
        }
        $array = ['status' => $request->status];
        DB::table('application_details')->where('applicationNo',$applicationNo[0]->applicationNo)->update($array);

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

    /**
     * method to load organization details
     */
    public function loadOrganizationDetails($user_id=""){
        return $this->successResponse(ApplicationDetails::where('created_by',$user_id)->where('status','Pending')->first());
    }

    /**
     * method to load organization details
     */
    public function loadProprietorDetails(){
        return $this->successResponse(ApplicationProprietorDetails::all());
    }
}