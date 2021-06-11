<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreCandidateRequest, UpdateImageRequest};
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Resources\Candidate as CandidateResource;
use App\Helpers\FileHelper;
use Illuminate\Support\Facades\Hash;

class CandidateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::paginate(15);
        return CandidateResource::collection($candidates);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCandidateRequest $request)
    {
        $validated = $request->validated();
        $validated["pathPhoto"] = FileHelper::save($request);
        $validated["password"] = Hash::make($validated["password"]);
        $admin = Candidate::create($validated);
        return new CandidateResource($admin);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Candidate::findOrFail($id);
        return new CandidateResource($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);
        if(isset($candidate))
        {
            $candidate->name = $request->input("name");
            $candidate->titration = $request->input("titration");
            $candidate->birthDate = $request->input("birthDate");
            $candidate->email = $request->input("email");
            $candidate->password = $request->input("password");
            $candidate->github = $request->input("github");
            $candidate->linkedin = $request->input("linkedin");
            $candidate->notify_email = $request->input("notify_email");
            $candidate->password = Hash::make($request->input("password"));
            if($candidate->save()){
                return new CandidateResource($candidate);
            }
        }
        return response()->json(["message"=>"Error trying to update your datas"], 500);
    }

    public function updatePhoto(UpdateImageRequest $request, $id)
    {
        $candidate = Candidate::findOrFail($id);
        if(isset($candidate))
        {
            unlink(FileHelper::getFilePath($candidate["pathPhoto"]));
            $candidate["pathPhoto"] = FileHelper::save($request);
            if($candidate->save()){
                return response()->json(["message"=>"Your image has success on update"]);
            }
        }
        return response()->json(["message"=>"Error trying to update your photo"], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        if(isset($candidate))
        {
            unlink(FileHelper::getFilePath($candidate["pathPhoto"]));
            if($candidate->delete()){
                return response()->json(["message"=>"This candidate was deleted"]);
            }
        }
        return response()->json(["message"=>"Error trying to delete this candidate account"], 500);
    }
}
