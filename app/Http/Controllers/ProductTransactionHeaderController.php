<?php

namespace App\Http\Controllers;

use App\Models\ProductTransactionHeader;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductTransactionHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Get data successfully',
                'data' => ProductTransactionHeader::with('user')->all()
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function indexByUser() {
        try {
            $buyer_id = Auth::user()->id;
            $data = ProductTransactionHeader::with('user')->where('buyer_id', $buyer_id);
            return response()->json([
                'message' => 'Get data successfully',
                'data' => $data->get()
            ], 201);
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
            $user = Auth::user();

            $data = new ProductTransactionHeader();
            $data->buyer_id = $user->id;
            $data->total = $request->total;
            $data->address = $request->address;
            $data->save();

            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => 'TRX-' . $data->id . '-' . time(),
                    'gross_amount' => $request->total,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
            ];

            $data = ProductTransactionHeader::with('user')->find($data->id);
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return response()->json([
                'message' => 'Create data successfully',
                'data' => [
                    'transaction_header' => $data,
                    'snap_token' => $snapToken
                ]
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransactionHeader $productTransactionHeader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransactionHeader $productTransactionHeader)
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
            $data = ProductTransactionHeader::find($id);
            $data->delete();

            return response()->json([
                'message' => 'Delete data successfully',
                'data' => $data
            ], 200);
        } catch(Exception $e) {

        }
    }
}
