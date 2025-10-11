<?php

namespace App\Http\Controllers;

use App\Models\RehabilitationVideo;
use Exception;
use Illuminate\Http\Request;

class RehabilitationVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            return response()->json([
                'message' => 'Get data success',
                'data' => RehabilitationVideo::all()
            ], 200);
        } catch (Exception $e) {
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
            $data = new RehabilitationVideo();
            $data->title = $request->title;
            $data->link = $request->link;
            $data->thumbnail = $request->thumbnail;
            $data->text = $request->text;
            $data->rehabilitation_id = $request->rehabilitation_id;

            $data->save();

            return response()->json([
                'message' => 'Create data success',
                'data' => $data
            ], 500);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RehabilitationVideo $rehabilitationVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RehabilitationVideo $rehabilitationVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RehabilitationVideo $rehabilitationVideo)
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
            $data = RehabilitationVideo::find($id);
            $data->delete();
            $data->save();

            return response()->json([
                'message' => 'Delete data success',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
