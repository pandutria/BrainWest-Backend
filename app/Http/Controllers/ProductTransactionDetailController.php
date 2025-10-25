<?php

namespace App\Http\Controllers;

use App\Models\ProductTransactionDetail;
use Exception;
use Illuminate\Http\Request;

class ProductTransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            return response()->json([
                'message' => 'Get data succesfully',
                'data' => ProductTransactionDetail::with(['product', 'detail'])->get()
            ], 200);
        } catch(Exception $e) {
            response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function indexByHeader($headerId) {
        try {
            $data = ProductTransactionDetail::where('product_transaction_header_id', $headerId);
            return response()->json([
                'message' => 'Get data successfully',
                'data' => $data->with(['product', 'detail'])->get()
            ]);
        } catch(Exception $e) {

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
            $data = new ProductTransactionDetail();
            $data->product_id = $request->product_id;
            $data->product_transaction_header_id = $request->product_transaction_header_id;
            $data->qty = $request->qty;
            $data->save();

            return response()->json([
                'message' => 'Create data successfully',
                'data' => $data->with(['product', 'detail.user'])->find($data->id)
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
    public function show(ProductTransactionDetail $productTransactionDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransactionDetail $productTransactionDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransactionDetail $productTransactionDetail)
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
            $data = ProductTransactionDetail::find($id);
            $data->delete();

            return response()->json([
                'message' => 'Delete data successfully',
                'data' => $data
            ], 200);
        } catch(Exception $e) {
            
        }
    }
}
