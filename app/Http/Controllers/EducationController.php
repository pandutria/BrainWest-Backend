<?php

namespace App\Http\Controllers;

use App\Models\Education;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $data = Education::all();
        return response()->json([
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        try {
            $upload = Cloudinary::uploadApi()->upload(
                $request->file("thumbnail")->getRealPath(),
                ["folder" => "Brainwest/article"]
            );

            $data = new Education();
            $data->title = $request->title;
            $data->thumbnail = $upload['secure_url'];
            $data->text = $request->text;
            $data->desc = $request->desc;
            $data->link = $request->link;
            $data->category = $request->category;
            $data->save();

            return response()->json([
                "message" => "Data Berhasil Ditambahkan!",
                "data" => $data
            ], 201);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }

    public function show(string $id)
    {
        $data = Education::find($id);
        return response()->json([
            "data" => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = Education::find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!"
                ], 404);
            }

            if ($request->hasFile('thumbnail')) {
                if ($data->public_id) {
                    Cloudinary::uploadApi()->destroy($data->public_id);
                }

                $upload = Cloudinary::uploadApi()->upload(
                    $request->file("thumbnail")->getRealPath(),
                    ["folder" => "Brainwest/article"]
                );

                $data->thumbnail = $upload['secure_url'];
                $data->public_id = $upload['public_id'];
            }

            $data->title = $request->title ?? $data->title;
            $data->link = $request->link ?? $data->link;
            $data->desc = $request->desc ?? $data->desc;
            $data->text = $request->text ?? $data->text;
            $data->category = $request->category ?? $data->category;

            $data->save();

            return response()->json([
                "message" => "Data Berhasil Diperbarui!",
                "data" => $data
            ], 200);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Education::find($id);
            if (!$data) {
                return response()->json([
                    "message" => "Data Tidak Ditemukan!"
                ], 404);
            }

            if ($data->public_id) {
                Cloudinary::uploadApi()->destroy($data->public_id);
            }

            $data->delete();

            return response()->json([
                "message" => "Data Berhasil Dihapus!"
            ], 200);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }
}
