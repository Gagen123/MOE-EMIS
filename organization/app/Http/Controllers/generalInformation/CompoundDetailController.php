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
    public function loadcompoundareadetials($orgId=""){
        $info = OrganizationCompoundDetail::where('organizationId',$orgId)->get();
        return $info;
    }
    // public function loadcompoundareadetials($orgId=""){ 
    //     $equip = DB::table('organization_compound_details')
    //         ->select('id','organizationId','thramNo',
    //         'plotNo', 'attachments', 'compoundArea','playgroundArea','playgroundAreaUsable',
    //         'status','agricultureArea','agricultureAreaUsed')
    //         ->where('organizationId',$orgId)->get();

    //     return $equip;
    // }

  

    public function saveSchoolCompundDetails(Request $request){
      $id = $request->id;
      if( $id != null)
       {
            $data =[
             'organizationId'                => $request->organizationId,
             'thramNo'                       => $request->thramno,
             'plotNo'                        => $request->plotno,
             'attachments'                   => $request->attachments,
             'compoundArea'                  => $request->sizecompound,
             'playgroundArea'                => $request->sizeplayground,
             'playgroundAreaUsable'          => $request->playgroundused,
             'status'                        => $request->status,
             'statusofplay'                  => $request->statusofplay,
             'agricultureArea'               => $request->agriculturalarea,
             'agricultureAreaUsed'           => $request->areaused,
             'programType'                   => $request->programType,
             'id'                            => $request->id,
             'created_by'                    => $request['user_id'],
             'updated_by'                    => $request['user_id'],
             'created_at'                    =>date('Y-m-d h:i:s'),
             'updated_at'                    =>date('Y-m-d h:i:s'),
            ];
        
         $response_data = OrganizationCompoundDetail::where('id', $id)->update($data);
         return $this->successResponse($response_data, Response::HTTP_CREATED);
        }
        else
        {   
            $data =[
                'organizationId'                => $request->organizationId,
                'thramNo'                       => $request->thramno,
                'plotNo'                        => $request->plotno,
                'attachments'                   => $request->attachments,
                'compoundArea'                  => $request->sizecompound,
                'playgroundArea'                => $request->sizeplayground,
                'playgroundAreaUsable'          => $request->playgroundused,
                'status'                        => $request->status,
                'statusofplay'                  => $request->statusofplay,
                'agricultureArea'               => $request->agriculturalarea,
                'agricultureAreaUsed'           => $request->areaused,
                'programType'                   => $request->programType,
                'id'                            => $request->id,
                'created_by'                    => $request['user_id'],
                'updated_by'                    => $request['user_id'],
                'created_at'                    =>date('Y-m-d h:i:s'),
                'updated_at'                    =>date('Y-m-d h:i:s'),
            ];
            //  dd($data);
        }
        $response_data = OrganizationCompoundDetail::create($data);
        
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    
    }
    public function getEditCompoundDetail($compId=""){
       // dd('from microservice');
        $info = OrganizationCompoundDetail::where('id',$compId)->first();
        return $info;
    }
    
   
    

}
