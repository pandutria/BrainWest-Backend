<?php

namespace App\Http\Controllers;

use App\Models\EventTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = EventTransaction::with(["user", "event"])->get();
            return response()->json([
                "data" => $data, 
                "message" => "Data Berhasil Diambil!"
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function meTransaction()
    {
        try {
            $user = Auth::user();
            $data = EventTransaction::with(["user", "event"])->where("user_id", $user->id)->get();
            return response()->json([
                "data" => $data, 
                "message" => "Data Berhasil Diambil!"
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            $transaction = new EventTransaction();
            $transaction->user_id = $user->id;
            $transaction->event_id = $request->event_id;
            $transaction->save();

            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => 'TRX-' . $transaction->id . '-' . time(),
                    'gross_amount' => 50000,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return response()->json([
                'data' => [
                    "transaction" => $transaction,
                    "snap_token" => $snapToken
                ],
                'message' => 'Transaksi berhasil dibuat!',
            ], 201);

        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = EventTransaction::with(["user", "event"])->find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!"
                ], 404);
            }

            return response()->json([
                "data" => $data, 
                "message" => "Data Berhasil Diambil!"
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
