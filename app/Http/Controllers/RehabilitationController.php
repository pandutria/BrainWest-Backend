<?php

namespace App\Http\Controllers;

use App\Models\Rehabilitation;
use App\Models\RehabilitationVideo;
use Exception;
use Illuminate\Http\Request;

class RehabilitationController extends Controller
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
                'data' => Rehabilitation::all()
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
            $data = new Rehabilitation();
            $data->age = $request->age;
            $data->gender = $request->gender;
            $data->medical_status = $request->medical_status;
            $data->time_of_diagnosis = $request->time_of_diagnosis;
            $data->save();

            return response()->json([
                'message' => 'Create data success',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
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
            return response()->json([
                'message' => 'Get data success',
                'data' => Rehabilitation::find($id)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rehabilitation $rehabilitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rehabilitation $rehabilitation)
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
            $data = Rehabilitation::find($id);
            $data->delete();

            return response()->json([
                'message' => 'Delete data success'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
