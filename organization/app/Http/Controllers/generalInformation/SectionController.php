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


    public function getClassByOrganizationId($orgId){
        $class = DB::table('class_mappings as a')
            ->join('classes as b', 'b.id', '=', 'a.classId')
            ->select('a.classId as id', 'b.class as class')->where('organizationId', $orgId)->get();
        return $class;
    }
}
