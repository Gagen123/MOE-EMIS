<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\restructuring\Closure;

class ClosureController extends Controller
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
    
    public function saveClosure(Request $request){
        $id = $request->id;
        $closure =[
            'code'                     =>  $request['code'],
            'name'                     =>  $request['name'],
            'category'                 =>  $request['category'],
            'level'                    =>  $request['level'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'gewog'                    =>  $request['gewog'],
            'chiwog'                   =>  $request['chiwog'],
            'location'                 =>  $request['location'],
            'geoPoliticallyLocated'    =>  $request['geoLocated'],
            'senSchool'                =>  $request['senSchool'],
            'reason'                   =>  $request['reason'],
            'remark'                   =>  $request['remark'],
            'id'                       =>  $request['id'],
        ];
        
        $cls = Closure::create($closure);
        return $this->successResponse($cls, Response::HTTP_CREATED);
    }
}
