<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProductModel::all()->toarray();
        return view ('admin.product',compact('data'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.product.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //      $request->validate([
    //     'name' => 'required|string|max:255',
    //     'price' => 'required|string',
    //     'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    // ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $request->name . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/uploads', $filename);
    } else {
        $filename = null;
    }

    ProductModel::create([
        'name' => $request->name,
        'price' => $request->price,
        'images' => $filename,
    ]);

    return redirect()->route('admin.product.index')->with('success', 'Product added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = ProductModel::find($id);
        return view ('admin.product.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        ProductModel::where('id',$id)->update([
        'name' => $request->name,
        'price' => $request->price,
        'images' => $request->image,
    ]);
    return redirect()->route('admin.product.index')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = ProductModel::find($id);
        $data->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted!');

    }
}
