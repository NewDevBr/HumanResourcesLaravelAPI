<?php

namespace App\Http\Controllers;

use App\Models\Diploma;
use Illuminate\Http\Request;
use App\Http\Resources\Diploma as DiplomaResource;
use App\Http\Requests\StoreDiplomaRequest;
use App\Models\{Candidate, CandidateDiploma};
use Illuminate\Support\Facades\DB;
use DateTime;

class DiplomaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiplomaRequest $request, $idCandidate)
    {

        $validated = $request->validated();
        $diploma = Diploma::create($validated);
        $result = CandidateDiploma::create([
            "candidate_id" => $idCandidate,
            "diploma_id" => $diploma["id"]
        ]);
        if ($result) {
            return response(["message" => "Diploma successfully created"], 200);
        }
        return response(["message" => "Error trying to create this diploma"], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diploma  $diploma
     * @return \Illuminate\Http\Response
     */
    public function show($idCandidate)
    {
        $candidate = Candidate::find($idCandidate);
        $diplomas = $candidate->diplomas;
        if ($diplomas) {
            return $diplomas;
        }
        return response()->json(["message" => "Error occurred trying to get diplomas"], 500);
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
        if ($diploma) {
            $validated = $request->validated();
            $diploma->course = $validated['course'];
            $diploma->institution = $validated['institution'];
            $diploma->initial_date = $validated['initial_date'];
            $diploma->final_date = $validated['final_date'];
            $diploma->updated_at = new DateTime();
            if ($diploma->save()) {
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
        if ($diploma) {
            if ($diploma->delete()) {
                return response()->json(["message" => "This diploma was success deleted"]);
            }
        }
        return response()->json(["message" => "Error occurred while try delete this diploma"], 500);
    }
}
