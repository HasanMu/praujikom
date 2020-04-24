<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function taks(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users/index', compact('users'));
    }
}
