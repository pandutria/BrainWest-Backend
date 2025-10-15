<?php

namespace App\Http\Controllers;

use App\Models\DonateTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonateTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = DonateTransaction::with(["user", "donate"])->get();
            return response()->json([
                "message" => "Data Berhasil Diambil!",
                "data" => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ]);
        }
    }

    public function meTransaction()
    {
        try {
            $user = Auth::user();
            $data = DonateTransaction::with(["user", "donate"])->where("user_id", $user->id)->orderBy("created_at", "DESC")->get();
            return response()->json([
                "message" => "Data Berhasil Diambil!",
                "data" => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ]);
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
        try {
            $user = Auth::user();
            $data = new DonateTransaction();

            $data->user_id = $user->id;
            $data->donate_id = $request->donate_id;
            $data->total_donate = $request->total_donate;
            $data->save();

            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => 'TRX-' . $data->id . '-' . time(),
                    'gross_amount' => $request->total_donate,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
            ];

            $data = DonateTransaction::with(['user', 'donate'])->find($data->id);
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return response()->json([
                "message" => "Transaksi Berhasil!",
                "data" => [
                    "donate_transaction" => $data,
                    "snap_token" => $snapToken
                ],
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = DonateTransaction::with(["user", "donate"])->find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!",
                ], 404);
            }

            return response()->json([
                "message" => "Data Berhasil Diambil!",
                "data" => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ]);
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
