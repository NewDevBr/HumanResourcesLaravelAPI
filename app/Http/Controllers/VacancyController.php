<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Vacancy as VacancyResource;
use App\Models\Vacancy;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Vacancy::paginate(15);
        return VacancyResource::collection($admins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validated();
        $vacancy = Vacancy::create($validated);
        return new VacancyResource($vacancy);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        return new VacancyResource($vacancy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->title = $request->input("title");
        $vacancy->description = $request->input("description");
        $vacancy->remote = $request->input("remote");
        $vacancy->hiring = $request->input("hiring");
        $vacancy->admin_id = $request->input("admin_id");
        if($vacancy->save()){
            return new Vacancy($vacancy);
        }
        return response()->json(["msg"=>"Error trying to update vacancy datas"], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        if(isset($vacancy))
        {
            if($vacancy->delete()){
                return response()->json(["msg"=>"This vacancy was deleted"]);
            } else {
                return response()->json(["msg"=>"Error trying to delete this vacancy"], 500);
            }
        }
        return response()->json(["msg"=>"Error trying to delete this vacancy"], 500);
    }
}
