<?php

namespace App\Http\Controllers;

use App\Models\CommunityGroupMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityGroupMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function sendMessage(Request $request) {
        try {
            $userId = Auth::user()->id;
            $message = $request->message;
            $groupId = $request->group_id;

            $data = CommunityGroupMessage::updateOrCreate([
                'sender_id' => $userId,
                'group_id' => $groupId,
                'message' => $message
            ]);

            $data = CommunityGroupMessage::with(['group.admin', 'sender'])->find($data->id);

            return response()->json([
                'message' => 'Post message success',
                'data' => $data
            ], 201);

        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

public function getHistory() {
    try {
        $userId = Auth::user()->id;

        $histories = CommunityGroupMessage::with(['group.admin', 'sender'])
            ->where('sender_id', $userId)
            ->get();

        // Tambahkan default message jika kosong
        $histories = $histories->map(function($history) {
            if (!$history->message) {
                $history->message = "Belum ada pesan";
            }
            return $history;
        });

        return response()->json([
            'message' => 'Chat history retrieved!',
            'data' => $histories
        ], 200);

    } catch (Exception $e) {
        return response()->json([
            'message' => $e->getMessage()
        ], 500);
    }
}


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
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityGroupMessage $communityGroupMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityGroupMessage $communityGroupMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityGroupMessage $communityGroupMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityGroupMessage $communityGroupMessage)
    {
        //
    }
}
