<?php

namespace App\Http\Controllers;

use App\Models\CommunityGroup;
use Exception;
use Illuminate\Http\Request;

class CommunityGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $data = CommunityGroup::with('user')->get();
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
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityGroup $communityGroup)
    {
        //
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
    public function destroy(CommunityGroup $communityGroup)
    {
        //
    }
}
