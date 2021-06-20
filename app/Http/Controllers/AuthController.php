<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\{Admin, Candidate};
use App\Http\Requests\{PostLoginRequest};

class AuthController extends Controller
{
 
    public function loginAdmin(PostLoginRequest $request)
    {
        $validated = $request->validated();
        $admin = Admin::where('email', $validated['email'])->first();
        if(isset($admin))
        {
            if(Hash::check($validated['password'], $admin['password']))
            {
                $token = $admin->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'data' => $admin
                ]);
            }
            return response()->json(["message"=>"Error trying to login as admin"], 401);
        } else {
            return response()->json(["message"=>"Error trying to login as admin"], 401);
        }
    }

    public function loginCandidate(PostLoginRequest $request)
    {
        $validated = $request->validated();
        $candidate = Candidate::where('email', $validated['email'])->first();
        if(isset($candidate))
        {
            if(Hash::check($validated['password'], $candidate['password']))
            {
                $token = $candidate->createToken('auth_token', [
                    'candidateId:' . $candidate['id'],
                    'userType:candidate',
                    'updateCandidate',
                    'showCandidate',
                    'updatePhotoCandidate',
                    'destroyCandidate' ,
                    'createTech',
                    'updateTech',
                    'readTech',
                    'createDiploma',
                    'updateDiploma',
                    'deleteDiploma',
                    'readDiploma',
                    'subscribeVacancy' ,
                    'unsubscribeVacancy'
                ])->plainTextToken;
                
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'data' => $candidate
                ]);
            }
        } else {
            return response()->json(["message"=>"Error trying to login as candidate"], 401);
        }
    }

    public function revokeToken(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
