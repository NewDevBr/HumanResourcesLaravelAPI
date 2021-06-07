<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Helpers\FileHelper;
use App\Http\Requests\{StoreAdminRequest, UpdateImageRequest};
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Admin as AdminResource;

class AdminController extends Controller
{
    private $whereSave = 'public/admin';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::paginate(15);
        return AdminResource::collection($admins);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();
        $validated["pathPhoto"] = FileHelper::save($request, $this->whereSave);
        $validated["password"] = Hash::make($validated["password"]);
        $admin = Admin::create($validated);
        return new AdminResource($admin);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return new AdminResource($admin);
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
        $admin = Admin::findOrFail($id);
        if(isset($admin))
        {
            $admin->name = $request->input("name");
            $admin->email = $request->input("email");
            $admin->post = $request->input("post");
            $admin->password = Hash::make($request->input("password"));
            if($admin->save()){
                return new AdminResource($admin);
            }

        }
        return response()->json(["message"=>"Error trying to update your datas"], 500);
    }


    /**
     * Update an Admin photo
     *
     * @param  \Illuminate\Http\UpdateImageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(UpdateImageRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        if(isset($admin))
        {
            unlink($admin["pathPhoto"]);
            $admin["pathPhoto"] = FileHelper::save($request, $this->whereSave);
            if($admin->save()){
                return response()->json(["message"=>"Your image has success on update"]);
            }
        } else {
            return response()->json(["message"=>"Error trying to update your photo"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if(isset($admin))
        {
            unlink($admin["pathPhoto"]);
            if($admin->delete()){
                return response()->json(["message"=>"This administrator was deleted"]);
            }
        }
        return response()->json(["message"=>"Error trying to delete this user"], 500);
    }
}
