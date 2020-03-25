<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KajianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data_kajian = Post::with('user')->get();

            $response = [
                'success'   =>  $data_kajian->count() ? true : false,
                'message'   => $data_kajian->count() ? 'data berhasil' : 'Belum ada daftar Kajian!',
                'data'      => $data_kajian,
            ];

            return response()->json($response, 200);
        }
        return view('frontend.kajian.kumpulan-kajian');
    }

    public function baru(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'description' => 'required',
            // 'image' => 'mimes:jpeg.jpg.png|max:2048',
        ]);

        $baru = new Post;

        $baru->user_id = $request->user_id;
        $baru->description = $request->description;
        $baru->city_id = $request->cities;
        $baru->district_id = $request->districts;

        # Foto
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/assets/images/posts/';
            $filename = Str::random(6) . '_' . $file->getClientOriginalName();
            $upload = $file->move($path, $filename);

            if ($baru->image) {
                $old_image = $baru->image;
                $filepath = public_path() . '/assets/images/posts/' . $baru->image;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    //Exception $e;
                }
            }
            $baru->image = $filename;
        }

        $baru->save();

        $response = [
            'success'   => true,
            'title'     => 'Bagus',
            'message'   => 'Kajian baru telah dibuat!',
        ];

        return response()->json($response, 200);
    }
}