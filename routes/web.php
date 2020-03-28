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
use Illuminate\Support\Facades\DB;

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
Route::post('/kajian', 'Member\KajianController@baru')->name('kajian.baru');


Route::get('/kajian/1', function () {
    return view('frontend.kajian.single-kajian');
});

/**
 * GET USER DATA - Frontend
 */
Route::group(['middleware' => ['auth']], function () {
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
    Route::get('/home', function () {
        return view('admin.home');
    })->name('home.admin');
});

// Member Route
Route::group(['middleware' => ['auth', 'role:member']], function () {
    Route::get('/profile', 'Member\ProfileController@profilePage')->name('home.member');
    Route::get('/profile/data', 'Member\ProfileController@userData'); // User Data - Login
    Route::post('/profile', 'Member\ProfileController@editProfile')->name('editProfile');
    Route::post('/profile/security', 'Member\ProfileController@editPassword')->name('editPassword');
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

});
