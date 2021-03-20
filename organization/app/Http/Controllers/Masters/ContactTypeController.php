<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;

use App\Models\Masters\ContactType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class ContactTypeController extends Controller
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
    //region public method

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactTyoe = ContactType::all();
        return $this->successResponse($contactTyoe);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->Id;
        if( $id != null){
            $contactType = ContactType::where('Id', $id)->update($request->all());
            return $this->successResponse($contactType, Response::HTTP_CREATED);
        }else{
            $contactType = ContactType::create($request->all());
            return $this->successResponse($contactType, Response::HTTP_CREATED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contactTyoe = ContactType::findOrFail($id)->delete();
        return $this->successResponse($contactTyoe);
    }

    /** method to get contact type by Id */
    public function getContactTypeById($id){
        $contactType = DisasterType::findOrFail($id);
        return $this->successResponse($contactType);
    }

    //endregion
}
