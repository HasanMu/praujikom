<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

Route::get('/', function () {
    return view('frontend.home');
});
/**
 * Route::get('/jadwal-sholat', function () {
 *      return view('frontend.jadwal-sholat');
 * });
 */
Route::get('/al-quran', function () {
    return view('frontend.al-quran');
});

/* Route Kajian - Frontend */
Route::get('/kajian', 'Member\KajianController@index')->name('kajian.index');


Route::get('/kajian/{id}', function ($id) {
    $post = Post::with('comment', 'user', 'city', 'district')->findOrFail($id);

    return view('frontend.kajian.single-kajian', compact('post'));
});

/* Route Post */
Route::post('/kajian/{id}/comment/add', function (Request $request, $id) {

    $new_comment = new Comment();

    $new_comment->content = $request->content;
    $new_comment->post_id = $id;
    $new_comment->user_id = $request->user_id;
    $new_comment->save();

    return redirect()->back();
});

/* Route Deelete */
Route::delete('/kajian/comment/{id}', function ($id) {

    $delete_comment = Comment::findOrFail($id)->delete();

    return redirect()->back();
});

/**
 * GET USER DATA - Frontend
 */
Route::group(['middleware' => ['auth']], function () {
    Route::post('/kajian', 'Member\KajianController@baru')->name('kajian.baru');
    Route::post('/kajian/ubah', 'Member\KajianController@ubah')->name('kajian.ubah');
    Route::get('user/data', function () {
        if (Auth::check()) {
            $response = [
                'success'   => true,
                'message'   => 'berhasil',
                'data'      => Auth::user(),
                'kajian'    => Auth::user()->post
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'success'   => false,
                'message'   => 'Kamu belum masuk',
                'data'      => '',
            ];
            return response()->json($response, 200);
        }
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin Route
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/home', 'Admin\AdminController@index')->name('home.admin');
    Route::get('/users', 'Admin\AdminController@users')->name('admin.users');
    Route::post('/users', 'Admin\AdminController@usersPOST')->name('admin.users.add');
    Route::delete('/users', 'Admin\AdminController@usersDELETE')->name('admin.users.delete');
    # Taks
    Route::get('/task-scheduller', 'Admin\AdminController@task')->name('admin.task');
    Route::post('/task-scheduller', 'Admin\AdminController@taskPOST')->name('admin.task.add');
    Route::delete('/task-scheduller', 'Admin\AdminController@taskDELETE')->name('admin.task.delete');
    # Profile
    Route::get('/profile', function () {
        return view('admin.profile/index');
    });
    Route::post('/profile', function (Request $request) {
        $profile = User::findOrFail(Auth::user()->id);
        $date = new DateTime($request->dob);

        $profile->name = $request->name;
        $profile->gender = $request->gender;
        $profile->dob = $date->format('Y-m-d');
        $profile->address = $request->address;
        $profile->bio = $request->bio;
        # Foto
        if ($request->hasFile('image-upload')) {
            $file = $request->file('image-upload');
            $path = public_path() . '/assets/images/users/';
            $filename = Str::random(6) . '_' . $file->getClientOriginalName();
            $upload = $file->move($path, $filename);

            if ($profile->image && $profile->image != 'default-avatar.jpg') {
                $old_image = $profile->image;
                $filepath = public_path() . '/assets/images/users/' . $profile->image;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    //Exception $e;
                }
            }
            $profile->image = $filename;
        }

        $response = [
            'success'   => true,
            'title' => $profile->image,
            'message' => "Data diri telah diperbarui"
        ];

        return response()->json($response, 200);

    });
});

// Member Route
Route::group(['middleware' => ['auth', 'role:member']], function () {
    Route::get('/profile', 'Member\ProfileController@profilePage')->name('home.member');
    Route::get('/profile/data', 'Member\ProfileController@userData'); // User Data - Login
    Route::post('/profile', 'Member\ProfileController@editProfile')->name('editProfile');
    Route::post('/profile/security', 'Member\ProfileController@editPassword')->name('editPassword');

    # PostiganKu Route

    Route::get('/myposts', 'Member\ProfileController@postingankuPage');
});

Route::group(['prefix' => 'api/v1/'], function () {
    /**
     * API KOTA & KECAMATAN
     */

    Route::group(['prefix' => '/'], function () {
        Route::get('/cities', function () {
            $data = DB::table('cities')
                        ->orderBy('name', 'asc')
                        ->get();

            $response = [
                'message'   => 'data kota',
                'data'      => $data
            ];

            return response()->json($response, 200);
        });

        Route::get('/{city_id}/districts', function ($city_id) {
            if (!is_numeric($city_id)) {
                $response = [
                    'message'   => 'parameter harus berupa angka!'
                ];

                return response()->json($response, 200);
            }
            $data = DB::table('districts')
                        ->where('city_id', $city_id)
                        ->orderBy('name', 'asc')
                        ->get();

            $response = [
                'message'   => 'data kecamatan',
                'data'      => $data
            ];

            return response()->json($response, 200);
        });

    });

    /**
     * API QS
     */
    Route::group(['prefix' => 'quran/surah'], function () {
        Route::get('/', function () {
            $data = DB::table('quran_surah')->get();

            $response = [
                'message'   => 'data semua QS',
                'data'      => $data
            ];

            return response()->json($response, 200);
        });

        Route::get('/{qs_id}', function ($qs_id) {
            $data = DB::table('quran_ayat')->where('qs_id', $qs_id)->get();
            $QS = DB::table('quran_surah')->where('id', $qs_id)->get();
            if(!$data || $QS->count() == null) {
                $response = [
                    'success'   => false,
                    'message'   => 'Nomor surat tidak ditemukan!',
                    'msg'       => 'MAKSIMAL 114',
                    'url'       => env('APP_URL').'/api/v1/quran/surah/114'
                ];

                return response()->json($response, 200);
            }

            $response = [
                'message'   => 'data QS '.$QS[0]->nama,
                'namaQS'    => $QS[0]->nama,
                'data'      => $data
            ];

            return response()->json($response, 200);
        });

        Route::get('/{qs_id}/pagination/{paging}', function ($qs_id, $paging) {
            if (!is_numeric($paging) ) {
                $response = [
                    'success'   => false,
                    'message'   => 'Harus berupa angka!',
                ];

                return response()->json($response, 200);
            }
            $data = DB::table('quran_ayat')->where('qs_id', $qs_id)->paginate($paging);
            $QS = DB::table('quran_surah')->where('id', $qs_id)->get();
            if (!$data || $QS->count() == null) {
                $response = [
                    'success'   => false,
                    'message'   => 'Nomor surat tidak ditemukan!',
                    'msg'       => 'MAKSIMAL 114',
                    'url'       => env('APP_URL') . '/api/v1/quran/surah/114'
                ];

                return response()->json($response, 200);
            }

            $response = [
                'message'   => 'data QS ' . $QS[0]->nama,
                'namaQS'    => $QS[0]->nama,
                'data'      => $data
            ];

            return response()->json($response, 200);
        });
    });

    /**
     * API KAJIAN
     */
    Route::group(['prefix' => '/kajian'], function () {
        Route::get('/', 'Member\KajianController@apiAllKajian');
    });

    Route::group(['prefix' => '/komentar'], function () {
        Route::get('/posts', function () {
            $data = Comment::with('user', 'post')->get();

            $response = [
                'message'   => 'Data komentar!',
                'data'      => $data
            ];

            return response()->json($response, 200);
        });
        Route::get('/post/{post_id}', function ($post_id) {
            $data = Comment::with('user', 'post')->where('post_id', $post_id)->get();

            $response = [
                'message'   => 'Data komentar!',
                'data'      => $data
            ];

            return response()->json($response, 200);
        });
    });

});
