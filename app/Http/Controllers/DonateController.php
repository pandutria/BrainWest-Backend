<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Donate::all();
            return response()->json([
                "message" => "Data Berhasil Diambil!",
                "data" => $data->map(function($item) {
                    $deadline = Carbon::parse($item->date)->startOfDay();
                    $remainingDays = Carbon::now()->startOfDay()->diffInDays($deadline, false);
                    $user_donate = $item->user_donate;

                    return [
                        "id" => $item->id,
                        "title" => $item->title,
                        "image" => $item->image,
                        "desc" => $item->desc,
                        "institution" => $item->institution,
                        "image_institution" => $item->image_institution,
                        "date" => $item->date,
                        "target" => $item->target,
                        "deadline" => $remainingDays . " Hari",
                        "current_donate" => $user_donate->pluck("total_donate")->sum(),
                        "user_donate" => $user_donate
                    ];
                })->toArray(),
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
            $data = new Donate();
            $upload = Cloudinary::uploadApi()->upload(
                $request->file("image")->getRealPath(),
                ["folder" => "Brainwest/donate"]
            );

            $uploadInstitution = Cloudinary::uploadApi()->upload(
                $request->file("image_institution")->getRealPath(),
                ["folder" => "Brainwest/donate/institution"]
            );

            $data->title = $request->title;
            $data->image = $upload["secure_url"];
            $data->desc = $request->desc;
            $data->date = $request->date;
            $data->institution = $request->institution;
            $data->image_institution = $uploadInstitution["secure_url"];
            $data->target = $request->target;
            $data->save();

            return response()->json([
                "message" => "Tambah Data Berhasil",
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
            $data = Donate::find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!",
                ], 404);    
            }

            $deadline = Carbon::parse($data->date);
            $remainingDays = Carbon::now()->startOfDay()->diffInDays($deadline, false);
            $user_donate = $data->user_donate;

            return response()->json([
                "message" => "Data Berhasil Diambil!",
                "data" => [
                    "id" => $data->id,
                    "title" => $data->title,
                    "image" => $data->image,
                    "desc" => $data->desc,
                    "institution" => $data->institution,
                    "image_institution" => $data->image_institution,
                    "date" => $data->date,
                    "target" => $data->target,
                    "deadline" => $remainingDays . " Hari",
                    "current_donate" => $user_donate->pluck("total_donate")->sum(),
                    "user_donate" => $user_donate
                ]
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
            $data = Donate::find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!",
                ], 404);    
            }
            
            if ($request->hasFile('image')) {
                $upload = Cloudinary::uploadApi()->upload(
                    $request->file("image")->getRealPath(),
                    ["folder" => "Brainwest/donate"]
                );

                $data->image = $upload['secure_url'];
            }

            if ($request->hasFile('image_institution')) {
                $uploadInstitution = Cloudinary::uploadApi()->upload(
                    $request->file("image_institution")->getRealPath(),
                    ["folder" => "Brainwest/donate/institution"]
                );

                $data->image_institution = $uploadInstitution['secure_url'];
            }


            $data->title = $request->title ?? $data->title;
            $data->desc = $request->desc ?? $data->desc;
            $data->date = $request->date ?? $data->date;
            $data->institution = $request->institution ?? $data->institution;
            $data->target = $request->target ?? $data->target;
            $data->save();

            return response()->json([
                "message" => "Data Berhasil Diubah!",
                "data" => $data
            ], 201);
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
            $data = Donate::find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!",
                ], 404);    
            }

            $data->delete();
            return response()->json([
                "message" => "Data Berhasil Dihapus!",
            ], 201);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }
}
