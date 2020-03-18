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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('frontend.home');
});
// Route::get('/jadwal-sholat', function () {
//     return view('frontend.jadwal-sholat');
// });
Route::get('/al-quran', function () {
    return view('frontend.al-quran');
});

Route::get('/kajian', function () {
    return view('frontend.kajian.kumpulan-kajian');
});

Route::get('/kajian/1', function () {
    return view('frontend.kajian.single-kajian');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin Route
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('home.admin');
});

// Member Route
Route::group(['middleware' => ['auth', 'role:member']], function () {
    Route::get('/profile', 'Member\ProfileController@profilePage')->name('home.member');
    Route::get('/profiles', function () {
        if (Auth::check()) {
            $response = [
                'message'   => 'berhasil',
                'data'      => Auth::user()
            ];

            return response()->json($response, 200);
        } else {
            return redirect('/login');
        }
    });
    Route::post('/profile', 'Member\ProfileController@editProfile')->name('editProfile');
    Route::post('/profile/security', 'Member\ProfileController@editPassword')->name('editPassword');
});

Route::group(['prefix' => 'api/v1/'], function () {
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
    });
});
