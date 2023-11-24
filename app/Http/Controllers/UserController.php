<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user_management|create_user|edit_user|delete_user', ['only' => ['index','show']]);
        $this->middleware('permission:create_user', ['only' => ['create','store']]);
        $this->middleware('permission:edit_user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_user', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.user_all');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::latest()->get();
        return view('admin.user.user_add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customValidation = [
            'username' => ['required', 'string', 'max:50', Rule::unique('users','username')],
            'first_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users','email')],
            'phone' => ['required', 'string', 'max:100', Rule::unique('users','phone')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required'],
        ];

        $validator = Validator::make($request->all(), $customValidation);

        if ($validator->fails()) {
            return redirect()->route('user.add')->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        $roles = $request->roles;

        if (!empty($roles)) {
            foreach ($roles as $role) {
                $user->assignRole($role);
            }
        }

        $notification = array(
            'message' => 'User Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.all')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $users = User::latest()->where('isDeleted', '0')->get();

        foreach ($users as $key => $user) {
            $user->roles = $user->roles->pluck('name')->toArray();
        }

        return response()->json(['data' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.user.user_edit', compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $customValidation = [
            'username' => ['required', 'string', 'max:50', Rule::unique('users','username')->ignore($request->id)],
            'first_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users','email')->ignore($request->id)],
            'phone' => ['required', 'string', 'max:100', Rule::unique('users','phone')->ignore($request->id)],
            'roles' => ['required'],
        ];

        $validator = Validator::make($request->all(), $customValidation);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($request->id);

        User::findOrFail($request->id)->update([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);

        DB::table('model_has_roles')->where('model_id',$request->id)->delete();

        $roles = $request->roles;

        if (!empty($roles)) {
            foreach ($roles as $role) {
                $user->assignRole($role);
            }
        }

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::latest()->where('id', $id)->get();

        $user->isDeleted = 1;
        $user->save();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
