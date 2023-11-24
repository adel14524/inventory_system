<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:roles_management|create_roles|edit_roles|delete_roles', ['only' => ['index','show']]);
        $this->middleware('permission:create_roles', ['only' => ['create','store']]);
        $this->middleware('permission:edit_roles', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_roles', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.role.role_all');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $permissions = Permission::whereNull('parent_id')->with('children')->get();
        return view('admin.role.role_add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customValidation = [
            'name' => ['required', 'string'],
        ];

        $validator = Validator::make($request->all(), $customValidation);

        if ($validator->fails()) {
            return redirect()->route('role.add')->withErrors($validator)->withInput();
        }

        $role = Role::create([
            'name' => $request->input('name'),
            'created_at' => Carbon::now(),
        ]);

        $role->syncPermissions($request->input('permission'));

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('role.all')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $role = Role::latest()->where('isDeleted', '0')->get();
        return response()->json(['data' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::whereNull('parent_id')->with('children')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

        return view('admin.role.role_edit', compact('role','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $customValidation = [
            'name' => ['required', 'string'],
        ];

        $validator = Validator::make($request->all(), $customValidation);

        if ($validator->fails()) {
            return redirect()->route('role.edit')->withErrors($validator)->withInput();
        }

        $role = Role::find($request->id);
        $role->name = $request->input('name');
        $role->updated_at = Carbon::now();
        $role->save();
        $role->syncPermissions($request->input('permission'));

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('role.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Role::latest()->where('id',$id)->delete();

        $notification = array(
            'message' => 'Roles Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
