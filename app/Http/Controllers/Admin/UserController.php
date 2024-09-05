<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // GET all Users
    public function index() {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function create() {
        return view('create_user');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt('User is added')]
            ) );
        return redirect()->back();
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        // return response()->json('User has been deleted');
        return redirect()->back();
    }
}
