<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profilePage(Request $request)
    {
        return view('frontend.users/profile');
    }
    public function editProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'foto' => 'mimes:jpeg.jpg.png|max:2048',
        ]);

        $profile = User::findOrFail(Auth::user()->id);
        $date = new DateTime($request->dob);

        $profile->name = $request->name;
        $profile->gender = $request->gender;
        $profile->dob = $date->format('Y-m-d');
        $profile->address = $request->address;
        $profile->bio = $request->bio;
        # Foto
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/assets/images/users/';
            $filename = Str::random(6) . '_' . $file->getClientOriginalName();
            $upload = $file->move($path, $filename);

            if ($profile->image) {
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

        $profile->save();

        $response = [
            'success'   => true,
            'title'     => 'Bagus',
            'message'   => 'Data berhasil diperbarui',
            'data'  => $profile,
        ];

        return response()->json($response, 200);
    }

    public function editPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'new-password'     => 'required',
            'new-password-confirm'     => 'required|same:new-password',
        ]);

        if (!Hash::check($request->get('password'), Auth::user()->password)) {
            // The passwords matches
            $response = [
                'success'   => false,
                'title'     => 'Peringatan',
                'message'   => 'Kata sandi anda saat ini tidak cocok dengan kata sandi yang anda berikan. Silakan coba lagi.'
            ];

            return response()->json($response, 200);
        }

        if (strcmp($request->get('password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            $response = [
                'success'   => false,
                'title'     => 'Peringatan',
                'message'   => 'Kata sandi baru tidak boleh sama dengan kata sandi Anda saat ini. Silakan pilih kata sandi yang berbeda.'
            ];

            return response()->json($response, 200);
        }

        if (!(strcmp($request->get('new-password'), $request->get('new-password-confirm'))) == 0) {
            //New password and confirm password are not same
            $response = [
                'success'   => false,
                'title'     => 'Peringatan',
                'message'   => "Kata sandi baru harus sama dengan kata sandi Anda yang dikonfirmasi. Ketikkan ulang kata sandi baru."
            ];

            return response()->json($response, 200);
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        $response = [
            'success'   => true,
            'security'  => $request->security,
            'title'     => 'Bagus',
            'message'   => "Kata sandi berhasil diubah."
        ];

        return response()->json($response, 200);
    }

    public function userData(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::check()) {
                $response = [
                    'success'   => true,
                    'message'   => 'berhasil',
                    'data'      => Auth::user()
                ];

                return response()->json($response, 200);
            } else {
                return redirect('/login');
            }
        }
    }
}
