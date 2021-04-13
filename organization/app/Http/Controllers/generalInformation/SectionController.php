<?php

namespace App\Http\Controllers\generalInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Section;
use App\Models\generalInformation\SectionDetails;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
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
     * method to save section
    */
    public function saveSection(Request $request){

        $section = [
                'organizationId'          => $request['school'],
                'classId'                 => $request['classes'],
                'streamId'                => $request['stream'],
            ];
        $sectionDetails = [
                'users'        => $request['users'],
            ];

        $sec = Section::create($section);
        $sectionId = DB::table('sections')->orderBy('id','desc')->limit(1)->pluck('id');

        foreach ($request->input('users') as $i => $user){
            $section_details = array(
                'sectionId'=>$sectionId[0],
                'section'=>$user['section'],
        );
            $sec = SectionDetails::create($section_details);
        }
        return $this->successResponse($sec, Response::HTTP_CREATED);
    }

    /**
     * method to get class by organization Id
     */
    public function getClassByOrganizationId($orgId){
        $class = DB::table('organization_class_streams as a')
            ->join('classes as b', 'b.id', '=', 'a.classId')
            ->select('a.classId as id', 'b.class as class')->where('organizationId', $orgId)->get();
        return $class;
    }

    /**
     * method to get stream by class Id
     */
    public function getStreamByClassId($classId){
        $stream = DB::table('organization_class_streams as a')
            ->join('streams as b', 'b.id', '=', 'a.streamId')
            ->select('a.streamId as id', 'b.stream as stream')->where('a.classId', $classId)->get();
        return $stream;
    }
}
