<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Vacancy as VacancyResource;
use App\Models\{Vacancy, CandidatesVacancy, Candidate};
use App\Http\Requests\StoreVacancyRequest;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::with(['technologies', 'admin'])->paginate(6);
        return $vacancies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreVacancyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVacancyRequest $request)
    {
        $validated = $request->validated();
        $vacancy = Vacancy::create($validated);
        $vacancy->technologies()->attach($request->input('technologies'));
        return new VacancyResource($vacancy);
    }

    public function subscribe()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacancy = Vacancy::with(['technologies', 'admin'])->where('id', $id)->get()->first();
        if ($vacancy) {
            return $vacancy;
        }
        return response()->json(["message" => "This vacancy not exists, please try get a valid vacancy"], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVacancyRequest $request, $id)
    {
        $vacancy = Vacancy::with('technologies')->where('id', $id)->get()->first();
        if ($vacancy) {
            $vacancy->title = $request->input("title");
            $vacancy->description = $request->input("description");
            $vacancy->remote = $request->input("remote");
            $vacancy->hiring = $request->input("hiring");
            $vacancy->admin_id = $request->input("admin_id");
            $technologies = $request->input('technologies');
            $vacancy->technologies()->sync($technologies);
            if ($vacancy->save()) {
                return $vacancy;
            } else {
                return response()->json(["message" => "Error trying to update vacancy datas"], 500);
            }
        }
        return response()->json(["message" => "Error trying to update vacancy datas"], 500);
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
        if ($vacancy) {
            if ($vacancy->delete()) {
                return response()->json(["message" => "This vacancy was deleted"]);
            } else {
                return response()->json(["message" => "Error trying to delete this vacancy"], 500);
            }
        }
        return response()->json(["message" => "Error trying to delete this vacancy"], 500);
    }

    /**
     * Candidate apply vacancy.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $request)
    {
        $result = CandidatesVacancy::where($request->all())->get()->first();
        if(!$result){
            return CandidatesVacancy::create($request->all());
        } else {
            return response()->json(["message" => "You are already registered for this vacancy"], 500);
        }
    }

    /**
     * Candidate apply vacancy.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applicable(Request $request, $id)
    {
        $vacancies = Vacancy::with(['technologies', 'admin','candidates'])->paginate(6);
        if($vacancies){
            return $vacancies;
        }
        return response()->json(["message" => "Error trying to get applicable vacancies of this candidate"], 500);
    }

    /**
     * Candidate apply vacancy.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applied(Request $request, $id)
    {
        $candidate = Candidate::find($id);
        if ($candidate) {
            return $candidate->vacancies;
        } else {
            return response()->json(["message" => "Error trying to get applied vacancies of this candidate"], 500);
        }
    }
}
