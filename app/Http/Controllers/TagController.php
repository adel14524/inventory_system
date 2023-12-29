<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tag.product_tag_all');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag.product_tag_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customValidation = [
            'tag_name' => ['required', 'string', 'max:50'],
        ];

        $validator = Validator::make($request->all(), $customValidation);

        if ($validator->fails()) {
            return redirect()->route('tag.add')->withErrors($validator)->withInput();
        }

        $tag = Tag::create([
            'tag_name' => $request->tag_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Tag Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('tag.all')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $tag = Tag::latest()->where('isDeleted', '0')->get();

        return response()->json(['data' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('admin.tag.product_tag_edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $customValidation = [
            'tag_name' => ['required', 'string', 'max:50'],
        ];

        $validator = Validator::make($request->all(), $customValidation);

        if ($validator->fails()) {
            return redirect()->route('tag.edit')->withErrors($validator)->withInput();
        }

        Tag::findOrFail($request->id)->update([
            'tag_name' => $request->tag_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Tag Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('tag.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Tag::latest()->where('id',$id)->delete();

        $notification = array(
            'message' => 'Tag Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
