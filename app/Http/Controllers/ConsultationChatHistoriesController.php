<?php

namespace App\Http\Controllers;

use App\Models\ConsultationChatHistories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationChatHistoriesController extends Controller
{
    public function sendMessage(Request $request) {
        $userId = Auth::user()->id;
        $message = $request->message;
        $doctorId = $request->doctor_id;

        $data = ConsultationChatHistories::updateOrCreate(
            ['user_id' => $userId, 'doctor_id' => $doctorId],
            [
                'last_message' => $message,
                'last_message_at' => Carbon::now()
            ]
        );

        $data = ConsultationChatHistories::with(['doctor', 'user'])->get();


        return response()->json([
            'message' => 'Message sent and history updated!',
            'data' => $data
        ], 200);
    }

    public function getHistory() {
        $userId = Auth::user()->id;
        $histories = ConsultationChatHistories::with('doctor.user')
                    ->where('user_id', $userId)
                    ->orderBy('last_message_at', 'desc')
                    ->get();

        return response()->json([
            'message' => 'Chat history retrieved!',
            'data' => $histories
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ConsultationChatHistories::with(['doctor'])->get();
        return response()->json([
            'message' => 'Get data successfully',
            'data' => $data
        ], 200);
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
    public function show(ConsultationChatHistories $consultationChatHistories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConsultationChatHistories $consultationChatHistories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConsultationChatHistories $consultationChatHistories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsultationChatHistories $consultationChatHistories)
    {
        //
    }
}
