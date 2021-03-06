<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\TaskScheduler;
use App\User;
use DataTables;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get()->take(5);

        return view('admin.home', compact('posts'));
    }

    public function users(Request $request)
    {
        if ($request->ajax()) {

            $data = User::whereRoleIs('member')->orderBy('created_at', 'desc')->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<button type="button" id="btn-delete" class="btn btn-danger" data-id="' . $row->id . '" data-nama="' . $row->nama . '"><i class="far fa-trash-alt"></i></button>';

                        return $btn;

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.users/index');
    }

    public function usersPOST(Request $request)
    {
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        $user->attachRole('member');

        $response = [
            'msg'  => 'Berhasil',
        ];

        return response()->json($response, 200);
    }

    public function usersDELETE(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->roles()->detach($user->id);
        $user->delete();

        $response = [
            'msg'  => 'Berhasil',
        ];

        return response()->json($response, 200);
    }

    /**
     * @param Task\Bagian
     */

    public function task(Request $request)
    {
        if ($request->ajax()) {

            $data = TaskScheduler::orderBy('created_at', 'desc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                $btn = '<button type="button" id="info-info" class="btn btn-info" data-id="' . $row->id . '" data-title="' . $row->title . '" data-description="' . $row->description . '"><i class="fa fa-eye"></i></button>';
                    $btn .= ' <button type="button" id="btn-delete" class="btn btn-danger" data-id="' . $row->id . '"><i class="far fa-trash-alt"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.task/index');
    }

    public function taskPOST(Request $request)
    {
        $task = new TaskScheduler;
        $task->title = $request['title'];
        $task->description = $request['description'];
        $task->save();

        $response = [
            'msg'  => 'Berhasil',
        ];

        return response()->json($response, 200);
    }

    public function taskDELETE(Request $request)
    {
        $task = TaskScheduler::findOrFail($request->id);
        $task->delete();

        $response = [
            'msg'  => 'Berhasil',
        ];

        return response()->json($response, 200);
    }

    # Profile

    public function editProfile(Request $request)
    {
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
        $profile->save();

        $response = [
            'success'   => true,
            'title' => 'Berhasil',
            'message' => "Data diri telah diperbarui"
        ];

        return response()->json($response, 200);

    }
}
