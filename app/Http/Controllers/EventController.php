<?php

namespace App\Http\Controllers;

use App\Models\Event;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Event::all();
            return response()->json([
                "message" => "Data Berhasil Diambil!",
                "data" => $data
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
            $upload = Cloudinary::uploadApi()->upload(
                $request->file("image")->getRealPath(),
                ["folder" => "Brainwest/event"]
            );

            $data = new Event();
            $data->title = $request->title;
            $data->image = $upload["secure_url"];
            $data->desc = $request->desc;
            $data->timestamp = $request->timestamp;
            $data->date = $request->date;
            $data->address = $request->address;
            $data->price = $request->price;
            $data->save();

            return response()->json([
                "message" => "Data Berhasil Ditambah!",
                "data" => $data
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
            $data = Event::find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!",
                    "data" => $data
                ], 404);
            }

            return response()->json([
                "message" => "Data Berhasil Diambil!",
                "data" => $data
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
        try {
            $data = Event::find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!",
                    "data" => $data
                ], 404);
            }

            if ($request->hasFile('image')) {
                if ($data->public_id) {
                    Cloudinary::uploadApi()->destroy($data->public_id);
                }

                $upload = Cloudinary::uploadApi()->upload(
                    $request->file("image")->getRealPath(),
                    ["folder" => "Brainwest/event"]
                );

                $data->thumbnail = $upload['secure_url'];
                $data->public_id = $upload['public_id'];
            }

            $data->title = $request->title ?? $data->title;
            $data->image = $upload["secure_url"] ?? $data->image;
            $data->desc = $request->desc ?? $data->desc;
            $data->timestamp = $request->timestamp ?? $data->timestamp;
            $data->date = $request->date ?? $data->date;
            $data->address = $request->address ?? $data->address;
            $data->price = $request->price ?? $data->price;
            $data->save();

            return response()->json([
                "message" => "Data Berhasil Diubah!",
                "data" => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Event::find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!",
                    "data" => $data
                ], 404);
            }

            $data->delete();
            return response()->json([
                "message" => "Data Berhasil Dihapus!",
                "data" => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }   
    }
}
