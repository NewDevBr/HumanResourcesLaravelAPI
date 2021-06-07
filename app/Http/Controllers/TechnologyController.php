<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Resources\Technology as TechnologyResource;

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
        $tech = $request->validated();
        Technology::create($tech);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Request $id)
    {
        $tech = Technology::findOrFail($id);
        return new TechnologyResource($tech);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTechnologyRequest $request, $id)
    {
        $tech = Technology::findOrFail($id);
        if(isset($tech))
        {
            $validated = $request->validated();
            $tech->name = $validated["name"];
            if($tech->save()){
                return new TechnologyResource($tech);
            }

        }
        return response()->json(["message"=>"Error trying to update this technology"], 500);
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
