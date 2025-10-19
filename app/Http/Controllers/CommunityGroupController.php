<?php

namespace App\Http\Controllers;

use App\Models\CommunityGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $data = CommunityGroup::with('admin')->get();
            return response()->json([
                'message' => 'Get data successfully',
                'data' => $data
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $admin = Auth::user();

            $data = new CommunityGroup();
            $data->name = $request->name;
            $data->description = $request->description;
            $data->image_logo = $request->image_logo;
            $data->image = $request->image;
            $data->admin_id = $admin->id;
            $data->save();

            $data = CommunityGroup::with('admin')->find($data->id);

            return response()->json([
                'message' => 'Create data successfully',
                'data' => $data
            ], 201);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $data = CommunityGroup::with('admin')->find($id);
            return response()->json([
                'message' => 'Get data successfully',
                'data' => $data
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityGroup $communityGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityGroup $communityGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $data = CommunityGroup::find($id);
            $data->delete();

            return response()->json([
                'message' => 'Delete data successfully',
                'data' => $data
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
