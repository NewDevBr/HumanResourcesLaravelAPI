<?php

namespace App\Http\Controllers;

use App\Models\Diploma;
use Illuminate\Http\Request;
use App\Http\Resources\Diploma as DiplomaResource;
use App\Http\Requests\StoreDiplomaRequest;

class DiplomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diploma = Diploma::paginate(15);
        return new DiplomaResource($diploma);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiplomaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diploma  $diploma
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diploma = Diploma::findOrFail($id);
        if(isset($diploma))
        {
            return new DiplomaResource($diploma);
        }
        return response()->json(["message"=>"Error occurred trying to get this diploma"], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diploma  $diploma
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDiplomaRequest $request, $id)
    {
        $diploma = Diploma::findOrFail($id);
        if(isset($diploma))
        {
            $validated = $request->validated();
            $diploma->course = $validated['course'];
            $diploma->institution = $validated['institution'];
            $diploma->inital_date = $validated['initialDate'];
            $diploma->final_date = $validated['finalDate'];
            if($diploma->save())
            {
                return new DiplomaResource($diploma);
            }
        }
        return response()->json(["message" => "Error trying to update this diploma"], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diploma  $diploma
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diploma = Diploma::findOrFail($id);
        if(isset($diploma))
        {
            if($diploma->delete())
            {
                return response()->json(["message"=>"This diploma was success deleted"]);
            }
        }
        return response()->json(["message"=>"Error occurred while try delete this diploma"], 500);
    }
}
