<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserAddRequest;
use App\Http\Requests\Users\UserPasswordUpdateRequest;
use App\Http\Requests\Users\UserProPicUpdateRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\Batch;
use App\Models\Role;
use App\Models\User;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UsersController extends Controller {
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (!in_array(auth()->user()->role->id, [1])) {
                abort(403, 'Unauthorized.');
            } else {
                return $next($request);
            }
        });
    }

    public function index() {
        if (!in_array(auth()->user()->role->id, [1, 2])) {
            abort(403, 'Unauthorized.');
        }
        $users = User::all();
        return view('dashboard.users.index', [
            'admins' => $users->whereIn('role_id', ['1', '2']),
            'editors' => $users->where('role_id', 3),
            'users' => $users->where('role_id', 4),
            'roles' => Role::all()->except([1]),
            'batches' => Batch::all(),
        ]);
    }

    public function user_add(UserAddRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'role_id' => $request->role,
            'batch_id' => $request->batch_id,
        ]);
        session()->flash('success', 'User added successfully!');
        return response()->json(['success' => true]);
    }

    public function user_profile() {
        $user =  auth()->user();
        return view('dashboard.users.show', [
            'user' => $user,
            'roles' => Role::all(),
            'batches' => Batch::all(),
            'page_title' => $user->name
        ]);
    }

    public function user_show($id) {
        if (!in_array(auth()->user()->role->id, [1, 2])) {
            abort(403, 'Unauthorized.');
        }
        $user =  User::find($id);
        return view('dashboard.users.show', [
            'user' => $user,
            'roles' => Role::all()->except([1]),
            'batches' => Batch::all(),
            'page_title' => $user->name
        ]);
    }

    public function user_update_info(UserUpdateRequest $request) {
        $user = User::find($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'batch_id' => $request->batch_id ?? $user->batch_id,
            'role_id' => $request->role_id ?? $user->role_id,
        ]);
        return back()->with('success', 'User Updated Successfully.');
    }

    public function user_update_password(UserPasswordUpdateRequest $request) {
        User::find($request->id)->update([
            'password' => bcrypt($request->password),
        ]);
        return back()->with('success', 'Password Updated Successfully.');
    }

    public function user_update_pro_pic(UserProPicUpdateRequest $request) {
        $image = $request->image;
        $user = User::find($request->id);
        $file_name = Str::lower('profile-' . $request->id . '-' . uniqid() . '.' . $image->getClientOriginalExtension());
        if ($user->image != '') {
            unlink(public_path('/uploads/users/' . $user->image));
        }
        Image::make($image)->fit(200, 200)->save(public_path('/uploads/users/' . $file_name));
        $user->update([
            'image' => $file_name
        ]);

        return back()->with('success', 'Profile picture updated successfully.');
    }

    public function user_delete(User $id) {
        $id->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
