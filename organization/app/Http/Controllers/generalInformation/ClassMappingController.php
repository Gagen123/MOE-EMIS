<?php

namespace App\Http\Controllers\generalInformation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\generalInformation\ClassMapping;
use Illuminate\Support\Facades\DB;

class ClassMappingController extends Controller
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

    public function saveClassMapping(Request $request){
        $classes=$request->class;
        foreach ($classes as $cls){
            $class = [
                'organizationId'    => $request->school,
                'classId'           => $cls,
                'created_by'        => $request->user_id,
                'created_at'        => date('Y-m-d h:i:s'),
            ];
            
            $cla = ClassMapping::create($class);
        }

        return $this->successResponse($cla, Response::HTTP_CREATED);
    }
}
