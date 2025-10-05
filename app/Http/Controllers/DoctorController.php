<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Exception;
use Illuminate\Http\Request;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $data = Doctor::with('user')->get();
            return response()->json([
                'message' => 'Get data successfully!',
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
            $data = new Doctor();
            $data->user_id = $request->user_id;
            $data->hospital = $request->hospital;
            $data->specialization = $request->specialization;
            $data->image = $request->image;
            $data->rating = $request->rating;
            $data->experience = $request->experience;
            $data->save();

            $data = Doctor::with('user')->find($data->id);

            return response()->json([
                'message' => 'Create data successfully!',
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
            $data = Doctor::with('user')->find($id);
            return response()->json([
                'message' => 'Get data successfully!',
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
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
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
            $data = Doctor::find($id);
            return response()->json([
                'message' => 'Delete data successfully!',
                'data' => $data
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
