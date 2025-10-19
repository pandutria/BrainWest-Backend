<?php

namespace App\Http\Controllers;

use App\Models\CommunityGroupMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityGroupMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $user = Auth::user();

            $data = new CommunityGroupMember();
            $data->group_id = $request->group_id;
            $data->user_id = $user->id;
            $data->save();
            $data = CommunityGroupMember::with(['group', 'user'])->find($data->id);

            return response()->json([
                'message' => 'Join community successfully',
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
            $data = CommunityGroupMember::find($id);
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
    public function edit(CommunityGroupMember $communityGroupMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityGroupMember $communityGroupMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityGroupMember $communityGroupMember)
    {
        //
    }
}
