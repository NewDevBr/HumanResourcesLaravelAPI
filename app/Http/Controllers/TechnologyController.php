<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Resources\Technology as TechnologyResource;
use DateTime;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Technology::paginate(15);
        return TechnologyResource::collection($admins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {
        $validated = $request->validated();
        $tech = Technology::create($validated);
        return new TechnologyResource($tech);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tech = Technology::findOrFail($id);
        if(isset($tech)){
            return new TechnologyResource($tech);
        }
        return response()->json(["message"=>"Error trying to get this technology", 500]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tech = Technology::findOrFail($id);
        if(isset($tech))
        {
            $tech->name = $request->input("name");
            $currentDate = new DateTime();
            $tech->updated_at = $currentDate;
            if($tech->save()){
                return response()->json(["message"=>"Success to update this thecnology"]);
            }
        } else {
            return response()->json(["message"=>"Error trying to update this technology"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tech = Technology::findOrFail($id);
        if($tech->delete())
        {
            return response()->json(["message"=>"This technology was success deleted"]);
        }
        return response()->json(["message"=>"Error trying to delete this technology"], 500);
    }
}
