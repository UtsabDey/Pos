<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['users'] = User::all();
        return view('users.index', $data)->with('no', 1);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'is_admin' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|same:confirm_password|max:100',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->is_admin = $request->is_admin;
        $user->email = $request->email;
        // $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($user) {
            return redirect()->route('users.index')->with('success', 'User Added Successfully!');
        }
        return redirect()->route('users.index')->with('error', 'Failed to Create User!');
    }


    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'is_admin' => 'required',
            'email' => 'required|unique:users,email,' . $id,
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->is_admin = $request->is_admin;
        $user->email = $request->email;

        if ($user->isDirty()) {
            $user->update();
            return redirect()->route('users.index')->with('success', 'User Updated Successfully!');
        }
        return redirect()->route('users.index')->with('error', 'Nothing Changed!');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('warning', 'Post Deleted Successfully');
    }
}
