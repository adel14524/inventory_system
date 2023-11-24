<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:manage_product_category|create_product_category|edit_product_category|delete_product_category', ['only' => ['index','show']]);
        $this->middleware('permission:create_product_category', ['only' => ['create','store']]);
        $this->middleware('permission:edit_product_category', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_product_category', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.product_category_all');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.product_category_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customValidation = [
            'category_name' => ['required', 'string', 'max:100'],
        ];

        $validator = Validator::make($request->all(), $customValidation);

        if ($validator->fails()) {
            return redirect()->route('category.add')->withErrors($validator)->withInput();
        }

        $category = Category::create([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Category Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $category = Category::latest()->where('isDeleted', '0')->get();
        return response()->json(['data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.product_category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $customValidation = [
            'category_name' => ['required', 'string', 'max:100'],
        ];

        $validator = Validator::make($request->all(), $customValidation);

        if ($validator->fails()) {
            return redirect()->route('category.edit')->withErrors($validator)->withInput();
        }

        Category::findOrFail($request->id)->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::latest()->where('id',$id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
