<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission_management|create_permission|edit_permission|delete_permission', ['only' => ['index','show']]);
        $this->middleware('permission:create_permission', ['only' => ['create','store']]);
        $this->middleware('permission:edit_permission', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_permission', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.permission.permission_all');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Permission::latest()->whereNull('parent_id')->get();
        return view('admin.permission.permission_add', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customValidation = [
            'name' => ['required', 'string', 'max:125'],
        ];

        $validator = Validator::make($request->all(), $customValidation);

        if ($validator->fails()) {
            return redirect()->route('permission.add')->withErrors($validator)->withInput();
        }

        if ($request->parent != null) {
            Permission::create([
                'name' => $request->name,
                'created_at' => Carbon::now(),
                'parent_id' => $request->parent
            ]);

            $notification = array(
                'message' => 'Child Permission Created Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('permission.all')->with($notification);
        }
        elseif ($request->parent == null) {
            Permission::create([
                'name' => $request->name,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Parent Permission Created Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('permission.all')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $permission = Permission::latest()->where('isDeleted', '0')->get();
        return response()->json(['data' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permission.permission_edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $permission_id = $request->id;

        Permission::findOrFail($permission_id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permission.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
