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
