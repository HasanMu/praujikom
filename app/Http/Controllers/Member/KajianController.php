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

    public function ubah(Request $request)
    {
        $request->validate([
            'description' => 'required',
            // 'image' => 'mimes:jpeg.jpg.png|max:2048',
        ]);

        $ubah = Post::findOrFail($request->_idPKJn);

        $ubah->description = $request->description;
        $ubah->city_id = $request->cities;
        $ubah->district_id = $request->districts;

        # Foto di hapus
        if ($request->d_img !== null && $request->d_img !== false) {
            $ubah->image = '';
            $filepath = public_path() . '/assets/images/posts/' . $ubah->image;
            File::delete($filepath);
        }

        # Foto
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/assets/images/posts/';
            $filename = Str::random(6) . '_' . $file->getClientOriginalName();
            $upload = $file->move($path, $filename);

            if ($ubah->image) {
                $old_image = $ubah->image;
                $filepath = public_path() . '/assets/images/posts/' . $ubah->image;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    //Exception $e;
                }
            }
            $ubah->image = $filename;
        }

        $ubah->save();

        $response = [
            'success'   => true,
            'title'     => 'Bagus',
            'message'   => 'Kajian baru telah diperbarui!',
        ];

        return response()->json($response, 200);
    }

    public function apiAllKajian()
    {
        $data_kajian = Post::with('user', 'city', 'district')->get();

        $datas = [];
        $collections = collect($datas);
        foreach ($data_kajian as $key => $data) {
            $collections->push([
                'id'            => $data->id,
                'user_id'       => $data->user_id,
                'user'          => $data->user,
                'description'   => $data->description,
                'image'         => $data->image,
                'district_id'   => $data->district_id,
                'district'      => $data->district,
                'city_id'       => $data->city_id,
                'city'          => $data->city,
                'created_at'    => $data->created_at,
                'updated_at'    => $data->updated_at,
                'poster'        => Auth::check() ? $data->user->id === Auth::user()->id ? true : false : false
            ]);
        }

        $response = [
            'success'   =>  $data_kajian->count() ? true : false,
            'message'   => $data_kajian->count() ? 'data berhasil' : 'Belum ada daftar Kajian!',
            'data'      => $collections,
        ];

        return response()->json($response, 200);
    }
}
